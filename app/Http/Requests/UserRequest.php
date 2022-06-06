<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [



                   'LastName' => ['required', 'string','max:10'],
                   'FirstName' => ['required', 'string','max:10'],
                   'LastName_kana' =>['required', 'string','max:30'],
                   'FirstName_kana' =>['required', 'string','max:30'],
                    'birthday_year'=>['required'],
                    'birthday_month'=>['required'],
                    'birthday_day'=>['required'],
                    'birthday' =>['required','after_or_equal:1980-01-01','before_or_equal:-15 year'],
                    'admission_year'=>['required'],
                    'admission_month'=>['required'],
                    'admission_day'=>['required'],
                    'admission' =>['required','after_or_equal:2000-01-01','before_or_equal:today'],
                   'gender'=>'required|in:0,1|',
                   'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
                   'password' => ['required', 'string', 'min:8', 'max:16','confirmed'],
                   'password_confirmation' => ['required'],
                   'role' => ['required'],
                //    'kokugo_t' => ['nullable'],
                //    'math_t' => ['nullable']

        ];
    }

        protected function prepareForValidation()
    {
        // 誕生日をデータに追加
        $birthday = implode('-', $this->only(['birthday_year', 'birthday_month', 'birthday_day']));
        $admission = implode('-', $this->only(['admission_year', 'admission_month', 'admission_day']));

        // 下記2つでもできる
        // $birthday = ($this->filled(['birthday_year', 'birthday_month','birthday_day'])) ? $this->birthday_year .'-'. $this->birthday_month .'-'. $this->birthday_day : '';
        //    $birthday =sprintf('%04d-%02d-%02d',$this->birthday_year , $this->birthday_month , $this->birthday_day) ;
        $this->merge([
           'birthday' => $birthday,
           'admission'=> $admission
        ]);
    }
}