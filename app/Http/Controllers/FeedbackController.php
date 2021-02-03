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
            $newFeedback = new Feedback;
            $newFeedback->author = $request->author;
            $newFeedback->author_email = $request->author_email;
            $newFeedback->reviewer = $request->reviewer;
            $newFeedback->issue = $request->issue;
            $newFeedback->importance = $request->importance;
            $newFeedback->type = $request->type;
            $newFeedback->status = 1;
            $newFeedback->remark = $request->remark;
            $newFeedback->save();

            return response()->json([
                'message' => '200 Create feedback OK',
            ],200);
    }
}
