<?php

namespace App\Http\Controllers;

use Auth;
use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use App\Helpers\StringFormat;
use Crypt;
use Carbon\Carbon;

class CommentController extends Controller {
    public function new(Request $request) {
        $user = Auth::user();
        $post_id = $request->input('post');

        if (Post::find($post_id)) {
            $comment = new Comment([
                'user_id' => $user->id,
                'post_id' => $post_id,
                'content' => $request->input('content'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            
            $comment->save();
        } else {
            return redirect()->back()->withErrors([
                StringFormat::format(__('tried to comment on a post that did not exist, try again. if the issue persists, contact an administrator'))
            ]);
        }

        return redirect()->back();
    }
}
