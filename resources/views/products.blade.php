<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Каталог</title>
    <!-- Bootstrap icons-->
    <link href="{{ asset('assets/bootstrap-icons.css') }}" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ route('products.index') }}">Магазин</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{ route('orders.index') }}">Все заказы</a></li>
            </ul>
            <form class="d-flex">
                <a href="{{ route('order.index') }}" class="btn btn-outline-dark">
                    Корзина
                    <span class="badge bg-dark text-white ms-1 rounded-pill" id="totalCount"></span>
                </a>
            </form>
        </div>
    </div>
</nav>
<!-- Section-->
<section>
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach($products as $product)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">{{ $product->name }}</h5>
                                <!-- Product price-->
                                {{ $product->format_price }} р
                                <p class="my-3">
                                    <input id="count{{ $product->id }}" type="number" value="1" min="1" style="width: 50%;">
                                </p>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <button class="btn btn-outline-dark mt-auto to-cart"
                                        data-id="{{ $product->id }}">В корзину</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white"> &copy; 2024 <a href="https://t.me/coderws">telegram coderws</a></p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="{{ asset('assets/bootstrap.bundle.min.js') }}"></script>
<!-- Core theme JS-->
<script src="{{ asset('assets/js/scripts.js') }}"></script>

<script>
    function saveProduct(id, count) {
        let products = localStorage.getItem("products");
        if (products === null) {
            localStorage.setItem("products",  JSON.stringify([{id, count},]));
        } else {
            products = JSON.parse(products);
            let isExists = false;
            for (let i = 0; i < products.length; i++) {
                if (products[i].id === id) {
                    products[i].count += count;
                    isExists = true;
                    break;
                }
            }
            if (!isExists) {
                products.push({id, count});
            }
            localStorage.setItem("products",  JSON.stringify(products));
        }
    }

    function loadProductCount() {
        let products = localStorage.getItem("products");
        if (products === null) {
            document.getElementById("totalCount").innerText = '0';
            return;
        }
        let totalCount = 0;
        products = JSON.parse(products);
        for (let i = 0; i < products.length; i++) {
            totalCount += products[i].count;
        }

        document.getElementById("totalCount").innerText = totalCount.toString();
    }

    window.addEventListener("load", function() {
        const cartButtons = document.querySelectorAll('.to-cart');

        cartButtons.forEach(el => el.addEventListener('click', event => {
            const id = parseInt(event.target.getAttribute('data-id'));
            const count = parseInt(document.getElementById('count' + id).value);
            saveProduct(id, count);
            loadProductCount();
        }));

        loadProductCount();
    });
</script>
</body>
</html>
