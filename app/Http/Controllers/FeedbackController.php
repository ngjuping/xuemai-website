<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(Request $request)
    {
            // check feedback data length
            $author_name_len = strlen($request->author);
            $author_email_len = strlen($request->author_email);
            $author_issue_len = strlen($request->issue);
            if($author_name_len == 0 || $author_email_len == 0 || $author_issue_len == 0
            || $author_name_len > 30 || $author_email_len > 50 || $author_issue_len > 200){
                return response()->json([
                    'message' => '406 Unacceptable feedback data',
                ],406);
            }

            // get user ip
            // dd($request->ip());

            $newFeedback = new Feedback;
            $newFeedback->author = $request->author;
            $newFeedback->author_email = $request->author_email;
            $newFeedback->issue = $request->issue;
            $newFeedback->type = $request->type;

            // default values
            $newFeedback->importance = 3;
            $newFeedback->status = 1; // unviewed

            $newFeedback->save();

            return response()->json([
                'message' => '200 Create feedback OK',
            ],200);
    }
}
