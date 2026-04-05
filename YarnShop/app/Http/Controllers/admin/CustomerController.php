<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Adress;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\Rating;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
        $customers = Customer::all();
        $addresses = Address::all();
        view()->share(['customers' => $customers]);
        view()->share(['addresses'=> $addresses]);

    }
    public function index(){
        $customers = Customer::all();
        $addresses = Address::all();
        return view("admin.customer_management.customer_management-list",compact("customers","addresses"));
    }
    public function create(){
        $customers = Customer::all();
        $addresses = Address::all();
        return view("admin.customer_management.add",compact("customers","addresses"));   
    }
    public function store(Request $request){
        $customer = Customer::create(
            [
                'name'=> $request->name,
                'email'=> $request->email,
                'phone'=> $request->phone,
                'password'=> $request->password,
                'status'=>$request->status,
            ]
        );
        if($customer){
            return redirect()->route('admin.customer_management.index');
        }else{
            return back();
        }
    }
    public function show($id){
        $customer = Customer::find($id);
        return view('admin.customer_management.show',compact('customer'));
    }
    public function edit($id){
        $customer = Customer::find($id);
        return view('admin.customer_management.edit',compact('customer'));
    }
    public function update(Request $request, $id){
        $customer = Customer::find($id);
        $customer->update([
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'password'=> $request->password,
            'status'=>$request->status,

        ]);

        if($customer){
            return redirect()->route("admin.customer_management.index");
        }
        else{
            return back();
        }
    }

    public function destroy($id){
        $customer = Customer::find($id);
        $customer->delete();
        if($customer){
            return redirect()->route("admin.customer_management.index");
        }
        else{
            return back();
        }
    }
}