@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('no-header','true')

@section('content')
    <div class="thanks">
        <div class="thanks__logo">Thank you</div>

        <div class="thanks__content">
            <p class="thanks__message">お問い合わせありがとうございました</p>
            <a href="/" class="thanks__button">HOME</a>
        </div>
    </div>
@endsection
