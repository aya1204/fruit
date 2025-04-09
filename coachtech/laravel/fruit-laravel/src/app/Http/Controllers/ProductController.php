<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $query = Product::query();

        //商品検索
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        //価格で並び替え
        if ($request->filled('sort_price')) {
            $query->orderBy('price', $request->sort_price);
        }

        //商品一覧を取得（ページネーション）
        $products = $query->paginate(6);

        return view('list.index', compact('products'));
    }

    public function search(Request $request)
    {
        $query = Product::query();

        $search = $request->input('search');

        $products = Product::where('name', 'LIKE', '%' . $search . '%')->paginate(6);

        if($request->has('name') && $request->search){
            $query->where('name', 'like', '%' . strtolower($request->search) .'%');
        }

        return view('list.index', compact('products'));
    }

    public function create()
    {
        //商品登録画面の表示
        return view('auth.register');
    }
}
