<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="{{ asset('css/edit_index.css') }}" rel="stylesheet">
    </head>
<body>
    <h1>商品情報編集画面</h1>   
    <div class="d-flex justify-content-center align-items-center">
        <div class="container">
                <form action="{{ route('products.update' , $product->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    
                    <div class="row">
                        <div class="mb-3 row">
                            <label for="productId" class="col-sm-3 col-form-label"><i>ID</i></label>
                            <div class="col-sm-8 d-flex justify-content-center">
                                <input type="text" class="form-control-plaintext" id="productId" value="{{ $product->id }}." readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="productName" class="col-sm-3 col-form-label">商品名<span class="text-danger">*</span></label>
                            <div class="col-sm-8 d-flex justify-content-center">
                                <input type="text" name=productName class="form-control form-control-sm"  id="productName" value="{{ old('productName', $product->product_name ) }}">
                                @error('productName')
                                <span class="text-danger">商品名を入力して下さい</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="productName" class="col-sm-3 col-form-label">メーカー名<span class="text-danger">*</span></label>
                            <div class="col-sm-8 d-flex justify-content-center">
                                {{-- <input type="text" class="form-control form-control-sm" id="companyName" value="{{ $product->company->company_name }}"> --}}
                                <select name="company" class="form-select form-select-sm">>
                                    <option value="" disabled selected></option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}"
                                            {{ $product->company_id == $company->id ? 'selected' : '' }}>
                                            {{ $company->company_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('company')
                                <span class="text-danger">選択してください</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="productName" class="col-sm-3 col-form-label">価格<span class="text-danger">*</span></label>
                            <div class="col-sm-8 d-flex justify-content-center">
                                <input type="text" name=price class="form-control form-control-sm" id="price" value="{{ old('price', $product->price) }}">
                                @error('price')
                                <span class="text-danger">半角数字で入力してください</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="productName" class="col-sm-3 col-form-label">在庫数<span class="text-danger">*</span></label>
                            <div class="col-sm-8 d-flex justify-content-center">
                                <input type="text" name=stock class="form-control form-control-sm" id="stock" value="{{ old('stock', $product->stock) }}">
                                @error('stock')
                                <span class="text-danger">半角数字で入力してください</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="productName" class="col-sm-3 col-form-label">コメント</label>
                            <div class="col-sm-8 d-flex justify-content-center">
                                <textarea class="form-control form-control-sm comment" id="comment" name="comment" rows="3">{{ old('comment', $product->comment) }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="productName" class="col-sm-3 col-form-label">商品画像</label>
                            <div class="col-sm-8">
                                <button type="button" class="btn btn-primary" id="uploadButton">ファイルを選択</button>
                                <input type="file" name="image" id="image" class="d-none">
                                <p id="fileNameDisplay" class="text-muted"></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <button class="kousin" type="submit">更新</button>
                                <a href="{{ route('products.show' ,  ['id' => $product->id]) }}?page={{ $page_id }}" class="btn btn-primary modoru">戻る</a>

                        </div>
                    </div>
                </form>
        </div>
    </div>
    <script src="{{ asset('js/edit.js') }}"></script>
</body>
</html>