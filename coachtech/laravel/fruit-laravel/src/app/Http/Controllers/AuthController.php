<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Product;

class AuthController extends Controller
{
    
    //表示用(GET)
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    //登録処理(POST)
    public function register (AuthorRequest $request)
    {
        $validated = $request->only(['name','price','manual']);

        //季節の処理
        if($request->has('season')){
            $validated['season'] = implode(',', $request->season);
        }

        // 商品画像の保存
        if ($request->hasFile('image')) {

            $fileName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();

            $path = $request->file('image')->storeAs('public/fruits-img', $fileName);
            $validated['image'] = $fileName;
        } else {
            return back()->withErrors(['image' => '画像ファイルが選択されていません'])->withInput();
        }

    // 商品の登録
    Product::create($validated);

        // 商品一覧ページにリダイレクト
        return redirect()->route('products.index');
    }
}
