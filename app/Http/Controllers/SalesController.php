<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function purchase(Request $request)
{

    // リクエストボディを強制的にJSONとしてデコード
    $data = json_decode($request->getContent(), true);

    try {
        DB::beginTransaction(); 

        // デコード結果からデータを取得
        $productId = $data['product_id'] ?? null;
        $quantity = $data['quantity'] ?? 1;

        if (!isset($productId) || $productId === '') {
            Log::error('Error: 商品IDが指定されていません');
            return response()->json(['message' => '商品IDが指定されていません'], 400, [], JSON_UNESCAPED_UNICODE);
        }

        $product = Product::find($productId);
        Log::info("Product found: " . ($product ? 'Yes' : 'No'));

        if (!$product) {
            Log::error('Error: 商品が見つかりません');
            return response()->json(['message' => '商品が見つかりません'], 404,[], JSON_UNESCAPED_UNICODE);
        }
        
        if ($product->stock < $quantity) {
            Log::error('Error: 在庫がありません');
            return response()->json(['message' => '在庫がありません'], 400, [], JSON_UNESCAPED_UNICODE);
        }

        $product->stock -= $quantity; // $quantityは購入数を指し、デフォルトで1が指定されている
        $product->save();
        Log::info("Stock updated for product ID: $productId");


        $sale = new Sale;
        $sale->product_id = $productId;
        $sale->quantity = $quantity;
        $sale->save();
        Log::info("Sale record created with ID: $sale->id");

        DB::commit();

        Log::info('Returning success response: 購入完了');
        return response()->json(['message' => '購入完了'], 200, [], JSON_UNESCAPED_UNICODE);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['message' => '購入処理に失敗しました', 'error' => $e->getMessage()], 500);
    }
}

}