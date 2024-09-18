<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="{{ asset('css/custom_index.css') }}" rel="stylesheet">
    </head>

    <body>
        <h1>商品一覧画面</h1>
        <div class="container">
            <form>
                <div class="d-flex justify-content-between align-items-center mb-4 form-container">
                    <div class="flex-fill">
                        <form action="{{ route('products.index') }}" method="GET">
                        <input type="text" class="form-control" name="keyword" placeholder="検索キーワード" value="{{ $keyword }}" >
                        </form>
                    </div>
                    <div class="flex-fill">
                        <select class="form-select" id="autoSizingSelect" name="company_id">
                            <option value="">メーカー名</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>
                                    {{ $company->company_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-fill">
                        <button type="submit" class="btn btn-outline-primary w-50">検索</button>
                    </div>
                </div>
            </form>
            @yield('content')
        </div>
        @yield('scripts')
    </body>

</html>