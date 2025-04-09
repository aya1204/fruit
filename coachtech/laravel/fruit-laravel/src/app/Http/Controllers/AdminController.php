<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\AuthorRequest;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function show($productId)
    {

        $product = Product::findOrFail($productId);

        return view('admin.show',[
            'product' => $product,
            'seasons' =>explode(',', $product->season)
        ]);
    }


    public function update(AuthorRequest $request, $productId)
    {

        // バリデーション後の入力データを取得
        $validated = $request->validated();

        // バリデーションを手動で行う
        $validator = Validator::make($request->all(), $request->rules(), $request->messages());

        if ($validator->fails()) {
            // バリデーションエラーがあれば、エラーをビューに渡す
            return redirect()->route('admin.products.show', $productId)
                ->withErrors($validator)
                ->withInput();
        }
        
        // 商品更新のためのデータ取得
        $product = Product::findOrFail($productId);

        //季節の処理
        if ($request->has('season')) {
            $validated['season'] = implode(',', $request->season);
        }

        // 画像が選択されていない場合、画像を変更しない
        if (!$request->hasFile('image')) {
            // 新しい画像のアップロード処理
            $fileName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $path = $request->file('image')->storeAs('public/fruits-img', $fileName);
        }else{
            // 画像が選択されていない場合は、既存の画像を保持
            // 特に何も変更しない
            $validated['image'] = $product->image;
        }
        // 商品情報を更新
        $product->update($validated);

        return redirect()->route('products.index')->with('success', '商品情報が更新されました。');

    }

    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);

        //商品を削除
        $product->delete();

        return redirect()->route('products.index')->with('success','商品が削除されました');
    }
}