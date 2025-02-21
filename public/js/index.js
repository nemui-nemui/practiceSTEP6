$(function () {
    var priceRange = document.getElementById('priceRange');
    var priceValue = document.getElementById('priceValue');

    priceRange.addEventListener('input', function () {
        priceValue.textContent = priceRange.value;
    });

    var stockRange = document.getElementById('stockRange');
    var stockValue = document.getElementById('stockValue');

    stockRange.addEventListener('input', function () {
        stockValue.textContent = stockRange.value;
    });


    $('#btn').on("click", function (event) {
        event.preventDefault();

        var searchUrl = new URL("/YUME/public/products", window.location.origin);

        searchUrl.searchParams.set('keyword', $('#keyword').val());
        searchUrl.searchParams.set('company_id', $('#company_id').val());
        searchUrl.searchParams.set('price', priceRange.value);
        searchUrl.searchParams.set('stock', stockRange.value);

        console.log("検索時のリクエスト URL:", searchUrl.toString());

        fetchProducts(searchUrl.toString());

    });

    $(document).on('click', 'th a.sortable-link', function (event) {
    // $('th a.sortable-link').on('click', function (event) {
        event.preventDefault();

        console.log("ソートボタンがクリックされました！");

        var sortUrl = new URL($(this).attr('href'), window.location.origin); // クリックされたソートリンクのURLを取得
        console.log("クリック時の Sort URL:", sortUrl.toString());

        var currentDirection = sortUrl.searchParams.get('direction') || 'asc';
        var newDirection = (currentDirection === 'asc') ? 'desc' : 'asc';
        console.log("変更後の direction:", newDirection);

        sortUrl.searchParams.set('direction', newDirection);

        sortUrl.searchParams.set('keyword', $('#keyword').val()); //検索条件
        sortUrl.searchParams.set('company_id', $('#company_id').val());
        sortUrl.searchParams.set('price', priceRange.value);
        sortUrl.searchParams.set('stock', stockRange.value);

        console.log('更新された Sort URL:', sortUrl.toString());

        // console.log('Sort URL:', sortUrl.toString()); // デバッグ用
        // console.log(' fetchProducts() を実行します！'); 
        $(this).attr('href', sortUrl.toString()); // **ソートリンクの `href` を更新** → 次回クリック時に正しい URL がセットされるようにする
        console.log('更新後の href:', $(this).attr('href'));

        fetchProducts(sortUrl.toString());  // .toString()　=URLオブジェクトを文字列として認知させる
    });

    $(document).on('click','.sakujyo',function() {
        var deleteConfirm = confirm('本当に削除しますか？');
        if (deleteConfirm == true) {
            var clickEle = $(this)
            var productId  = clickEle.attr('data-delete_id');
            console.log('取得した productId:', productId); // デバッグ用

            if (!productId) {
                alert('削除対象の商品IDが取得できませんでした');
                return;
            }

            $.ajax({
                type: "POST",
                url: `/YUME/public/products/${productId}`,
                data: {
                    _method: 'DELETE',  // DELETEメソッドを使用
                    _token: $('meta[name="csrf-token"]').attr('content') // CSRFトークン
                },
                success: function (response) {
                    console.log('削除成功:', response);
                    clickEle.closest('tr').fadeOut(300, function () {
                        $(this).remove();  // アニメーション後に削除
                    });
                },
                error: function (xhr, status, error) {
                    console.error('削除リクエスト失敗:', status, error);
                    console.error('リクエストURL:', xhr.responseURL);
                }
            });
        } else {
            return false;
        }
    });

    // function fetchProducts(url = "/YUME/public/products") {
    function fetchProducts(url) {
        var requestUrl = new URL(url, window.location.origin);

        // var sort = new URL(window.location.href).searchParams.get('sort') || 'id';
        // var direction = new URL(window.location.href).searchParams.get('direction') || 'asc';
        // requestUrl.searchParams.set('sort', sort);
        // requestUrl.searchParams.set('direction', direction);

        // requestUrl.searchParams.set('keyword', $('#keyword').val()); //検索条件
        // requestUrl.searchParams.set('company_id', $('#company_id').val());
        // requestUrl.searchParams.set('price', priceRange.value);
        // requestUrl.searchParams.set('stock', stockRange.value);

        // requestUrl.searchParams.set('sort', new URL(window.location.href).searchParams.get('sort') || 'id');
        // requestUrl.searchParams.set('direction', new URL(window.location.href).searchParams.get('direction') || 'asc');

        console.log("送信するリクエスト URL:", requestUrl.toString());

        $.ajax({
            type: "GET",
            url: requestUrl.toString(),
            dataType: "json",
        })
        
            .done((response) => {
                console.log("サーバーからのレスポンス:", response); // デバッグ用
                console.log("取得したデータの方向:", requestUrl.searchParams.get('direction'));　//デバック用

                // if (!response || !response.products) {
                //     console.error("エラー: サーバーのレスポンスが正しくありません！"); // デバッグ用
                //     return;
                // }
            
                // console.log("新しいデータを描画中..."); // デバッグ用

                var $tbody = $('.table tbody');
                $tbody.empty();
                console.log("既存のデータをクリアしました。"); //デバック用

                $.each(response.products.data, function (index, product) {
                    console.log("描画するデータ:", product); // 各商品データのログ

                    var pageIdParam = response.page_id ? `?page_id=${response.page_id}` : '';
                    var detailUrl = `${window.location.origin}/YUME/public/products/${product.id}${pageIdParam}`;
                    console.log("詳細ページ URL:", detailUrl)   //デバック用

                    var html = `
                        <tr>
                            <td>${product.id}</td>
                            <td>
                                ${product.img_path ? `<img src="${product.img_path}" alt="Product Image" style="width: 100px; height: 100px;">` : '<p>画像なし</p>'}
                            </td>
                            <td>${product.product_name}</td>
                            <td>¥${product.price}</td>
                            <td>${product.stock}</td>
                            <td>${product.company ? product.company.company_name : 'No Company'}</td>
                            <td><a href="${detailUrl}" class="btn btn-primary syousai">詳細</a></td>
                            <td>
                                <button class="sakujyo btn btn-danger" type="button" data-delete_id="${product.id}">削除</button>
                            </td>
                        </tr>
                        `;
                    $tbody.append(html);

                });

                console.log("データの描画完了！");  //デバック用

            })

            .fail((xhr, status, error) => {
                console.error('Ajaxリクエスト失敗:', status, error);
                console.error('リクエストURL:', xhr.responseURL);
            });
    }

    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
    
        var pageUrl = new URL($(this).attr('href'), window.location.origin);
        var newPage = parseInt(pageUrl.searchParams.get('page')) || 1;
        console.log("ページネーションのクリック URL:", pageUrl.toString());
        console.log("現在のページ:", newPage);
    
        var sort = new URL(window.location.href).searchParams.get('sort') || 'id';
        var direction = new URL(window.location.href).searchParams.get('direction') || 'asc';
    
        pageUrl.searchParams.set('sort', sort);
        pageUrl.searchParams.set('direction', direction);
        pageUrl.searchParams.set('keyword', $('#keyword').val());
        pageUrl.searchParams.set('company_id', $('#company_id').val());
        pageUrl.searchParams.set('price', priceRange.value);
        pageUrl.searchParams.set('stock', stockRange.value);

        console.log("更新されたページネーション URL:", pageUrl.toString());
    
        fetchProducts(pageUrl.toString());

        // **現在のページを取得**
        var currentPage = parseInt(pageUrl.searchParams.get('page'));
        var lastPage = parseInt($('.pagination').attr('data-last-page'));

        console.log("現在のページ:", currentPage);
        console.log("最終ページ:", lastPage);
    
        // **ページネーションの active クラスを正しく更新**
        $('.pagination .page-item').removeClass('active');
        $('.pagination .page-item').each(function () {
            var pageNumber = new URL($(this).attr('href'), window.location.origin).searchParams.get('page');
            if (pageNumber && parseInt(pageNumber) === currentPage) {
                $(this).addClass('active');
            }
        });
    
        // **「次へ（›）」と「前へ（‹）」の `disabled` クラスを適切に設定**
        $('.pagination .prev-page, .pagination .next-page').parent().removeClass('disabled');
    
        if (currentPage <= 1) {
            $('.pagination .prev-page').parent().addClass('disabled');
        }
        if (currentPage >= lastPage) {
            $('.pagination .next-page').parent().addClass('disabled');
        }

        // **次・前ボタンの href を更新**
        $('.pagination .prev-page').attr('href', pageUrl.toString().replace(/page=\d+/, 'page=' + (currentPage - 1)));
        $('.pagination .next-page').attr('href', pageUrl.toString().replace(/page=\d+/, 'page=' + (currentPage + 1)));
        
        console.log("prev-page クラス:", $('.pagination .prev-page').attr('class'));
        console.log("next-page クラス:", $('.pagination .next-page').attr('class'));
    });
});