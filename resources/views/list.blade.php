            @extends('index')
            @section('content')

                <div class="table-responsive">
                    <table class="table table-striped table-no-vertical table w-100">
                        <thead>
                            <tr>
                                <th><a href="{{ route('products.index', ['sort' => 'id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'page' => request('page', 1)]) }}">ID</a></th> 
                                <th><a href="{{ route('products.index', ['sort' => 'img_path', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'page' => request('page', 1)]) }}">商品画像</a></th> 
                                <th><a href="{{ route('products.index', ['sort' => 'product_name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'page' => request('page', 1)]) }}">商品名</a></th>
                                <th><a href="{{ route('products.index', ['sort' => 'price', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'page' => request('page', 1)]) }}">価格</a></th>
                                <th><a href="{{ route('products.index', ['sort' => 'stock', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'page' => request('page', 1)]) }}">在庫数</a></th>
                                <th><a href="{{ route('products.index', ['sort' => 'company_name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'page' => request('page', 1)]) }}">メーカー名</a></th>
                                <th colspan="2">
                                    <a href="{{ route('products.create') }}" class="btn btn-primary touroku">新規登録</a>
                                </th>
                            </tr>
                        </thead>        
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product -> id}}.</td>
                                    <td>
                                        @if( $product -> img_path )
                                            <img src="{{ asset($product->img_path) }}" alt="Product Image" style="width: 100px; height: 100px;">
                                            @else
                                                <p>画像なし</p>
                                            @endif
                                    </td>
                                    <td>{{ $product -> product_name}}</td>
                                    <td>¥{{ $product -> price}}</td>
                                    <td>{{ $product -> stock}}</td>
                                    <td>{{ optional($product->company)->company_name ?? 'No Company' }}</td>
                                    <td><a href="{{ route('products.show', ['id' => $product->id]) }}" class="btn btn-primary syousai">詳細</a></td>
                                    <td>
                                        <button class="sakujyo btn btn-danger" data-delete_id="{{ $product->id }}">削除</button>
                                        {{-- <button class="sakujyo" id="sakujyo" type="button" onclick="confirmDelete({{ $product->id }})">削除</button>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    <div class="pagination justify-content-center">

     {!! $products -> links('pagination::bootstrap-5') !!}

    </div>
@endsection

{{-- @section('scripts')
        <script src="{{ asset('js/list.js') }}"></script>
@endsection --}}