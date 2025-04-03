@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-form__content">
    <div class="register-form__heading">
        <h2>商品登録</h2>
    </div>
    <form class="form" action="/register" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">商品名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}" />
                </div>
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">値段</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="price" placeholder="値段を入力" value="{{ old('price') }}" />
                </div>
                <div class="form__error">
                    @error('price')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">商品画像</span>
            </div>
            <form action="{{ url('auth/register') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="img">
            </form>
            <div class="form__error">
                @error('img')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">季節</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="checkbox" name="season">春
                    <input type="checkbox" name="season">夏
                    <input type="checkbox" name="season">秋
                    <input type="checkbox" name="season">冬
                </div>
                <div class="form__error">
                    @error('season')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">商品説明</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text-p">
                        <input type="text" name="manual" placeholder="商品の説明を入力" value="{{ old('manual') }}" />
                    </div>
                    <div class="form__error">
                        @error('manual')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">登録</button>
        </div>
    </form>
    <div class="return__button">
        <button class="return__button-submit" type="submit">戻る</button>
    </div>
</div>
@endsection