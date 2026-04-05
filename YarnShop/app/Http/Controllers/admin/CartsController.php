<?php


namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        $this->middleware("auth");
        view()->share("customers", Customer::all());
        view()->share("carts", Cart::all());
    }
    public function index()
    {
        $carts = Cart::all();
        $customers = Customer::all();
        $orders = Order::all();
        return view("admin.order_management.order_management-list",compact("customers","carts","orders"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        return view("admin.carts.add", compact("customers"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $carts = Cart::create(
            [
                'customer_id' => $request->customer_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        if($carts){
            return redirect()->route('admin.carts.index');
        }else{
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cart = Cart::find($id);
        $customers = Customer::all();
        return view('admin.carts.edit',compact('cart','customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cart = Cart::find($id);
        $cart->update(
            [
                'customer_id' => $request->customer_id,
                'created_at' => $request->created_at,
                'updated_at' => now(),
            ]
        );
        if($cart){
            return redirect()->route('admin.carts.index');
        }else{
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        if($cart){
            return redirect()->route("admin.carts.index");
        }
        else{
            return back();
        }
    }
}
