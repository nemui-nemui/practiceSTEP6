<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="{{ asset('css/custom_index.css') }}" rel="stylesheet">
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    </head>

    <body>
        <h1>商品一覧画面</h1>
        <div class="container">
            <form action="{{ route('products.index') }}" method="GET">
                <div class="d-flex justify-content-between align-items-center mb-4 form-container">
                    <div class="flex-fill">
                        <input type="text" class="form-control"  id="keyword" name="keyword" placeholder="検索キーワード" value="{{ $keyword }}">
                    </div>
                    <div class="flex-fill">
                        <label for="priceRange" class="form-label">価格</label>
                        <input type="range" class="form-range" id="priceRange" name="price" min="{{ $minPrice }}" max="{{ $maxPrice }}" step="10" value="{{ $minPrice }}">
                        <span id="priceValue">{{ $minPrice }}</span> 〜 <span id="maxPriceValue">{{ $maxPrice }}</span>
                    </div>
                    <div class="flex-fill">
                        <label for="stockRange" class="form-label">在庫数</label> 
                        <input type="range" class="form-range" id="stockRange" name="stock" min="{{ $minStock }}" max="{{ $maxStock }}" step="1" value="{{ $minStock }}">
                        <span id="stockValue">{{ $minStock }}</span> 〜 <span id="maxStockValue">{{ $maxStock }}</span>
                    </div>
                    <div class="flex-fill">
                        <select class="form-select" id="company_id" name="company_id">
                            <option value="">メーカー名</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>
                                    {{ $company->company_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-fill">
                        <button type="submit" class="btn btn-outline-primary w-50" id=btn>検索</button>
                    </div>
                </div>
            </form>
            <div id="search-results"></div>
            @yield('content')
        </div>
        @yield('scripts')

        <script src="{{ asset('js/index.js') }}"></script>

    </body>
</html>