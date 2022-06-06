@extends('layouts.logout')

@section('content')

    <div class = "title">ユーザー登録</div>
    {!! Form::open(['url' => '/confirmation']) !!}
    {{Form::token()}}

     @if($errors->any())
        @foreach($errors->all() as $error)
        {{ $error}}<br/>
        @endforeach
     @endif

    <div class = "main">
        <div class="form-group">
            <p>{{ Form::label('username','ユーザー名(姓、名)') }}</p>
            {!! Form::input('text', 'LastName', null, ['class' => 'form']) !!}
            <!-- 上と下のファサードは書き方が違うだけで同じ -->
            {{ Form::text('FirstName',null,['class' => 'form right']) }}
        </div>

        <div class="form-group">
            <p>{{ Form::label('username_kana','ユーザー名(セイ、メイ)') }}</p>
            {!! Form::input('text', 'LastName_kana', null, ['class' => 'form']) !!}
            {{ Form::text('FirstName_kana',null,['class' => 'form right']) }}
        </div>

        <div class="form-group">
            <p>{{ Form::label('birthday','誕生日（年、月、日）') }}</p>
            {!! Form::input('text', 'birthday_year', null, ['class' => 's-form']) !!}
            {{ Form::text('birthday_month',null,['class' => 's-form']) }}
            {{ Form::text('birthday_day',null,['class' => 's-form']) }}
        </div>

        <div class="form-group">
            <p>{{ Form::label('admission_date','入学日（年、月、日') }}</p>
            {!! Form::input('text', 'admission_year', null, ['class' => 's-form']) !!}
            {{ Form::text('admission_month',null,['class' => 's-form']) }}
            {{ Form::text('admission_day',null,['class' => 's-form']) }}
        </div>

        <div class="form-group radio">
            {{ Form::label('man','男性') }}
            {!! Form::radio('gender', 0, false, ['class' => 'radioBtn']) !!}
            {{ Form::label('woman','女性') }}
            {{ Form::radio('gender', 1, false,['class' => 'radioBtn']) }}
        </div>

        <div class="form-group">
            <p>{{ Form::label('email','メールアドレス') }}</p>
            {{ Form::email('email',null,['class' => 'form big']) }}
        </div>

        <div class="form-group">
            <p>{{ Form::label('password','パスワード') }}</p>
            {{ Form::password('password',['class' => 'form big']) }}
        </div>

        <div class="form-group">
            <p>{{ Form::label('password','パスワード確認') }}</p>
            {{ Form::password('password_confirmation',['class' => 'form big']) }}
        </div>

        <div class="form-group radio">
            {{ Form::label('kokugo','国語講師') }}
            {!! Form::radio('role', 0, false, ['class' => 'radioBtn']) !!}
            {{ Form::label('math','数学講師') }}
            {{ Form::radio('role', 5, false,['class' => 'radioBtn']) }}
            {{ Form::label('student','生徒') }}
            {{ Form::radio('role', 10, false,['class' => 'radioBtn']) }}

        </div>

        <div class="form-group radio">
            <p>{{ Form::label('kokugo_t','国語講師担当者') }}</p>
            {!! Form::radio('kokugo_t', "", true, ['class' => 'radioBtn', 'style'=>'display:none']) !!}
            @foreach($kokugo as $kokugo)
            {{ Form::label('kokugo_t',$kokugo->username) }}
            {!! Form::radio('kokugo_t', $kokugo->id, false, ['class' => 'radioBtn']) !!}
            @endforeach
        </div>

        <div class="form-group">
            <p>{{ Form::label('math_t','数学講師担当者') }}</p>
            {{Form::hidden('math_t')}}
            @foreach($math as $math)
            {{ Form::label('math_t',$math->username) }}
            {{ Form::radio('math_t', $math->id, false,['class' => 'radioBtn']) }}
            @endforeach
        </div>


            <p>{{ Form::submit('確認',['class'=>'btn']) }}</p>

        {!! Form::close() !!}
    </div>

@endsection
