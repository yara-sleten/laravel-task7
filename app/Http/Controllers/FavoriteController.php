<?php

namespace App\Http\Controllers;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
     $favorites= Favorite::where('user_id', auth()->id())->get();
        return view('blog.favorites', compact('favorites'));
    }
    public function  store($blogId){
        Favorite::firstOrCreate([
            'user_id' => auth()->id(),
            'blog_id' => $blogId,
        ]);
        return back();
    }
    public function destroy($blogId){
        Favorite::where('user_id', auth()->id())->where('blog_id', $blogId)->delete();
return back();
    }
}
