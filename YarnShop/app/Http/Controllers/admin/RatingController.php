<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        $this->middleware("auth");
        view()->share("ratings", Rating::all());
    }
    public function index()
    {
        $products = Product::all();
        $comments = Comment::all();
        $ratings = Rating::all();
        return view("admin.products_management.product-list",compact("products","comments","ratings"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view("admin.rating.add",compact("customers","products"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rating = Rating::create(
            [
                'customer_id'=> $request->customer_id,
                'product_id'=> $request->product_id,
                'score'=> $request->score,
                'comment'=> $request->comment,
            ]
        );
        if($rating){
            return redirect()->route('admin.products_management.index');
        }else{
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ratings = Rating::find($id);
        return view('admin.rating.show',compact('ratings'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rating = Rating::find($id);
        $customers = Customer::all();
        $products = Product::all();
        return view('admin.rating.edit',compact('rating','customers','products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rating = Rating::find($id);
        $rating->update([
            'customer_id' => $request->customer_id,
            'product_id'=> $request->product_id,
            'score'=> $request->score,
                'comment'=> $request->comment,
        ]);

        if($rating){
            return redirect()->route("admin.products_management.index");
        }
        else{
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $rating = Rating::find($id);
       $rating->delete();
       if($rating){
           return redirect()->route("admin.rating.index");
       }
       else{
           return back();
       }
    }
}
