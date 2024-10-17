<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Все заказы</title>
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
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row justify-content-center">
            <div id="main" class="mb-5">
                <h3>Все заказы</h3>
                <h4>Общая стоимость всех заказов: {{ round($totalPrice / 100, 2) }} р</h4>
                <table class="table table-striped" style="margin-bottom: 800px;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Дата</th>
                        <th>Товары</th>
                        <th>Стоимость</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ optional($order->created_at)->format('d.m.Y H:i') }}</td>
                                <td>{{ $order->product_names }}</td>
                                <td>{{ round($order->total_price / 100, 2) }}</td>
                                <td><a href="{{ route('orders.delete', [$order->id]) }}" class="text-danger">Удалить</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white"> &copy; 2024 <a href="https://t.me/coderws">telegram
                coderws</a></p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="{{ asset('assets/bootstrap.bundle.min.js') }}"></script>
<!-- Core theme JS-->
<script src="{{ asset('assets/js/scripts.js') }}"></script>

<script>
</script>
</body>
</html>
