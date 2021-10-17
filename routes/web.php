<?php

use App\Models\Post\Post;
use App\Models\Category\Category;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // eager load the posts to avoid the n+1 problems
    return view('posts', ['posts' => Post::with('category')->get()]);
});

Route::get('posts/{post:slug}', function (Post $post) {
    // Find a post by slug and pass it to the view

    return view('post', [
        'post' => $post
    ]);
    // the regex below is to constrain the wildcard
});

Route::any('categories/{category:slug}', function (Category $category) {
    // return all posts associated to a category

    return view('categories', [
        'posts' => $category->posts
    ]);
});
