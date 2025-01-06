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
        <div class="accordion" id="filtersAccordion">
            <!-- Categoría -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#categoryFilter" aria-expanded="false">
                        Categoría
                    </button>
                </h2>
                <div id="categoryFilter" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <?php foreach ($categories as $category): ?>
                            <div class="form-check">
                                <input class="form-check-input category-filter" type="checkbox" value="<?= $category->getId() ?>" id="category_<?= $category->getId() ?>">
                                <label class="form-check-label" for="category_<?= $category->getId() ?>">
                                    <?= $category->getName() ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Precio -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#priceFilter" aria-expanded="false">
                        Precio
                    </button>
                </h2>
                <div id="priceFilter" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <label for="minPrice" class="form-label">Precio mínimo:</label>
                        <input type="number" id="minPrice" class="form-control price-filter" placeholder="Min">
                        <label for="maxPrice" class="form-label mt-2">Precio máximo:</label>
                        <input type="number" id="maxPrice" class="form-control price-filter" placeholder="Max">
                    </div>
                </div>
            </div>

            <!-- Alérgenos -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#allergensFilter" aria-expanded="false">
                        Alérgenos
                    </button>
                </h2>
                <div id="allergensFilter" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <?php foreach ($allergens as $allergen): ?>
                            <div class="form-check">
                                <input class="form-check-input allergen-filter" type="checkbox" value="<?= $allergen->getId() ?>" id="allergen_<?= $allergen->getId() ?>">
                                <label class="form-check-label" for="allergen_<?= $allergen->getId() ?>">
                                    <?= $allergen->getName() ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
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
                <h2 id="<?= strtolower($category->getName())?>"><?= strtoupper( $category->getName()) ?></h2>
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
                                        <form action="?controller=cart&action=addCart" method="post">
                                            <input hidden name="id" value="<?= $product->getId() ?>">
                                            <button type="submit" class="add-to-cart"><i class="bi bi-cart"></i></button>
                                        </form>
                                    </div>
                                </div>    
                            </div>
                            <a href="?controller=restaurant&action=product&id=<?= $product->getId()?>"><h5 class="card-title"><?= $product->getName(); ?></h5></a>
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