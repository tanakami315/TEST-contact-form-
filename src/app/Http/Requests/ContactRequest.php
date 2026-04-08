<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'last_name' => ['required', 'string', 'max:8'],
            'first_name' => ['required', 'string', 'max:8'],
            'gender' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'tel1' => ['required', 'regex:/^[0-9]+$/', 'digits_between:1,5'],
            'tel2' => ['required', 'regex:/^[0-9]+$/', 'digits_between:1,5'],
            'tel3' => ['required', 'regex:/^[0-9]+$/', 'digits_between:1,5'],
            'address' => ['required', 'string', 'max:255'],
            'category_id' => ['required'],
            'detail' => ['required', 'string', 'max:120'],
        ];

    }


    public function messages()
    {
        return[
            'last_name.required' => '姓を入力してください', #必須
            'last_name.string' => '姓を文字列で入力してください',
            'last_name.max' => '姓を8文字以下で入力してください',
            'first_name.required' => '名を入力してください', #必須
            'first_name.string' => '名を文字列で入力してください',
            'first_name.max' => '名を8文字以下で入力してください',
            'gender.required' => '性別を選択してください', #必須
            'email.required' => 'メールアドレスを入力してください', #必須
            'email.string' => 'メールアドレスを文字列で入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください', #必須
            'tel1.required' => '電話番号を入力してください', #必須
            'tel1.regex' => '電話番号は半角数字で入力してください', #必須
            'tel1.digits_between' => '電話番号は5桁まで数字で入力してください', #必須
            'tel2.required' => '電話番号を入力してください', #必須
            'tel2.regex' => '電話番号は半角数字で入力してください', #必須
            'tel2.digits_between' => '電話番号は5桁まで数字で入力してください', #必須
            'tel3.required' => '電話番号を入力してください', #必須
            'tel3.regex' => '電話番号は半角数字で入力してください', #必須
            'tel3.digits_between' => '電話番号は5桁まで数字で入力してください', #必須
            'address.required' => '住所を入力してください', #必須
            'category_id.required' => 'お問い合わせの種類を選択してください',#必須
            'detail.required' => 'お問い合わせ内容を入力してください', #必須
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください', #必須
        ];
    }    
}
