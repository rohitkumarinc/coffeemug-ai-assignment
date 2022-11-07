<?php

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

Route::get('/', 'App\Http\Controllers\StoryController@publish_story')->name('home');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::resource('stories', 'App\Http\Controllers\StoryController');
    Route::post('ck-editor-image-upload', 'App\Http\Controllers\StoryController@ck_editor_image_upload')->name('ck_editor_image_upload');
});

Route::get('/{username}/{slug}', 'App\Http\Controllers\StoryController@story_view')->name('story_view');
