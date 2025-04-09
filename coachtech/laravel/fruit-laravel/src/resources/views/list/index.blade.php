@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product/index.css') }}">
@endsection

@section('content')
<div class="product-form__content">
    <div class="product-form__heading">
        <h2>商品一覧</h2>
        <!-- 商品追加ボタン -->
        <div class="add-product-button text-right">
            <a href="{{ route('product.create') }}" class="btn btn-primary">＋ 商品を追加</a>
            <!-- </div> -->
        </div>
    </div>
    <div class="product-row">
        <!-- 左側のサイドバー -->
        <div class="col-md-3">
            <!-- 商品検索フォーム -->
            <form action="{{ route('products.search') }}" method="GET">
                <div class="search-bar">
                    <input type="text" name="search" class="form-control" value="{{ request()->search }}" placeholder="商品名で検索">
                </div>
                <button type="submit" class="btn btn-primary mt-2">検索</button>
            </form>
            <form action="{{ route('products.index') }}" method="GET" id="sortForm">
                <!-- 検索ワードを保持 -->
                <input type="hidden" name="search" value="{{ request()->search }}">

                <div class="sortform-title">価格順で表示
                    <form id="sortForm" action="{{ route('products.index') }}" method="GET">
                        <select name="sort_price" class="form-control" id="sort-price" onchange="document.getElementById('sortForm').submit();">
                            <option value="">価格で並べ替え</option>
                            <option value="asc" {{ request()->sort_price == 'asc' ? 'selected' : '' }}>安い順に表示</option>
                            <option value="desc" {{ request()->sort_price == 'desc' ? 'selected' : '' }}>高い順に表示</option>
                        </select>
                        <!-- 並べ替えが選択されている場合はリセットボタンを表示 -->
                        @if(request()->filled('sort_price'))
                        @if(request()->sort_price == 'asc')
                        <span class="sort_title">安い順に表示</span>
                        @elseif(request()->sort_price == 'desc')
                        <span class="sort_title">高い順に表示</span>
                        @endif
                        <a href="{{ route('products.index') }}" class="clear-sort">
                            <span class="clear-sort-icon">×</span>
                        </a>
                        @endif
                    </form>
                </div>
            </form>
        </div>

        <!-- 右側の商品一覧 -->
        <div class="col-md-9">
            <div class="product-row">
                @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <a href="{{ route('admin.products.show', $product->id) }}" class="product-card-link">
                        <div class="product-card">
                            <div class="product-image mb-2">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                                <h5>
                                    <span>{{ $product->name }}</span>
                                    <span>{{ number_format($product->price) }}円</span>
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>

        <!-- ページネーション -->
        <div class="pagination">
            {{ $products->links() }}
        </div>
    </div>
</div>
</div>
@endsection