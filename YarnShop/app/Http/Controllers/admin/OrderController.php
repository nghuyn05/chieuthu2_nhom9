<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
        $orders = Order::all();
        view()->share(['orders' => $orders]);
        view()->share("carts", Cart::all());
    }
    public function index(Request $request){
         $query = Order::with('customer');

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $orders = $query->get();
    $carts  = Cart::all();

    return view(
        "admin.order_management.order_management-list",
        compact("orders", "carts")
    );
    }
    public function create(){
        $customers = Customer::all();
        return view("admin.order_management.add", compact("customers"));
    }
    public function store(Request $request){
        $orders = Order::create(
            [
                'customer_id' => $request->customer_id,
                'total_price'=> $request->total_price,
                'status'=> $request->status,
            ]
        );
        if($orders){
            return redirect()->route('admin.order_management.index');
        }else{
            return back();
        }
    }
    public function show($id){
        $order = Order::with('customer')->findOrFail($id);
        return view('admin.order_management.show', compact('order'));
    }
    public function edit($id){
        $order = Order::find($id);
        $customers = Customer::all();
        return view('admin.order_management.edit',compact('order','customers'));
    }
    public function update(Request $request, $id){
        $order = Order::find($id);
        $order->update(
            [
                'customer_id' => $request->customer_id,
                'total_price'=> $request->total_price,
                'status'=> $request->status,
            ]
        );
        if($order){
            return redirect()->route('admin.order_management.index');
        }else{
            return back();
        }
    }

    public function destroy($id){
        $order = Order::find($id);
        $order->delete();
        if($order){
            return redirect()->route("admin.order_management.index");
        }
        else{
            return back();
        }
    }
}
