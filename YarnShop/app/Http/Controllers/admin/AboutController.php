<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
        view()->share("abouts", About::all());
    }

    public function index(Request $request)
    {
        $query = About::query();

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->status !== null && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $abouts = $query->get();
        return view("admin.about.about-list", compact("abouts"));
    }

    public function create(){
        return view("admin.about.add");
    }

    public function store(Request $request){
        $about = About::create([
            'title'     => $request->title,
            'content_1' => $request->content_1,
            'content_2' => $request->content_2,
            'content_3' => $request->content_3,
            'image'     => $request->image,
            'status'    => $request->status ?? 1,
        ]);

        if($about){
            return redirect()->route('admin.about.index');
        }
        return back();
    }

    public function edit($id){
        $about = About::find($id);
        return view("admin.about.edit", compact('about'));
    }

    public function update(Request $request, $id){
        $about = About::find($id);
        $about->update([
            'title'     => $request->title,
            'content_1' => $request->content_1,
            'content_2' => $request->content_2,
            'content_3' => $request->content_3,
            'image'     => $request->image,
            'status'    => $request->status,
        ]);

        if($about){
            return redirect()->route("admin.about.index");
        }
        return back();
    }

    public function destroy($id){
        $about = About::find($id);
        $about->delete();

        if($about){
            return redirect()->route("admin.about.index");
        }
        return back();
    }
}
