<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="#">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page">Carrito</li>
  </ol>
</nav>

<section class="cart">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card card-registration card-registration-2">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-lg-8">
                            <div class="p-5">
                                <div class="d-flex justify-content-between align-items-center mb-5">
                                    <h1 class="fw-bold mb-0">MI CARRITO</h1>
                                    <h6 class="mb-0 text-muted">3 items</h6>
                                </div>

                                <div class="row mb-4 d-flex justify-content-between align-items-center">
                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                    <b>Artículo</b>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                    </div>
                                    
                                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                    <b>Cantidad</b>
                                    </div>

                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                    <b>Precio</b>
                                    </div>
                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                    </div>
                                </div>

                                <hr class="my-4">

                                <?php
                                    foreach ($_SESSION['cart'] as $order_line) {
                                        ?>

                                        <div class="row mb-4 d-flex justify-content-between align-items-center">
                                            <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img
                                                src="img/<?=$articles[$order_line->getArticleId()]->getIMG()?>"
                                                class="img-fluid rounded-3" alt="<?=$articles[$order_line->getArticleId()]->getName()?>">
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-3">
                                            <h6 class="text-muted"><?=$articles[$order_line->getArticleId()]->getName()?></h6>
                                            <h6 class="mb-0"><?=$articles[$order_line->getArticleId()]->getName()?></h6>
                                            </div>
                                            
                                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                <i class="bi bi-dash-lg"></i>
                                            </button>

                                            <input id="form1" min="0" name="quantity" value="1" type="number"
                                                class="form-control form-control-sm" />

                                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                <i class="bi bi-plus-lg"></i>
                                            </button>
                                            </div>
                                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                            <h6 class="mb-0">€ 44.00</h6>
                                            </div>
                                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <a href="#" class="text-muted"><i class="bi bi-x-lg"></i></i></a>
                                            </div>
                                        </div>

                                        <hr class="my-4">

                                        <?php
                                    }
                                ?>

                                <div class="row mb-4 d-flex justify-content-between align-items-center">
                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                    <img
                                        src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img5.webp"
                                        class="img-fluid rounded-3" alt="Cotton T-shirt">
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                    <h6 class="text-muted">Shirt</h6>
                                    <h6 class="mb-0">Cotton T-shirt</h6>
                                    </div>
                                    
                                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                        <i class="bi bi-dash-lg"></i>
                                    </button>

                                    <input id="form1" min="0" name="quantity" value="1" type="number"
                                        class="form-control form-control-sm" />

                                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                    </div>
                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                    <h6 class="mb-0">€ 44.00</h6>
                                    </div>
                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                    <a href="#" class="text-muted"><i class="bi bi-x-lg"></i></i></a>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="pt-5">
                                    <h6 class="mb-0"><a href="#!" class="text-body">
                                        <i class="bi bi-box-arrow-in-left"></i> Seguir comprando</a>
                                    </h6>
                                </div>
                                </div>
                            </div>
                            <div class="col-lg-4 bg-body-tertiary">
                                <div class="p-5">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <b>Código de cupón:</b>
                                        <a href="">Añadir cupón</a>
                                    </div>

                                    <hr class="my-4">

                                    <div class="d-flex justify-content-between align-items-center">
                                        <b>Total:</b>
                                        <b>4.00€</b>
                                    </div>

                                    <hr class="my-4">

                                    <div class="d-flex justify-content-between align-items-center">
                                        <b>IVA incluido en el total:</b>
                                        <b>4.00€</b>
                                    </div>

                                    <hr class="my-4">

                                    <form action=""  class="product-actions d-flex">
                                        <input class="button-add-to-bag" type="submit" value="PROCESO DE PAGO">
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

