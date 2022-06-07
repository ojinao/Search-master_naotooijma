@extends('layouts.logout')

@section('content')
<div class="login-container">
     {!! Form::open(['url' => '/login']) !!}
    <div class="main">

        <div class = "title">ログイン</div>

        @if($errors->any())
        @foreach($errors->all() as $error)
        {{ $error}}<br/>
        @endforeach
       @endif

        @if (session('error'))
            <p class="text-danger mt-3">
                {{ session('error') }}
            </p>
        @endif

        <div class="form-group">
            <p>{{ Form::label('e-mail','メールアドレス') }}</p>
            {{ Form::email('email',null,['class' => 'form big']) }}
        </div>

        <div class="form-group">
            <p>{{ Form::label('password','パスワード') }}</p>
            {{ Form::password('password',['class' => 'form big']) }}
        </div>

        <div class=loginBtn>{{ Form::submit('ログイン',['class'=>'btn']) }}</div>

        <div class='link'>新規ユーザーの方は<a href="/register">こちら</a></div>
    </div>
    {!! Form::close() !!}
</div>
@endsection
