<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="?controller=restaurant">Home</a></li>
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
                                    <?php if (isset($_SESSION['cart'])) { ?>
                                        <h6 class="mb-0 text-muted"><?=count($_SESSION['cart'])." ".(count($_SESSION['cart'])>1 ? "items" : "item")?></h6>
                                    <?php } ?>
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
                                if (isset($_SESSION['cart'])) {
                                    $order=0;
                                    foreach ($_SESSION['cart'] as $order_line) {
                                        ?>

                                        <div class="row mb-4 d-flex justify-content-between align-items-center">
                                            <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img
                                                src="img/<?=(isset($products[$order_line->getArticleId()]) ? $products[$order_line->getArticleId()]->getIMG() : "white.avif")?>"
                                                class="img-fluid rounded-3" alt="<?=(isset($products[$order_line->getArticleId()]) ? $products[$order_line->getArticleId()]->getName() : $complements[$order_line->getArticleId()]->getName())?>">
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-3">
                                            <h6 class="text-muted"><?=(isset($products[$order_line->getArticleId()]) ? $categories[$products[$order_line->getArticleId()]->getCategory_id()]->getName() : $categories[$complements[$order_line->getArticleId()]->getCategory_id()]->getName())?></h6>
                                            <h6 class="mb-0"><?=(isset($products[$order_line->getArticleId()]) ? $products[$order_line->getArticleId()]->getName() : $complements[$order_line->getArticleId()]->getName())?></h6>
                                            </div>
                                            
                                            <form action="?controller=cart&action=quantity" method="post" class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                <i class="bi bi-dash-lg"></i>
                                            </button>
                                            <input type="hidden" name="pos" value="<?=$order?>">

                                            <input id="form1" min="0" name="quantity" value="<?=$order_line->getQuantity()?>" type="number" class="form-control form-control-sm" />

                                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                <i class="bi bi-plus-lg"></i>
                                            </button>
                                            </form>

                                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                            <h6 class="mb-0"> <?=$order_line->getTotal()?> €</h6>
                                            </div>
                                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <a href="?controller=cart&action=remove&pos=<?=$order?>" class="text-muted"><i class="bi bi-x-lg"></i></i></a>
                                            </div>
                                        </div>

                                        <hr class="my-4">

                                        <?php
                                        $order++;
                                    }
                                    if ($order==0) {
                                        ?>
                                        <p>No tienes nada en el carrito..</p>
                                        <?php
                                    }
                                }else {
                                    ?>
                                    <p>No tienes nada en el carrito..</p>
                                    <?php
                                }?>


                                <div class="pt-5">
                                    <h6 class="mb-0"><a href="?controller=restaurant&action=categories" class="text-body">
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

                                    <?php 
                                        if(isset($_SESSION['cart'])) {
                                            $totalSum = array_reduce($_SESSION['cart'], function ($total, $orderLine) {
                                            return $total + $orderLine->getTotal();
                                            }, 0);

                                            $totalSum = number_format($totalSum, 2);
                                        }
                                    ?>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <b>Total:</b>
                                        <b><?=isset($totalSum) ? $totalSum : 0?> €</b>
                                    </div>

                                    <hr class="my-4">

                                    <div class="d-flex justify-content-between align-items-center">
                                        <b>IVA incluido en el total:</b>
                                        <b><?=isset($totalSum) ? number_format($totalSum*0.21, 2) : 0 ?> €</b>
                                    </div>

                                    <hr class="my-4">

                                    <form action="?controller=cart&action=complete" method="post" class="product-actions d-flex">
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

