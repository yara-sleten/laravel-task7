<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CateCreateRequest;
use App\Http\Requests\CateEditRequest;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::with('blogs')->get();
        return view('category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $blogs=Blog::all();
        return view('category.create',compact('blogs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CateCreateRequest $request)
    {
        $data=$request->validated();
        $category=Category::create([
        'name' =>$data['name'], 
    ]);
   if($request->has('blog')){
    $category->blogs()->sync($request->input('blogs'));
   }
            return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id){
        $categories=Category::findOrFail($id);
        $blogs=Blog::all();
        $categoryBlogs=$categories->blogs->pluck('id')->toArray();
        return view('category.update', compact('categories','blogs','categoryBlogs'));

       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CateEditRequest $request , string $id)
    {
       $data= $request->validated();
        $category=Category::findOrFail($id);
        $category->update( [
            'name' =>$data['name']??$categories->name,
        ]);
        if($request->has('blog')){
            $category->blogs()->sync($request->input('blogs'));
           }else{
            $category->blogs()->sync([]);
           }
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( string $id)
    {
        $category=Category::findOrFail($id);
        $category->blogs()->sync([]);
        $category->delete();
        return redirect()->route('categories.index');
    }
}
