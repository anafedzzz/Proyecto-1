<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Categorías</li>
  </ol>
</nav>

<section class="page-description">
    <h1>CATEGORÍAS</h1>
    <p>Descubre nuestras selecciones gastronómicas especialmente diseñadas para satisfacer todos los gustos. 
    Desde platos innovadores hasta clásicos reinventados, explora las diferentes categorías de productos y 
    encuentra tu próxima experiencia culinaria.</p>
</section>

<section class="categorias container-fluid d-flex">
    <div class="filtros col-3">
        <b>Filtrar por</b>
        <div class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                    Categoría
                </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <?php 
                    foreach ($categories as $category) {}
                        ?>
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                    Precio
                </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                    Alérgenos
                </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                    <div class="accordion-body">

                        

                    </div>
                </div>
            </div>
            </div>
    </div>
    <div class="productos-container">

        <?php 
        foreach ($categories as $category) {
            ?>

            <section class="category-products">
                <h2><?= strtoupper( $category->getName()) ?></h2>
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

            <?php
        }
        
        ?>
    </div>
</section>