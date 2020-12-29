<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
     * 投稿一覧を表示する
     * 
     * @return view
     */
    public function showList()
    {

        $posts = Post::orderBy('updated_at', 'desc')->paginate(15);

        return view('post.list', 
        ['posts' => $posts]);
    }

    /**
     * 投稿詳細を表示する
     * @param int $id
     * @return view
     */
    public function showDetail($id)
    {
        $post = Post::find($id);
        // $comments = Comment::all();
        $comments = Comment::where('post_id', $post->id)->first();
        // dd($comments);
        
        if(is_null($post)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('posts'));
        }

        return view('post.detail', 
        ['post' => $post]);

        
        

        return view('post.detail', 
        ['comments' => $comments]);


    }

    /**
     * 新規投稿画面を表示する
     * 
     * @return view
     */
    public function showCreate() {
        return view('post.form');
    }

    /**
     * 新規投稿する
     * 
     * @return view
     */
    public function exeStore(PostRequest $request) 
    {
        // 投稿データを受け取る
        $inputs = $request->all();

        \DB::beginTransaction();
        try {
            // 新規投稿
            Post::create($inputs);
            \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
        }
        
        \Session::flash('err_msg', '投稿が完了しました。');

        return redirect(route('posts'));
    }

    /**
     * 投稿編集フォームを表示する
     * @param int $id
     * @return view
     */
    public function showEdit($id)
    {
        $post = Post::find($id);

        if(is_null($post)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('posts'));
        }

        return view('post.edit', 
        ['post' => $post]);
    }

    /**
     * 投稿を更新する
     * 
     * @return view
     */
    public function exeUpdate(PostRequest $request) 
    {
        // 投稿データを受け取る
        $inputs = $request->all();

        \DB::beginTransaction();
        try {
            // 投稿を更新
            $post = Post::find($inputs['id']);
            \DB::commit();
            $post->fill([
                'name' => $inputs['name'],
                'text' => $inputs['text']
            ]);
            $post->save();
        } catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
        } 
        
        \Session::flash('err_msg', '投稿を更新しました。');

        return redirect(route('posts'));
    }

    /**
     * 投稿削除
     * @param int $id
     * @return view
     */
    public function exeDelete($id)
    {
        if(empty($id)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('posts'));
        }

        try {
            // 投稿を削除
            Post::destroy($id);
        } catch(\Throwable $e) {
            abort(500);
        } 
        
        \Session::flash('err_msg', '削除しました。');
        return redirect(route('posts'));
    }

}
