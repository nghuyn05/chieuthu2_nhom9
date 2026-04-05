<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Adress;
use App\Models\Customer;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
        view()->share("customers", Customer::all());
        view()->share("addresses", Address::all());
    }
    public function index(){
        $addresses = Address::all();
        $customers = Customer::all();
        return view("admin.customer_management.customer_management-list",compact("customers","addresses"));
    }
    public function create(){
        $customers = Customer::all();
        return view("admin.address.add", compact("customers"));
    }
    public function store(Request $request){
        $addresses = Address::create(
            [
                'customer_id' => $request->customer_id,
                'name'=> $request->name,
                'phone'=> $request->phone,
                'address_line'=> $request->address_line,
                'district'=> $request->district,
                'city'=> $request->city,
                'is_default'=> $request->is_default,
            ]
        );
        if($addresses){
            return redirect()->route('admin.address.index');
        }else{
            return back();
        }
    }
    public function show($id){
        //
    }
    public function edit($id){
        $addresses = Address::find($id);
        $customers = Customer::all();
        return view('admin.address.edit',compact('addresses','customers'));
    }
    public function update(Request $request, $id){
        $addresses = Address::find($id);
        $addresses->update(
            [
                'customer_id' => $request->customer_id,
                'name'=> $request->name,
                'phone'=> $request->phone,
                'address_line'=> $request->address_line,
                'district'=> $request->district,
                'city'=> $request->city,
                'is_default'=> $request->is_default,
            ]
        );
        if($addresses){
            return redirect()->route('admin.address.index');
        }else{
            return back();
        }
    }

    public function destroy($id){
        $addresses = Address::find($id);
        $addresses->delete();
        if($addresses){
            return redirect()->route("admin.address.index");
        }
        else{
            return back();
        }
    }
}
