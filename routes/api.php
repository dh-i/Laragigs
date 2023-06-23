<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('posts', function () {
    return response()->json([
        'posts' => [
            [
                'title' => 'deadpool',
                'content' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam suscipit perspiciatis minus dolores? Eveniet beatae dolorem corrupti error maiores! Unde aliquam officiis officia fugit doloremque iste mollitia totam amet eligendi rem dolore dolor nemo nostrum, exercitationem sapiente minus at ipsum eaque magnam, ab sunt culpa ratione? Libero ab placeat tenetur?'
            ],
            [
                'title' => 'batman',
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi eius voluptatum labore, voluptate fugiat est. Consequuntur et suscipit ducimus eos laborum sed quaerat dolorem dolorum ex sapiente nam nisi rerum quasi quae nihil a iure, veritatis dignissimos, sunt rem, iusto aliquam deleniti amet ea. Reprehenderit id aut totam.'
            ]
        ]
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
