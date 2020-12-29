@extends('layout')
@section('content', '投稿編集')
@section('text')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>投稿編集フォーム</h2>
        <form method="POST" action="{{ route('update') }}" onSubmit="return checkSubmit()">
        @csrf
            <input type="hidden" name="id" value="{{ $post->id }}">
            <div class="form-group">
                <label for="name">
                    投稿者
                </label>
                <input
                    id="name"
                    name="name"
                    class="form-control"
                    value="{{ $post->name }}"
                    type="text"
                >
                @if ($errors->has('name'))
                    <div class="text-danger">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="text">
                    本文
                </label>
                <textarea
                    id="text"
                    name="text"
                    class="form-control"
                    rows="4"
                >{{ $post->text }}</textarea>
                @if ($errors->has('text'))
                    <div class="text-danger">
                        {{ $errors->first('text') }}
                    </div>
                @endif
            </div>
            <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('posts') }}">
                    キャンセル
                </a>
                <button type="submit" class="btn btn-primary">
                    更新する
                </button>
            </div>
        </form>
    </div>
</div>
<script>
function checkSubmit(){
if(window.confirm('更新してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection