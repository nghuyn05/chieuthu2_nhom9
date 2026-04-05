<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Carts;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
        view()->share("products", Product::all());
        view()->share("comments", Comment::all());
        view()->share("ratings", Rating::all());
    }
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
            if ($request->status !== null && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $products = $query->get();

        return view("admin.products_management.product-list", compact("products"));
    }

    public function create(){
        $categories = Category::all();
        return view("admin.products_management.add", compact("categories"));
    }
    public function store(Request $request){
        $product = Product::create(
            [
                'category_id' => $request->category_id,
                'name'=> $request->name,
                'price'=> $request->price,
                'stock'=> $request->stock,
                'image'=> $request->image,
                'description'=> $request->description,
                'status'=> $request->status ?? 1,
            ]
        );
        if($product){
            return redirect()->route('admin.products_management.index');
        }else{
            return back();
        }
    }
    public function show($id){
        $product = Product::find($id);
        return view('admin.products_management.show',compact('product'));
    }
    public function edit($id){
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.products_management.edit',compact('categories','product'));
    }
    public function update(Request $request, $id){
        $product = Product::find($id);
        $product->update([
            'category_id' => $request->category_id,
            'name'=> $request->name,
            'price'=> $request->price,
            'stock'=> $request->stock,
            'image'=> $request->image,
            'description'=> $request->description,
            'status' => $request->status,

        ]);

        if($product){
            return redirect()->route("admin.products_management.index");
        }
        else{
            return back();
        }
    }

    public function destroy($id){
        $product = Product::find($id);
        $product->delete();
        if($product){
            return redirect()->route("admin.products_management.index");
        }
        else{
            return back();
        }
    }
}