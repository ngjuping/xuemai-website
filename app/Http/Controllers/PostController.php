<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'message' => '200 Get all posts OK',
            'posts' => Post::orderBy('created_at','DESC')->paginate(5),
        ],200);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function search(Request $request)
    {
        $query = $request->input('query');

        if(!$query){
            return response()->json([
                'message' => '406 Empty string not acceptable as query',
            ],406);
        }
        $elasticSearchURL = config('elastic.url', 'localhost/').'_search';
        $response = Http::withHeaders([
            'Authorization' => config('elastic.credentials', 'defaulttoken')
        ])
        ->post($elasticSearchURL,[
            'query' => [
                'multi_match' => [
                    "query" => $query,
                    "fuzziness" => "AUTO",
                    "fields"=> [ "posttitle", "postcontent" ]
                ]
            ]
        ]);

        // decoded data
        $results = json_decode($response->getBody()->getContents())->hits->hits;
        $results_len = count($results);
        for ($x = 0; $x < $results_len; $x++) {
            $results[$x] = [
                'id' => $results[$x]->_source->id,
                'user_id' => $results[$x]->_source->user_id,
                'postTitle' => $results[$x]->_source->posttitle,
                'postContent' => $results[$x]->_source->postcontent,
                'created_at' => $results[$x]->_source->created_at,
                'updated_at' => $results[$x]->_source->updated_at,
            ];
        }
        return response()->json([
            'message' => '200 Search posts OK',
            'posts' => [
                'data' => $results
            ]
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
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
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $existingPost = Post::find($id);
        // post found, return details
        if($existingPost){
            return response()->json([
                'message' => '200 Get post OK',
                'post' => $existingPost
            ],200);
        }
        return response()->json([
            'message' => "404 Post doesn't exist",
        ],404);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
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

                return response()->json([
                    'message' => '200 Update post OK',
                ],200);
            }

            return response()->json([
                'message' => '404 Post ' . $id . ' not found',
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
     * @return \Illuminate\Http\JsonResponse
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
                ],200);
            }
            return response()->json([
                'message' => '404 Post ' . $id . ' not found',
            ],404);
        }
        else{
            // unauthorized action
            return response()->json([
                'message' => '401 Delete post failed',
            ],401);
        }
    }
}
