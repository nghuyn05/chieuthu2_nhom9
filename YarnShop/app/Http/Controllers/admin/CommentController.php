<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    public function create() {
        $customers = Customer::all(); 
        $products = Product::all();
        return view('admin.comment.add', compact('customers', 'products'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $comment = Comment::create(
            [
                'customer_id'=> $request->customer_id,
                'product_id'=> $request->product_id,
                'content'=>$request->content,
            ]
        );
        if($comment){
            return redirect()->route('admin.comment.index');
        }else{
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        $comments = Comment::all();
        return view('admin.comment.show', compact('comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        $customers = Customer::all();
        $products = Product::all();
        return view('admin.comment.edit', compact('comment','customers','products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->update([
            'customer_id' => $request->customer_id,
            'name'=> $request->name,
            'price'=> $request->price,
            'stock'=> $request->stock,
            'image'=> $request->image,
            'description'=> $request->description,
            'status' => $request->status,

        ]);

        if($comment){
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
        $comment = Comment::find($id);
        $comment->delete();
        if($comment){
            return redirect()->route("admin.comment.index");
        }
        else{
            return back();
        }
    }
}
