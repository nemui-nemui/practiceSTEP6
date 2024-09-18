            @extends('index')
            @section('content')

                <div class="table-responsive">
                    <table class="table table-striped table-no-vertical table w-100">
                        <thead>
                            <tr>
                                <th>ID</th> 
                                <th>商品画像</th>
                                <th>商品名</th>
                                <th>価格</th>
                                <th>在庫数</th>
                                <th>メーカー名</th>
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
                                    <td><a href="{{ route('products.show', $product->id) }}?page_id={{ $page_id }}" class="btn btn-primary syousai">詳細</a></td>
                                    <td>
                                        <form action="{{ route('products.destroy' ,$product->id) }}" method="POST"  id="delete-form-{{ $product->id }}">
                                            @csrf
                                            <button class="sakujyo" id="sakujyo" type="button" onclick="confirmDelete({{ $product->id }})">削除</button>
                                        </form>
                                    </td>
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

@section('scripts')
        <script src="{{ asset('js/list.js') }}"></script>
@endsection