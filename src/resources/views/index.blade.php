@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact__content">
    <div class="contact__heading">
        <h2>Contact</h2>
    </div>

    <div class="contact-form__group">
        <form action="/confirm" method="post" novalidate>
            @csrf
            <div class="contact-form__item">
                <div class="contact-form__label">
                    <label class="contact-form__label-text">お名前</label>
                    <span class="contact-form__required">※</span>
                </div>
                <div class="contact-form__set">
                    <div class="contact-form__content">
                        <input class="contact-form__input--long" type="text" name="last_name" placeholder="例：山田" value="{{ old('last_name') }}" />
                        <div class="contact-form__error">
                            @error('last_name')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="contact-form__content">
                        <input class="contact-form__input--long" type="text" name="first_name" placeholder="例：太郎" value="{{ old('first_name') }}" />
                        <div class="contact-form__error">
                            @error('first_name')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-form__item">
                <div class="contact-form__label">
                    <label class="contact-form__label-text">性別</label>
                    <span class="contact-form__required">※</span>
                </div>
                <div class="contact-form__content">
                    <div class="contact-form__content--gender">
                        <div class="contact-form__radio-choice">
                            <input class="contact-form__input--radio" type="radio" name="gender" value="1"
                                {{ old('gender') == '1' ? 'checked' : '' }}/>
                            <span class="contact-form__input">男性</span>
                        </div>
                        <div class="contact-form__radio-choice">
                            <input class="contact-form__input--radio" type="radio" name="gender" value="2"
                                {{ old('gender') == '2' ? 'checked' : '' }}/>
                            <span class="contact-form__input">女性</span>
                        </div>
                        <div class="contact-form__radio-choices">
                            <input class="contact-form__input--radio" type="radio" name="gender" value="3"
                                {{ old('gender') == '3' ? 'checked' : '' }}/>
                            <span class="contact-form__input">その他</span>
                        </div>
                    </div>
                    <div class="contact-form__error">
                        @error('gender')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="contact-form__item">
                <div class="contact-form__label">
                    <label class="contact-form__label-text">メールアドレス</label>
                    <span class="contact-form__required">※</span>
                </div>
                <div class="contact-form__content">
                    <input class="contact-form__input--long" type="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}" />
                    <div class="contact-form__error">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="contact-form__item">
                <div class="contact-form__label">
                    <label class="contact-form__label-text">電話番号</label>
                    <span class="contact-form__required">※</span>
                </div>
                <div class="contact-form__content">
                    <div class="contact-form__content--tel">
                        <input class="contact-form__input--short" type="tel" name="tel1" placeholder="090" value="{{ old('tel1') }}" />
                        <span class="contact-form__hyphen">-</span>
                        <input class="contact-form__input--short" type="tel" name="tel2" placeholder="1234" value="{{ old('tel2') }}" />
                        <span class="contact-form__hyphen">-</span>
                        <input class="contact-form__input--short" type="tel" name="tel3" placeholder="5678" value="{{ old('tel3') }}" />
                    </div>
                    <div class="contact-form__error">
                        @if ($errors->has('tel1'))
                            {{ $errors->first('tel1') }}
                        @elseif ($errors->has('tel2'))
                            {{ $errors->first('tel2') }}
                        @elseif ($errors->has('tel3'))
                            {{ $errors->first('tel3') }}
                        @endif
                    </div>
                </div>
            </div>

            <div class="contact-form__item">
                <div class="contact-form__label">
                    <label class="contact-form__label-text">住所</label>
                    <span class="contact-form__required">※</span>
                </div>
                <div class="contact-form__content">
                    <input class="contact-form__input--long" type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}" />
                    <div class="contact-form__error">
                        @error('address')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="contact-form__item">
                <div class="contact-form__label">
                    <label class="contact-form__label-text">建物名</label>
                    <span class="contact-form__required"></span>
                </div>
                <div class="contact-form__content">
                    <input class="contact-form__input--long" type="text" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building') }}" />
                </div>
            </div>

            <div class="contact-form__item">
                <div class="contact-form__label">
                    <label class="contact-form__label-text">お問い合わせの種類</label>
                    <span class="contact-form__required">※</span>
                </div>
                <div class="contact-form__content">
                    <select class="contact-form__input--middle" name="category_id">
                        <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>
                            選択してください
                        </option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"{{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->content }}
                            </option>
                        @endforeach
                    </select>
                    <div class="contact-form__error">
                        @error('category_id')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="contact-form__item">
                <div class="contact-form__label">
                    <label class="contact-form__label-text">お問い合わせ内容</label>
                    <span class="contact-form__required">※</span>
                </div>
                <div class="contact-form__content">
                    <textarea class="contact-form__input--textarea" name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                    <div class="contact-form__error">
                        @error('detail')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="contact-form__button">
                <button class="contact-form__button-submit" type="submit">確認画面</button>
            </div>
        </form>
    </div>
</div>
@endsection

