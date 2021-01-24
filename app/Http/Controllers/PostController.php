<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'message' => '200 Get all posts OK',
            'posts' => Post::orderBy('created_at','DESC')->get(),
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {

            $userId = Auth::id();
            $newPost = new Post;
            $newPost->user_id = $userId;
            $newPost->postTitle = $request->postTitle;
            $newPost->postContent = $request->postContent;
            $newPost->save();
            return response()->json([
                'message' => '200 Create post OK',
            ],200);
        }
        else{
            return response()->json([
                'message' => '401 Create post failed',
            ],401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // if user is logged in
        if (Auth::check()) {

            $existingPost = Post::find( $id );

            // if post is found
            if($existingPost){
                $existingPost->postTitle = $request->postTitle;
                $existingPost->postContent = $request->postContent;
                $existingPost->save();
                dd($request->postTitle);
                return response()->json([
                    'message' => '200 Update post OK',
                ],200);
            }

            return response()->json([
                'message' => '404 Post ' + $id + ' not found',
            ], 404);
        }
        else{
            // unauthorized action
            return response()->json([
                'message' => '401 Update post failed',
            ],401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if user is logged in
        if (Auth::check()) {

            $existingPost = Post::find( $id );

            // if post is found
            if($existingPost){
                $existingPost->delete();
                return response()->json([
                    'message' => '200 Delete post OK',
                ]);
            }
            return response()->json([
                'message' => '404 Post ' + $id + ' not found',
            ]);
        }
        else{
            // unauthorized action
            return response()->json([
                'message' => '401 Delete post failed',
            ]);
        }
    }
}
