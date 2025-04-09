<!-- 商品変更画面 -->
@extends('layouts.app')
<style>
    .text-danger {
        color: red;
    }

    ul {
        list-style-type: none;
        padding-left: 0;
        margin-top: 5px;
    }
</style>

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/show.css') }}">
@endsection

@section('content')
<nav>
    <ul class="header-nav">
        <li class="header-nav__item">
            <a class="header-nav__link" href="/products">商品一覧</a>
            <span> &gt; </span>
            <span>{{ $product->name }}</span>
        </li>
    </ul>
</nav>

<div class="product-detail">
    <form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- 商品画像と商品情報を横並び -->
        <div class="product-top">
            <!-- 左：画像 -->
            <div class="product-image">
                @if (!$errors->has('image') && $product->image && !old('image'))
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                @elseif (old('image'))
                <img src="{{ asset('storage/' . old('image')) }}" alt="新しい画像">
                @endif
                <!-- 画像の変更 -->
                <input type="file" id="image" name="image" class="form-control">
                @if ($errors->has('image'))
                <ul>
                    @foreach ($errors->get('image') as $message)
                    <li class="text-danger">{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

            <!-- 右：商品名、値段、季節 -->
            <div class="product-info">
                <!-- 商品名 -->
                <div class="form__group">
                    <label for="name">商品名</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" class="form-control">
                    @if ($errors->has('name'))
                    <ul>
                        @foreach ($errors->get('name') as $message)
                        <li class="text-danger">{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

                <!-- 値段 -->
                <div class="form__group">
                    <label for="price">値段</label>
                    <input type="text" id="price" name="price" value="{{old('price', $product->price) }}" class="form-control">
                    @if ($errors->has('price'))
                    <ul>
                        @foreach ($errors->get('price') as $message)
                        <li class="text-danger">{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

                <!-- 季節チェックボックス -->
                <div class="form__group">
                    <label for="season">季節</label>
                    <div class="season-checkboxes">
                        <input class="check" type="checkbox" id="season_spring" name="season[]" value="春" {{ in_array('春', old('season',$seasons ?? [])) ? 'checked' : '' }}>春
                        <input class="check" type="checkbox" id="season_summer" name="season[]" value="夏" {{ in_array('夏', old('season',$seasons ?? [])) ? 'checked' : '' }}>夏
                        <input class="check" type="checkbox" id="season_autumn" name="season[]" value="秋" {{ in_array('秋', old('season',$seasons ?? [])) ? 'checked' : '' }}>秋
                        <input class="check" type="checkbox" id="season_winter" name="season[]" value="冬" {{ in_array('冬', old('season',$seasons ?? [])) ? 'checked' : '' }}>冬
                    </div>
                    @if ($errors->has('season'))
                    <ul>
                        @foreach ($errors->get('season') as $message)
                        <li class="text-danger">{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>

        <!-- 商品説明 -->
        <div class="form__group">
            <label for="manual">商品説明</label>
            <textarea name="manual" class="manual">{{ old('manual', $product->manual) }}</textarea>
            @if ($errors->has('manual'))
            <ul>
                @foreach ($errors->get('manual') as $message)
                <li class="text-danger">{{ $message }}</li>
                @endforeach
            </ul>
            @endif
        </div>

        <!-- 戻るボタンと変更を保存ボタン -->
        <div class="form__actions-wrapper">
            <div class="form__actions">
                <a href="{{ route('products.index') }}" class="btn btn-back">戻る</a>
                <button type="submit" class="btn btn-primary">変更を保存</button>
            </div>

            <div class="form__actions-delete">
                <button type="submit" form="delete-form" class="btn btn-danger btn-icon">
                    <img src="{{ asset('storage/images/trash.png') }}" alt="" width="20">
                </button>
            </div>
        </div>
    </form>

    <form id="delete-form" action="{{route('admin.destroy', $product->id) }}" method="POST"></form>
</div>

@endsection