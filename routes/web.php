<?php

use App\Http\Controllers\MyController;
use App\Http\Controllers\SocialiteController;
use Colin\Log\LogSplit;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function (LogSplit $a) {

    return view('welcome');
});
Route::get('/aaa', [MyController::class, 'index']);

/**
 *
user hasMany Post
post hasOne user


post hasMany
command belong

post hasMany Tag
Tags hasMany post

post belongsTo Category
category hasMany Post

 */
Route::get('/addpost', function () {

    $category = new App\Models\Categorys([

        'name' => 'testbody',
        'published_at' => null,
    ]);
    $category->save();


    $post = new App\Models\Post([
        'title' => 'test title',
        'body' => 'test body',
        'published_at' => null,
        'categorys_id' => $category->id
    ]);
    Auth::user()->posts()->save($post);

    $posts = Auth::user()->posts->toArray();
    var_dump($posts);
    $posts = Auth::user()->posts()->where('id','>',10)->get()->toArray();
    var_dump($posts);

});


Route::get('/addCategory', function () {
    $category = new App\Models\Categorys([

        'name' => 'testbody',
        'published_at' => null,
    ]);
    dd( Auth::user()->posts()->first()->category());
    Auth::user()->posts()->first()->category()->save($category);

});

Route::get('/delPost', function () {
    $user = App\Models\User::firstOrFail();

    $user->posts()->where('id','=',1)->delete(); // 删除 posts 表中相关记录
});

Route::get('/delUser', function () {
    $user = App\Models\User::firstOrFail();

    $user->delete(); // 删除 posts 表中相关记录
});





Route::get('/addComment', function () {
    $content = new App\Models\Comment([

        'content' => 'test body',
        'published_at' => null,
    ]);

    Auth::user()->posts()->first()->comments()->save($content);

});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/auth/facebook', [SocialiteController::class, 'fbLogin'])->name('/auth/facebook');
Route::get('/callback', [SocialiteController::class, 'fbLoginCallback'])->name('/auth/facebook/callback');
