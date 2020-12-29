<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;

class CommentsController extends Controller
{

    /**
     * バリデーション、登録データの整形など
     */
    public function store(CommentRequest $request)
    {
        $savedata = [
            'post_id' => $request->post_id,
            'name' => $request->name,
            'comment' => $request->comment,
        ];
 
        $comment = new Comment;
        $comment->fill($savedata)->save();

        \Session::flash('err_msg', 'コメントを投稿しました。');
 
        return redirect()->route('posts', [$savedata['post_id']]);
    }
}
