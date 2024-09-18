<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="{{ asset('css/show_index.css') }}" rel="stylesheet">
    </head>
<body>
    <h1>商品情報詳細画面</h1>   
    <div class="d-flex justify-content-center align-items-center">
        <div class="container">
                <form>
                    <div class="row">
                        <div class="mb-3 row">
                            <label for="productId" class="col-sm-3 col-form-label"><i>ID</i></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control-plaintext" id="productId" value="{{ $product->id }}." readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="productName" class="col-sm-3 col-form-label">商品画像</label>
                            <div class="col-sm-9">
                                @if ($product->img_path)
                                    <img src="{{ asset($product->img_path) }}" alt="Product Image" class="img-fluid" style="max-width: 200px;">
                                @else
                                    <p>画像なし</p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="productName" class="col-sm-3 col-form-label">商品名</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control-plaintext" id="productName" value="{{ $product->product_name }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="productName" class="col-sm-3 col-form-label">メーカー</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control-plaintext" id="companyName" value="{{ $product->company->company_name }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="productName" class="col-sm-3 col-form-label">価格</label>
                            <div class="col-sm-9 d-flex align-items-center">
                                <span>¥</span>
                                <input type="text" class="form-control-plaintext" id="price" value="{{ $product->price }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="productName" class="col-sm-3 col-form-label">在庫数</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control-plaintext" id="stock" value="{{ $product->stock }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="productName" class="col-sm-3 col-form-label">コメント</label>
                            <div class="col-sm-9">
                                <textarea class="form-control-plaintext" id="comment" name="comment" rows="3" readonly>{{ $product->comment }}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <a href="{{ route('products.edit' ,  ['id' => $product->id]) }}?page={{ $page_id }}" class="btn btn-primary hensyu">編集</a>
                                <a href="{{ route('products.index') }}?page={{ $page_id }}" class="btn btn-primary modoru">戻る</a>

                        </div>
                </form>
        </div>  
    </div>
    
</body>
</html>