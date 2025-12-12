<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlogCreateRequest;
use App\Http\Requests\PlogEditRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class BlogController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request){
        $query=Blog::query();
        if($request->filled('category_id')){
            $query->whereHas('categories',function ($q) use ($request){
                $q->where('categories.id', $request->category_id);
            });
        }
            $blogs=$query->get();
        $categories=Category::all();
       
            return view('blog.index',compact('blogs','categories'));
    }
    public function create(){
        $categories = Category::all();
        return view('blog.create' , compact('categories') );
    }


    public function store(PlogCreateRequest $request)
{
    $data=$request->validated();

    $imageName = null;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time().'_'.$image->getClientOriginalName();
        $image->move(storage_path('app/public/blogs'), $imageName);
    }

    $blog = Blog::create([
        'title'   => $data['title'],
        'content' => $data['content'],
        'image'   => $imageName   
    ]);

    if ($request->has('categories')) {
        $blog->categories()->sync($request->categories);
    }

    return redirect()->route('blogs.index' );
}

    public function update(string $id){
        $blogs = Blog::with('categories')->findOrFail($id);
        $categories = Category::all();
        $selectedCategories = $blogs->categories->pluck('id')->toArray();  
        return view('blog.update', compact('blogs', 'categories', 'selectedCategories'));
    }

    public function edit(PlogEditRequest $request , string $id){
        $data=$request->validated(); 
        $blogs = Blog::findOrFail($id);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(storage_path('app/public/blogs'), $imageName);
    
            $blogs->image = $imageName;
        }

        $blogs->update([
            'title' => $data['title'] ?? $blogs->title,
            'content' => $data['content'] ?? $blogs->content,
            
        ]);
        if($request->has('categories')) {
            $blogs->categories()->sync($request->input('categories'));
        } else {
            $blogs->categories()->sync([]); 
        }
        
        return redirect()->route('blogs.index');
    }


    public function remove(string $id){
        $blog=Blog::findOrFail($id);
        $blog->categories()->sync([]);
    $blog->delete();
return redirect()->route('blogs.index');
    }

    public function trash()
    {
        $blogs=Blog::onlyTrashed()->with('categories')->get();
        return view('blog.trash', compact('blogs'));
    }
    
    public function restore($id)
    {
        $blog = Blog::onlyTrashed()->find($id);    
        if ($blog) {
            $blog->restore();
            return redirect()->route('blogs.trash');
        }   
        return redirect()->route('blogs.trash');
    }


    public function forceDelete($id)
    {
        $blog = Blog::onlyTrashed()->find($id);
        
        if ($blog) {
            if ($blog->image ) {
                Storage::delete('public/blogs/' . $blog->image);
            }
            
            $blog->categories()->sync([]);
            $blog->forceDelete();
            
            return redirect()->route('blogs.trash');
        }
        
        return redirect()->route('blogs.trash');
    }

public function show($id)
{
    $categories=Category::all();
    $blog=Blog::with('categories')->findOrFail($id);
    return view('blog.show', compact('blog','categories'));
}
public function filterCategory($id){
    $categories=Category::all();
    $category=Category::findOrFail($id);
    $blogs=$category->blogs();
    return view('blog.index',compact('category','blogs','categories'));
}
}
