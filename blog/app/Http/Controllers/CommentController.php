<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function store() {

        $user = Auth::user();
        $comment = $user->comments()->create(request()->validate([
            'text' => 'required|string|min:20',
            'post_id' => 'required|numeric'
        ]));
        return back();
    }
}
