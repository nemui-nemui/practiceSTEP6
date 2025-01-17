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
        fetchProducts();
    });

    $('th a.sortable-link').on('click', function (event) {
        event.preventDefault();
        var sortUrl = $(this).attr('href'); // クリックされたソートリンクのURLを取得
        fetchProducts(sortUrl);  // ソートされた結果を取得
        console.log(sortUrl);
    });

    $('.table').on('click','.sakujyo',function() {
        var deleteConfirm = confirm('本当に削除しますか？');
        if (deleteConfirm == true) {
            var clickEle = $(this)
            var productId  = clickEle.attr('data-delete_id');

            $.ajax({
                type: "POST",
                url: `/YUME/public/products/${productId}`,
                data: {
                    _method: 'DELETE',  // DELETEメソッドを使用
                    _token: $('meta[name="csrf-token"]').attr('content') // CSRFトークン
                },
                success: function (response) {
                    console.log('削除成功:', response);
                    clickEle.closest('tr').remove();  // 削除成功後にその行を削除
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

    function fetchProducts(url = "/YUME/public/products") {
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            data: {
                keyword: $('#keyword').val(),
                company_id: $('#company_id').val(),
                price: priceRange.value,
                stock: stockRange.value
            },
        })
            .done((response) => {
                console.log(response.products);// レスポンスデータの確認
                var $tbody = $('.table tbody');
                $tbody.empty();
                $.each(response.products.data, function (index, product) {
                    var pageIdParam = response.page_id ? `?page_id=${response.page_id}` : '';

                    var detailUrl = `${window.location.origin}/YUME/public/products/${product.id}${pageIdParam}`;
                    console.log(detailUrl); // URLをコンソールに出力して確認

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
                                <form action="${window.location.origin}/YUME/public/products/${product.id}" method="POST" id="delete-form-${product.id}">
                                    <button class="sakujyo" id="sakujyo" type="button" onclick="confirmDelete(${product.id})">削除</button>
                                </form>
                            </td>
                        </tr>
                        `;
                    $tbody.append(html);

                });
            })

            .fail((xhr, status, error) => {
                console.error('Ajaxリクエスト失敗:', status, error);
                console.error('リクエストURL:', xhr.responseURL);
            });
    }
});