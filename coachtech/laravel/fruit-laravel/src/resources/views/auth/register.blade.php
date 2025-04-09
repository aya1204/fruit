@extends('layouts.app')
<style>
    .form__error {
        color: red;
    }

    ul {
        list-style-type: none;
        padding-left: 0;
    }
</style>

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
<div class="register-form__content">
    <div class="register-form__heading">
        <h2>商品登録</h2>
    </div>
    <form class="form" action="/products/register" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">商品名</span>
                <span class="form__label--item-p">必須</span>
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
                <span class="form__label--item-p">必須</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="price" placeholder="値段を入力" value="{{ old('price') }}" />
                </div>
                <div class="form__error">
                    @if ($errors->has('price'))
                    <ul>
                        @foreach ($errors->get('price') as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">商品画像</span>
                <span class="form__label--item-p">必須</span>
            </div>
            <input type="file" name="image" value="{{ old('image') }}">
            <div class="form__error">
                @if ($errors->has('image'))
                <ul>
                    @foreach ($errors->get('image') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">季節</span>
                <span class="form__label--item-p">必須</span>
                <span class="form__label--item-text">複数選択可</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input class="check" type="checkbox" name="season[]" value="春" {{ in_array('春', old('season',[])) ? 'checked' : '' }}>春
                    <input class="check" type="checkbox" name="season[]" value="夏" {{ in_array('春', old('season',[])) ? 'checked' : '' }}>夏
                    <input class="check" type="checkbox" name="season[]" value="秋" {{ in_array('秋', old('season',[])) ? 'checked' : '' }}>秋
                    <input class="check" type="checkbox" name="season[]" value="冬" {{ in_array('冬', old('season',[])) ? 'checked' : '' }}>冬
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
                    <span class="form__label--item-p">必須</span>
                </div>
                <div class="form__group-content-manual">
                    <div class="form__input--text">
                        <textarea class="manual" name="manual" placeholder="商品の説明を入力">{{ old('manual') }}</textarea>
                    </div>
                    <div class="form__error">
                        @if ($errors->has('manual'))
                        <ul>
                            @foreach ($errors->get('manual') as $message)
                            <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="return__button-submit" type="submit">戻る</button>
            <button class="form__button-submit" type="submit">登録</button>
        </div>
    </form>
</div>
@endsection