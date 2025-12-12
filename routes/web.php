<?php
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/blogs', [BlogController::class,'index'])->name('blogs.index');
Route::get('/create_blog', [BlogController::class,'create'])->middleware('admin'); 
Route::POST('/create_blog',[BlogController::class,'store'])->name('blogs.create')->middleware('admin'); 
Route::get('blogs/update/{id}' ,[BlogController::class,'update'])->name('blogs.update')->middleware('admin'); 
Route::put('blogs/update/{id}' ,[BlogController::class,'edit'] )->name('blogs.update.submit')->middleware('admin'); 
Route::delete('blogs/delete/{id}' , [BlogController::class,'remove'])->name('blogs.delete')->middleware('admin'); 
Route::get('/blogs/trash', [BlogController::class, 'trash'])->name('blogs.trash')->middleware('admin'); 
Route::post('/blogs/{id}/restore', [BlogController::class, 'restore'])->name('blogs.restore')->middleware('admin'); 
Route::delete('/blogs/{id}/force-delete', [BlogController::class, 'forceDelete'])->name('blogs.force-delete')->middleware('admin'); 
Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');

Route::resource('categories',CategoryController::class)->middleware('admin'); 
   
Route::post('/favorite/{blog}', [FavoriteController::class, 'store'])->name('favorite.store');
Route::delete('/favorite/{blog}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');
Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorite.index');
Route::get('/blogs/category/{ig}', [BlogController::class, 'filterCategory'])->name('blogs.filter.category');