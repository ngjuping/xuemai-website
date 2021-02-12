<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => '200 Get all FAQs OK',
            'faqs' => Faq::all(),
        ],200);
    }
}
