@extends('layout')
@section('title', '投稿詳細')
@section('text')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <h2>投稿者：{{ $post->name }}</h2>
    <h4>作成日：{{ $post->created_at }}</h4>
    <h4>更新日：{{ $post->updated_at }}</h4>
    <p>{{ $post->text }}</p>
  </div>
</div>
<form class="mb-4" method="POST" action="{{ route('comment.store') }}">
  @csrf
 
  <input name="post_id" type="hidden" value="{{ $post->id }}">
 
  <div class="form-group">
    <label for="subject">名前</label>
    <input id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}" type="text">
      @if ($errors->has('name'))
        <div class="invalid-feedback">
          {{ $errors->first('name') }}
        </div>
      @endif
  </div>
 
    <div class="form-group">
     <label for="body">本文</label>
 
        <textarea
            id="comment"
            name="comment"
            class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}"
            rows="4"
        >{{ old('comment') }}</textarea>
        @if ($errors->has('comment'))
         <div class="invalid-feedback">
         {{ $errors->first('comment') }}
         </div>
        @endif
    </div>
 
    <div class="mt-4">
      <button type="submit" class="btn btn-primary">コメントする
      </button>
    </div>
    
    <div class="mt-4">
      <button type="button" class="btn btn-primary" onclick="location.href='/'">一覧へ戻る
      </button>
    </div>
</form>
@endsection