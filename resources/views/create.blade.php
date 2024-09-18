<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="{{ asset('css/create_index.css') }}" rel="stylesheet">
    </head>
<body>
    <h1>商品新規登録画面</h1>
    <div class="d-flex justify-content-center align-items-center">
        <div class="container">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="mb-3 row">
                            <label for="productName" class="col-sm-3 col-form-label">商品名<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="productName" class="form-control form-control-sm" id="productName">
                                @error('productName')
                                <span class="text-danger">商品名を入力して下さい</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="productName" class="col-sm-3 col-form-label">メーカー名<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="company" class="form-select form-select-sm" id="companySelect">
                                    <option value="" disabled selected></option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}">
                                            {{ $company->company_name }}
                                        </option>
                                    @endforeach
                                    <option value="new">新規メーカーを入力</option> 
                                </select>

                                <input type="text" name="new_company" id="newCompanyInput" class="form-control mt-2 d-none" placeholder="新しいメーカー名を入力">    

                                @error('company')
                                <span class="text-danger">入力してください</span>
                                @enderror
                                @error('new_company')
                                <span class="text-danger">入力してください</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="productName" class="col-sm-3 col-form-label">価格<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="price" class="form-control form-control-sm" id="price">
                                @error('price')
                                <span class="text-danger">半角数字で入力してください</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="productName" class="col-sm-3 col-form-label">在庫数<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="stock" class="form-control form-control-sm" id="stock">
                                @error('stock')
                                <span class="text-danger">半角数字で入力してください</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="productName" class="col-sm-3 col-form-label">コメント</label>
                            <div class="col-sm-9">
                                <textarea class="form-control form-control-sm" id="comment" name="comment" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="productName" class="col-sm-3 col-form-label">商品画像</label>
                            <div class="col-sm-9">
                                <button type="button" class="btn btn-primary" id="uploadButton">ファイルを選択</button>
                                <input type="file" id="image" name="image" class="d-none">
                                <p id="fileNameDisplay" class="text-muted"></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <button class="touroku" type="submit">新規登録</button>
                                <a href="{{ route('products.index') }}" class="btn btn-primary modoru">戻る</a>

                        </div>
                </form>
        </div>
    </div>

    <script src="{{ asset('js/create.js') }}"></script>

</body>
</html>