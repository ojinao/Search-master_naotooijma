@extends('layouts.logout')

@section('content')
<div class="container">
  <div class="login-container">
    <div class = "add" style="
    margin-bottom: 50px;">登録ありがとうございます</div>

      {!! Form::open(['url' => '/login']) !!}
        {{ Form::submit('ログイン画面へ',['class'=>'btn']) }}
      {!! Form::close() !!}
  </div>
</div>
@endsection
