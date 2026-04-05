<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $categories = Category::where('status',1)->get();
       view()->share(['categories'=>$categories]);
    
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::where('status',1)->get();
        $products = Product::where('status',1)->get();

    return view('home.index', compact("categories","products",));
    }
    public function showLogin()
    {
        return view('home.login');
    }

    public function loginUser(Request $request)
    {
        $customer = Customer::where('email', $request->email)->first();

        if(!$customer){
            return back()->with('error','Email không tồn tại');
        }

        // So sánh password thường (vì DB chưa hash)
        if($request->password !== $customer->password){
            return back()->with('error','Mật khẩu không đúng');
        }

        session([
            'customer' => [
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
            ]
        ]);

        return redirect('/')->with('success','Đăng nhập thành công');
    }

    public function loginApiGet(Request $request)
    {
        $email = $request->query('email');
        $password = $request->query('password');

        if (!$email || !$password) {
            return response()->json([
                'status' => false,
                'message' => 'Thiếu email hoặc password'
            ], 400);
        }

        $customer = Customer::where('email', $email)->first();

        if (!$customer) {
            return response()->json([
                'status' => false,
                'message' => 'Email không tồn tại'
            ], 404);
        }

        if ($password !== $customer->password) {
            return response()->json([
                'status' => false,
                'message' => 'Mật khẩu không đúng'
            ], 401);
        }

        return response()->json([
            'status' => true,
            'message' => 'Đăng nhập thành công',
            'data' => [
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
            ]
        ]);
    }

    public function logoutUser()
    {
        session()->forget('customer');
        return redirect('/')->with('success','Đã đăng xuất');
    }

    public function showRegister()
    {
        return view('home.register');
    }
    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|min:6',
        ]);

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'status' => 1,
        ]);

        return redirect()->route('user.login.form')
            ->with('success','Đăng ký thành công! Vui lòng đăng nhập');
    }

    public function registerApiGet(Request $request)
    {
        $name = $request->query('name');
        $email = $request->query('email');
        $password = $request->query('password');
        $phone = $request->query('phone');

        if (!$name || !$email || !$password) {
            return response()->json([
                'status' => false,
                'message' => 'Thiếu dữ liệu'
            ], 400);
        }

        // check email tồn tại
        if (Customer::where('email', $email)->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Email đã tồn tại'
            ], 409);
        }

        $customer = Customer::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đăng ký thành công',
            'data' => $customer
        ]);
    }
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect('/');
        }
    }
    // public function product()
    // {
    //     $products = Product::where('status',1)->get();
    //     return view('home.product', compact('products'));
    // }
    public function product(Request $request)
    {
        $keyword = $request->keyword;

        if ($keyword) {
            $products = Product::where('name', 'LIKE', "%$keyword%")->get();
        } else {
            $products = Product::all();
        }

        return view('home.product', compact('products', 'keyword'));
    }
    public function category_product($id){
         $products = Product::where([
             ['category_id','=',$id]
             ,['status','=','1']
         ])->get();
         return view('home.category_product',compact("products","products"));
    }
    public function single_product($id){
        $product = Product::where(
            [
                ['id','=',$id],
                ['status','=','1'],
            ]
        )->get()->first();
        return view('home.single_product',compact("product","product"));
    }
    public function productApi()
    {
        $products = Product::where('status', 1)->get();

        return response()->json($products);
    }
    public function about()
    {
        $about = About::where('status', 1)->first();

        return view('home.about', compact('about'));
    }

    public function contact()
    {
        $contact = Contact::where('status', 1)->first();

        return view('home.contact', compact('contact'));
    }

    public function contactSubmit(Request $request)
    {
        $customer = session('customer');

        if (!$customer || !isset($customer['id'])) {
            return redirect()->route('user.login.form')
                ->with('error', 'Bạn cần đăng nhập để gửi liên hệ!');
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => strtolower($request->email),
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 0,
            'customer_id' => $customer['id'], // chắc chắn không null
        ]);

        return back()->with('success', 'Gửi liên hệ thành công!');
    }
    

    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = Session::get('cart', []);

        $quantity = $request->quantity ? (int)$request->quantity : 1;

        if ($quantity > $product->stock) {
            return back()->with('error', 'Số lượng vượt quá tồn kho!');
        }

        if(isset($cart[$id])){
            $cart[$id]['quantity'] += $quantity;

            // ❌ tổng cũng không được vượt stock
            if ($cart[$id]['quantity'] > $product->stock) 
            {
                $cart[$id]['quantity'] = $product->stock;
            }
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        Session::put('cart', $cart);
        return redirect()->back()->with('success', 'Thêm sản phẩm vào giỏ hàng thành công!');
    }
    public function cart()
    {
        return view('home.cart');
    }

    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])){
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return back()->with('success', 'Cập nhật giỏ hàng thành công!');
        }

        return back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng!');
    }

    // Remove sản phẩm khỏi giỏ hàng
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])){
            unset($cart[$id]);
            session()->put('cart', $cart);
            return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
        }

        return back()->with('error', 'Product not found in cart!');
    }
    public function checkout()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $product){
            $total += $product['price'] * $product['quantity'];
        }

        return view('home.checkout', compact('cart', 'total'));
    }

    // Xử lý thanh toán (giả lập)
    public function processCheckout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thanh toán!');
        }

        $cart = session()->get('cart', []);
        if (!$cart || count($cart) == 0) {
            return back()->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        // Lấy customer theo email đăng nhập
        $customer = Customer::where('email', Auth::user()->email)->first();

        if (!$customer) {
            return back()->with('error', 'Không tìm thấy thông tin khách hàng!');
        }

        // Tính tổng tiền
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Tạo đơn hàng
        $order = Order::create([
            'customer_id' => $customer->id, // ✅ ĐÚNG DB
            'total_price' => $total,
            'status' => 'Chờ xử lý',
        ]);

        // Lưu chi tiết đơn hàng
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'], // bạn đã fix cart rồi 👍
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Xóa giỏ hàng
        Session::forget('cart');

        return redirect()->route('order.view', $order->id)->with('success','Thanh toán thành công!');

    }
    public function myOrder($id)
    {
        $order = Order::with('items')->findOrFail($id);

        return view('home.order_success', compact('order'));
    }
    
    // Tìm kiếm sản phẩm
    public function search(Request $request)
    {
        $keyword = trim($request->keyword);

        if (!$keyword) {
            return redirect()->back()->with('error', 'Vui lòng nhập từ khóa!');
        }

        $products = Product::where('status', 1)
            ->where('name', 'like', "%$keyword%")
            ->get();

        return view('home.product', compact('products'));
    }
    // API tìm kiếm 
    public function searchApi(Request $request)
    {
        $keyword = trim($request->keyword);

        if (!$keyword) {
            return response()->json([]);
        }

        $products = Product::where('status', 1)
            ->where('name', 'like', "%$keyword%")
            ->get();

        return response()->json($products);
    }
    



// API lấy sản phẩm theo category 
public function apiProductsByCategory($id)
{
    $products = Product::where('category_id', $id)->get();

    return response()->json([
        'status' => true,
        'data' => $products
    ]);
}


public function apiCategory()
{
    $categories = Category::all();

    return response()->json([
        'status' => true,
        'data' => $categories
    ]);
}


    // 🔹 Xem phản hồi của user
    public function myContact()
    {
        // ❗ Bạn đang dùng session('customer') chứ KHÔNG phải Auth

        if (!session()->has('customer')) {
            return redirect()->route('user.login.form')
                ->with('error', 'Bạn cần đăng nhập!');
        }

        $customer = session('customer');

        $contacts = Contact::where('customer_id', $customer['id'])
            ->whereNotNull('reply') // reply
            ->orderBy('created_at', 'desc')
            ->get();

        return view('home.reply', compact('contacts'));
    }

    public function apiSubmitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Lấy customer_id từ session
        $customer = session('customer');

        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 0, // chưa đọc
            'customer_id' => $customer['id'] ?? null, // nếu chưa login vẫn null
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Liên hệ của bạn đã gửi thành công!',
            'data' => $contact
        ], 201);
    }

    // 🔹 Lấy danh sách phản hồi admin cho user hiện tại (API)
    public function apiGetReplies(Request $request)
    {
        $customer_id = $request->input('customer_id');

        if (!$customer_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Vui lòng gửi customer_id!'
            ], 401);
        }

        $contacts = Contact::where('customer_id', $customer_id)
            ->whereNotNull('reply')
            ->orderBy('replied_at', 'desc')
            ->get(['subject','message','reply','replied_at']);

        return response()->json([
            'status' => 'success',
            'data' => $contacts
        ]);
    }
}
