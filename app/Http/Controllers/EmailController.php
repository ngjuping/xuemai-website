<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Email;

class EmailController extends Controller
{

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(Request $request)
    {
        // automatically returns 422 Unprocessable entity
        $request->validate([
            'email' => 'required|unique:mysql3.emails,email|email:rfc,dns',
        ]);

        // create subscriber email and save() to write to database
        $newEmail = new Email;
        $newEmail->email = $request->email;
        $newEmail->ip =  $request->ip();
        $newEmail->save();


        return response()->json([
            'message' => '200 Create subscriber email OK',
        ],200);
    }
}
