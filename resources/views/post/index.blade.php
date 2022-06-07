@extends('layouts.login')

@section('content')

<div class ="header">

  <div><a href="/index">ユーザー一覧</a></div>
  <div>
      {!! Form::open(['url' => '/logout']) !!}
        {{ Form::submit('ログアウト',['class'=>'btn btn-primary']) }}
      {!! Form::close() !!}
  </div>
</div>

  <div class ="search">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  詳細検索
    </button>
  </div>

  @foreach($user as $users)


  <div class = "users">
    <div class ="detail">
      <div>名前 {{$users->username}} {{config('user.gender.'.$users->gender)}} {{ \Carbon\Carbon::parse($users->birthday)->age}}歳</div>

      <div>入学日：{{$users->admission_date->format('Y年m月d日')}}</div>

      <div>誕生日：{{$users->birthday->format('Y年m月d日')}}</div>

        @foreach ($users->UserPersonCharges as $UserPersonCharge)
            @if(!is_null($UserPersonCharge->math_teacher_user_id))

              <div>担当数学講師：{{$UserPersonCharge->math_teacher_user_id}}</div>
            @else
              <div>担当数学講師：不明</div>
            @endif
            @if(!empty($UserPersonCharge->japanese_language_user_id))

              <div>担当国語講師：{{$UserPersonCharge->japanese_language_user_id}}</div>
            @else
              <div>担当国語講師：不明</div>
            @endif
        @endforeach

          @foreach ($users->UserScores as $UserScore)
            @if(!empty($UserScore->score))
              <div>点数：{{$UserScore->score}}</div>
            @else
              <div>点数:0点</div>
            @endif
          @endforeach

          <div>権限：{{config('user.role.'.$users->role)}}</div>
    </div>
  </div>
  @endforeach
           <div>{{$user->appends(request()->query())->links()}}</div>


@endsection

              <!-- Modal -->
              <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel"></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="/search" method="get">
                        {{ csrf_field()}}

                          <div class="show selection">
                            <div class="title" name='top'>並び替え</div><span>:</span>
                                  <select name="kinds">
                                    <option selected="selected" value></option>
                                    <option value="username">名前</option>
                                    <option value="birthday">年齢</option>
                                    <option value="admission_date">入学日</option>
                                    <option value="score">点数</option>
                                  </select>
                                  <select name="order" class="order">
                                    <option selected="selected" value></option>
                                    <option value="asc">昇順</option>
                                    <option value="desc">降順</option>
                                  </select>
                          </div>

                          <div class="show selection">
                            <div class="title">年齢</div><span>:</span>
                                  <select name="underAge">
                                    <option selected="selected" value></option>
                                    @for($i = 15; $i < 66; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                  </select>
                                    <div>~</div>
                                  <select name="overAge">
                                    <option selected="selected" value></option>
                                    @for($i = 15; $i < 66; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                  </select>
                          </div>

                          <div class="show selection">
                            <div class ="title">入学日</div><span>:</span>
                              <input type="date" class="" name="u_admission_date">
                                <div>~</div>
                              <input type="date" class="" name="o_admission_date">
                          </div>

                              <div class="show">
                                <div class="title">担当数学講師</div><span>:</span>
                                <div class ="teacher">
                                @foreach($math as $math)
                                  <label for="math_t">{{$math->username}}
                                    <input type="checkbox" name="math_t" value="{{$math->id}}" class="checkbox">
                                  </label>
                                @endforeach
                                </div>
                              </div>

                              <div class="show">
                                <div class="title">担当国語講師</div><span>:</span>
                                <div class ="teacher">
                                @foreach( $kokugo as $kokugo )
                                  <label for="kokugo_t">{{$kokugo->username}}
                                     <input type="checkbox" name="kokugo_t" value="{{$kokugo->id}}" class="checkbox">
                                  </label>
                                @endforeach
                                </div>
                              </div>

                              <div class="show selection">
                                <div class="title">点数</div><span>:</span>
                               <select name="underscore">
                                 <option selected="selected" value></option>
                                    @for($i = 0; $i < 501; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                  </select>
                                   <div>~</div>
                                  <select name="overscore">
                                    <option selected="selected" value></option>
                                    @for($i = 0; $i < 501; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                  </select>
                              </div>

                              <div class="show">
                                <div class="title">権限</div><span>:</span>
                                  <label for="">数学教師
                                    <input type="checkbox" name="role" value="5" class="checkbox">
                                  </label>
                                  <label for="">国語教師
                                    <input type="checkbox" name="role" value="0" class="checkbox">
                                  </label>
                                  <label for="">生徒
                                    <input type="checkbox" name="role" value="10" class="checkbox">
                                  </label>
                              </div>

                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">検索</button>
                              </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
