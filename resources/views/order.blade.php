<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Корзина</title>
    <!-- Bootstrap icons-->
    <link href="{{ asset('assets/bootstrap-icons.css') }}" rel="stylesheet"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet"/>
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ route('products.index') }}">Магазин</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{ route('orders.index') }}">Все заказы</a></li>
            </ul>
            <form class="d-flex">
                <a href="{{ route('products.index') }}" class="btn btn-outline-dark">
                    Каталог
                </a>
            </form>
        </div>
    </div>
</nav>
<!-- Section-->
<section>
    <div class="container px-4 px-lg-5 mb-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" id="placeholer">
            <div id="main" class="mb-5" style="min-height: 1000px;">
                <div id="products"></div>
                <p id="totalPrice"></p>
                <button id="applyBtn" class="btn btn-outline-primary">Оформить заказ</button>
            </div>
        </div>
    </div>
</section>
<!-- Footer-->
<footer class="py-5 bg-dark mt-5">
    <div class="container"><p class="m-0 text-center text-white"> &copy; 2024 <a href="https://t.me/coderws">telegram
                coderws</a></p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="{{ asset('assets/bootstrap.bundle.min.js') }}"></script>
<!-- Core theme JS-->
<script src="{{ asset('assets/js/scripts.js') }}"></script>

<script>
    const loadProductsUrl = '{{ route('products.index.ids') }}';
    const saveOrderUrl = '{{ route('order.store') }}';
    let orderProducts;

    function showProducts(products) {
        document.getElementById('main').style.display = products ? 'block' : 'none';
        if (!products) {
            return;
        }
        const productsDiv = document.getElementById('products');
        let totalPrice = 0;
        let html = ``;
        for (let i = 0; i < products.length; i++) {
            const p = products[i];
            html += `<div>${i+1}: ${p.name} ${p.price/100} р ${p.count} шт</div>`;
            totalPrice += p.price;
        }
        productsDiv.innerHTML = html;
        document.getElementById('totalPrice').innerHTML = '<b>Итого: ' + (totalPrice / 100).toString() + ' р</b>';
    }

    function loadProducts() {
        let products = localStorage.getItem("products");
        if (products === null) {
            document.getElementById('main').style.display = 'none';
            document.getElementById('placeholer').innerText = 'Товары не выбраны';
            return;
        }

        fetch(loadProductsUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'url': loadProductsUrl,
            },
            body: JSON.stringify({
                'products': JSON.parse(products)
            })
        }).then(response => response.json())
            .then((data) => {
                orderProducts = data.products;
                showProducts(data.products);
            }).catch(function (error) {
            console.log(error);
        });
    }

    window.addEventListener("load", function () {
        loadProducts();
    });

    document.getElementById("applyBtn").addEventListener("click", function () {
        fetch(saveOrderUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'url': saveOrderUrl,
            },
            body: JSON.stringify({
                'products': orderProducts
            })
        }).then(response => response.json())
            .then((data) => {
                localStorage.clear();
                document.getElementById('applyBtn').remove();
                alert('Заказ № ' + data.order_id + ' успешно оформлен');
            }).catch(function (error) {
            console.log(error);
        });
    });
</script>
</body>
</html>
