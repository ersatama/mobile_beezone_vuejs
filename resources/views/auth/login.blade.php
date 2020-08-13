@extends('layouts.main')
@section('content')
    <div class="login">
        <div class="img-logo"></div>
        <div class="login-title">
            <div class="login-title-icon"></div>
            <div class="login-title-desc">Вход/Регистрация</div>
        </div>
        <div class="login-title-form">
            <div class="login-title-form-title">Мобильный телефон</div>
            <div class="login-title-form-input">
                <input type="text" name="phone" class="login-title-form-input-text">
            </div>
            <div class="login-title-form-input">
                <input type="password" name="password" class="login-title-form-input-text">
            </div>
            <div class="login-title-forgot">Забыли пароль?</div>
        </div>
        <div class="login-submit">
            <span>Войти</span>
        </div>
    </div>
@endsection
