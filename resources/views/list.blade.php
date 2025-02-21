            @extends('index')
            @section('content')

                <div class="table-responsive">
                    <table class="table table-striped table-no-vertical table w-100">
                        <thead>
                            <tr>
                                <th><a href="{{ route('products.index', array_merge(request()->query(),[
                                'sort' => 'id', 
                                'direction' => request('direction') === 'asc' ? 'desc' : 'asc',
                                'page' => request('page', 1),
                                'keyword' => request('keyword'),
                                'company_id' => request('company_id'),
                                'price' => request('price'),
                                'stock' => request('stock'),
                                ])) }}" class="sortable-link">ID</a></th> 

                                <th><a href="{{ route('products.index', array_merge(request()->query(),[
                                'sort' => 'img_path',
                                'direction' => request('direction') === 'asc' ? 'desc' : 'asc',
                                'page' => request('page', 1),
                                'keyword' => request('keyword'),
                                'company_id' => request('company_id'),
                                'price' => request('price'),
                                'stock' => request('stock'),
                                ])) }}" class="sortable-link">商品画像</a></th> 

                                <th><a href="{{ route('products.index', array_merge(request()->query(),[
                                'sort' => 'product_name',
                                'direction' => request('direction') === 'asc' ? 'desc' : 'asc',
                                'page' => request('page', 1),
                                'keyword' => request('keyword'),
                                'company_id' => request('company_id'),
                                'price' => request('price'),
                                'stock' => request('stock'),
                                ])) }}" class="sortable-link">商品名</a></th>

                                <th><a href="{{ route('products.index', array_merge(request()->query(),[
                                'sort' => 'price', 
                                'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 
                                'page' => request('page', 1),
                                'keyword' => request('keyword'),
                                'company_id' => request('company_id'),
                                'price' => request('price'),
                                'stock' => request('stock'),
                                ])) }}" class="sortable-link">価格</a></th>

                                <th><a href="{{ route('products.index', array_merge(request()->query(),[
                                'sort' => 'stock', 
                                'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 
                                'page' => request('page', 1),
                                'keyword' => request('keyword'),
                                'company_id' => request('company_id'),
                                'price' => request('price'),
                                'stock' => request('stock'),
                                ])) }}" class="sortable-link">在庫数</a></th>

                                <th><a href="{{ route('products.index', array_merge(request()->query(),[
                                'sort' => 'company_name', 
                                'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 
                                'page' => request('page', 1),
                                'keyword' => request('keyword'),
                                'company_id' => request('company_id'),
                                'price' => request('price'),
                                'stock' => request('stock'),
                                ])) }}" class="sortable-link">メーカー名</a></th>


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
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="pagination-wrapper">
            <ul class="pagination justify-content-center" data-last-page="{{ $products->lastPage() }}" data-current-page="{{ $products->currentPage() }}">
        
                {{-- 「前へ」ボタン --}}
                <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link prev-page"
                       href="{{ $products->onFirstPage() ? '#' : $products->appends(request()->query())->url($products->currentPage() - 1) }}" 
                       rel="prev">‹</a>
                </li>
        
                {{-- ページ番号 --}}
                @foreach (range(1, $products->lastPage()) as $i)
                    <li class="page-item {{ $i == $products->currentPage() ? 'active' : '' }}">
                        <a class="page-link page-number" 
                           href="{{ $products->appends(request()->query())->url($i) }}">{{ $i }}</a>
                    </li>
                @endforeach
        
                {{-- 「次へ」ボタン --}}
                <li class="page-item {{ $products->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link next-page"
                       href="{{ $products->hasMorePages() ? $products->appends(request()->query())->url($products->currentPage() + 1) : '#' }}" 
                       rel="next">›</a>
                </li>
        
            </ul>
        </div>
        

    {{-- <div class="pagination justify-content-center" data-last-page="{{ $products->lastPage() }}">
        {!! $products->appends([
            'sort' => request('sort'), 
            'direction' => request('direction'), 
            'keyword' => request('keyword'), 
            'company_id' => request('company_id'), 
            'price' => request('price'), 
            'stock' => request('stock'),
            'page' => request('page', 1)
        ])->links('pagination::bootstrap-5') !!}
    </div> --}}
    @endsection
