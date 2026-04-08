@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/logout.css') }}">
@endsection

@section('content')
<div class="logout">
    <div class="logout__content">
        <p class="logout__message">ログアウトしました</p>
        <a href="/login" class="login__button">Login</a>
    </div>
</div>
@endsection
