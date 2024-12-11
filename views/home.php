<section id="home-banner">
    <video autoplay muted loop>
        <source src="./video/Video banner.mp4" type="video/mp4">
    </video>
    <div class="content">
        <div class="container-fluid">
            <p>UNA EXPERIENCIA CULINARIA DE ALTO RENDIMIENTO</p>
            <p>DONDE LA PASIÓN POR EL MOTOR SE ENCUENTRA CON LA GASTRONOMÍA</p>
        </div>
        <a class="button-primary-dark" href="#">Probar productos</a>
    </div>
</section>
<section class="categories-home container-fluid">
    <p class="title color-white">MENU</p>
    <div class="row">
        <?php
        foreach ($categories as $category) {
        ?>
            <a href="?controller=restaurant&action=categories#<?= strtolower($category->getName())?>" class="col-xxl-4">
                <div class="category-card" style="background-image: url('img/<?= $category->getIMG(); ?>');">
                    <div>
                        <p class="title"><?= strtoupper($category->getName()) ?></p>
                        <p><?= $category->getDescription() ?></p>
                    </div>
                </div>
            </a>
        <?php
        }
        ?>
    </div>
</section>

<?php include 'carousel.php'; ?>

<section class="events">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-12 event-card">
            <a href="#">
                <p>Event</p>
                <u>Ver más</u>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-12 event-card">
            <a href="#">
                <p>Event</p>
                <u>Ver más</u>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-12 event-card">
            <a href="#">
                <p>Event</p>
                <u>Ver más</u>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-12 event-card">
            <a href="#">
                <p>Event</p>
                <u>Ver más</u>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-12 event-card">
            <a href="#">
                <p>Event</p>
                <u>Ver más</u>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-12 event-card">
            <a href="#">
                <p>Event</p>
                <u>Ver más</u>
            </a>
        </div>
    </div>
</section>