@extends('layout')
@section('title', '投稿一覧')
@section('text')
<div class="row">
  <div class="col-md-10 col-md-offset-2">
    <h2>投稿一覧</h2>
    @if (session('err_msg'))
      <p class="text-danger">
        {{ session('err_msg') }}
      </p>
    @endif
    <table class="table table-striped">
      <tr>
        <th>番号</th>
        <th>投稿者</th>
        <th>日付</th>
        <th>本文</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      @foreach($posts as $post)
      <tr>
        <td>{{ $post->id }}</td>
        <td>{{ $post->name  }}</td>
        <td>{{ $post->updated_at  }}</td>
        <td>{{Str::limit($post->text, 50, '…' )}}</td>
        <td><button type="button" class="btn btn-primary" onclick="location.href='/post/{{ $post->id }}'">詳細</button></td>
        <td><button type="button" class="btn btn-primary" onclick="location.href='/post/edit/{{ $post->id }}'">編集</button></td>
        <form method="POST" action="{{ route('delete', $post->id) }}" onSubmit="return checkDelete()">
        @csrf
        <td><button type="submit" class="btn btn-primary" onclick=>削除</button></td>
        </form>
      </tr>
      @endforeach
    </table>
  </div>
  <div class="col-md-10 my-5 col-md-offset-2">
    {{ $posts->links() }}
  </div>
</div>
<script>
function checkDelete(){
if(window.confirm('削除してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection