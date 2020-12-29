@extends('layout')
@section('content', '新規投稿')
@section('text')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>新規投稿フォーム</h2>
        <form method="POST" action="{{ route('store') }}" onSubmit="return checkSubmit()">
        @csrf
            <div class="form-group">
                <label for="name">
                    投稿者
                </label>
                <input
                    id="name"
                    name="name"
                    class="form-control"
                    value="{{ old('title') }}"
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
                >{{ old('text') }}</textarea>
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
                    投稿する
                </button>
            </div>
        </form>
    </div>
</div>
<script>
function checkSubmit(){
if(window.confirm('送信してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection