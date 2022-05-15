@extends('layouts.logout')

@section('content')
<div class="container">
     <div class = "title">ユーザー登録</div>
    {!! Form::open(['url' => '/storage']) !!}
    {{Form::token()}}

    @if($errors->any())
    @foreach($errors->all() as $error)
    {{ $error}}<br/>
    @endforeach
    @endif

    <div class = "main">
        <div class="form-group">
            <p>{{ Form::label('username','ユーザー名(姓、名)') }}</p>
            {!! Form::input('text', 'LastName',$input['LastName'],['class' => 'form','readonly']) !!}
            <!-- 上と下のファサードは書き方が違うだけで同じ -->
            {{ Form::text('FirstName',$input['FirstName'],['class' => 'form right','readonly']) }}
        </div>

        <div class="form-group">
            <p>{{ Form::label('username_kana','ユーザー名(セイ、メイ)') }}</p>
            {!! Form::input('text', 'LastName_kana', $input["LastName_kana"], ['class' => 'form','readonly']) !!}
            {{ Form::text('FirstName_kana',$input["FirstName_kana"],['class' => 'form right','readonly']) }}
        </div>

        <div class="form-group">
            <p>{{ Form::label('birthday','誕生日（年、月、日）') }}</p>
            {!! Form::input('text', 'birthday_year', $input["birthday_year"], ['class' => 's-form','readonly']) !!}
            {{ Form::text('birthday_month',$input["birthday_month"],['class' => 's-form','readonly']) }}
            {{ Form::text('birthday_day',$input["birthday_day"],['class' => 's-form','readonly']) }}
        </div>

        <div class="form-group radio">
            <p>{{ Form::label('admission_date','入学日（年、月、日') }}</p>
            {!! Form::input('text', 'admission_year', $input["admission_year"], ['class' => 's-form','readonly']) !!}
            {{ Form::text('admission_month',$input["admission_month"],['class' => 's-form','readonly']) }}
            {{ Form::text('admission_day',$input["admission_day"],['class' => 's-form','readonly']) }}
        </div>

        <div class="form-group">
            {{ Form::label('man','男性') }}
            {!! Form::radio('gender', 0, ($input["gender"] == '0')? true:false, ['class' => 'radioBtn','disabled']) !!}
            {{ Form::label('woman','女性') }}
            {{ Form::radio('gender', 1, ($input["gender"] == '1')? true:false,['class' => 'radioBtn','disabled']) }}
            {{Form::hidden('gender',$input["gender"])}}
        </div>

        <div class="form-group">
            <p>{{ Form::label('email','メールアドレス') }}</p>
            {{ Form::email('email',$input["email"],['class' => 'form big','readonly']) }}
        </div>

        <div class="form-group">
            <p>{{ Form::label('password','パスワード') }}</p>
            {{ Form::password('password',['class' => 'form big','readonly']) }}
        </div>

        <div class="form-group">
            <p>{{ Form::label('password','パスワード確認') }}</p>
            {{ Form::password('password_confirmation',['class' => 'form big','readonly']) }}
        </div>

        <div class="form-group radio">
            {{ Form::label('kokugo','国語講師') }}
            {!! Form::radio('role', 0, ($input["role"] == '0')? true:false, ['class' => 'radioBtn','disabled']) !!}
            {{ Form::label('math','数学講師') }}
            {{ Form::radio('role', 5, ($input["role"] == '5')? true:false,['class' => 'radioBtn','disabled']) }}
            {{ Form::label('student','生徒') }}
            {{ Form::radio('role', 10, ($input["role"] == '10')? true:false,['class' => 'radioBtn','disabled']) }}
            {{Form::hidden('role',$input["role"])}}
        </div>

        <div class="form-group radio">
            <p>{{ Form::label('kokugo_t','国語講師担当者') }}</p>
            @foreach($kokugo as $kokugo)
            {{ Form::label('kokugo_t',$kokugo->username) }}
            {!! Form::radio('kokugo_t', $kokugo->id, ($input["kokugo_t"] == $kokugo->id)? true:false, ['class' => 'radioBtn','disabled']) !!}
            {{Form::hidden('kokugo_t',$input["kokugo_t"])}}
            @endforeach
        </div>

        <div class="form-group radio">
            <p>{{ Form::label('math_t','数学講師担当者') }}</p>
            @foreach($math as $math)
            {{ Form::label('math_t',$math->username) }}
            {{ Form::radio('math_t', $math->id, ($input["math_t"] == $math->id)? true:false,['class' => 'radioBtn','disabled']) }}
            {{Form::hidden('math_t',$input["math_t"])}}
            @endforeach
        </div>


        <p>{{ Form::submit('保存',['class'=>'btn']) }}</p>


        {!! Form::close() !!}
    </div>
</div>

@endsection
