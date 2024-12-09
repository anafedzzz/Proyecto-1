<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="#">Home</a></li>
  <li class="breadcrumb-item"><a href="#">Categorías</a></li>
  <li class="breadcrumb-item"><a href="#"><?=$category->getName()?></a></li>
  <li class="breadcrumb-item active" aria-current="page"><?=$product->getName()?></li>
  </ol>
</nav>

<?php $novedad = $product->getNovedad() == true ? "" : "hidden"; ?>

<section class="row product-page d-flex">
    <div class="col-md-6 product-img" style="background-image: url('img/<?= $product->getIMG(); ?>');">
        <div class="d-flex">
            <p class="novedad <?=$novedad;?>">Novedad</p>
        </div>  
    </div>
    <div class="product-details col-md-6 d-flex">
        <p><?=strtoupper($category->getName())?><br>Reference: id_<?=$product->getId()?></p>
        <h2><?=$product->getName()?></h2>
        <p class="price"><?=$product->getPrice()?>€</p>
        <p><?=$product->getDescription()?></p>
        <div>
            <p>Cantidad:</p>
            <form action=""  class="product-actions d-flex">
                <input value="1" class="quantity-button" type="number" name="quantity" id="">
                <input type="hidden" name="productId" value="<?=$product->getId()?>">
                <input class="button-add-to-bag" type="submit" value="AÑADIR AL CARRITO">
                <i class="bi bi-heart"></i>
                <i class="bi bi-share"></i>
            </form>
        </div>
    </div>
</section>

<section class="related-products">
    <h3>Productos Relacionados</h3>
    <div class="row">
    <?php 
        foreach ($products as $product) {
            if ($category->getId()==$product->getCategory_id()) {
                $novedad = $product->getNovedad() == true ? "" : "hidden";
            ?>
            <div class="product-card" style="width: 18rem;">
                <div class="product-img" style="background-image: url('img/<?= $product->getIMG(); ?>');">
                    <div class="d-flex">
                        <p class="novedad <?=$novedad;?>">Novedad</p>
                        <div class="product-card-icons">
                            <i class="bi bi-heart"></i>
                            <i class="bi bi-cart"></i>
                        </div>
                    </div>    
                </div>
                <a href=""><h5 class="card-title"><?= $product->getName(); ?></h5></a>
                <p class="price card-text"><?= $product->getPrice(); ?>€</p>
            </div>
            <?php
            }
        }
    ?>
    </div>
</section>

