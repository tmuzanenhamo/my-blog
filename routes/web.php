<?php

use App\Models\posts\Posts;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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
    return view('posts', ['posts' => Posts::all()]);
});

Route::get('posts/{post}', function ($slug) {
    // Find a post by slug and pass it to the view
    $post = Posts::findOrFail($slug);

    return view('post', [
        'post' => $post
    ]);
    // the regex below is to constrain the wildcard
});
