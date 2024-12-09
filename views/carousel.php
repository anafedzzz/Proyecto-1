<section class="best-selling">
    <p>BEST SELLING PRODUCTS</p>
    <div class="best-selling-carousel">
        <button class="carousel-button previous-button"><</button>

        <div class="scene">
            <div class="carousel-custom">
                <?php
                foreach ($bestselling as $product) {
                    ?>
                    <div id="product-<?= $product->getId(); ?>" class="carousel__cell" style="background-image: url('img/<?= $product->getIMG(); ?>');"></div>
                    <?php
                }
                ?>
            </div>
        </div>
        
        <button class="carousel-button next-button">></button>    
    </div>
    <p>PRODUCTO</p>
    <div>
        <a href="">Añadir al carrito</a>
        <a href="">Más detalles</a>
    </div>
</section>

<style>
    .best-selling{
        display: flex;
        flex-direction: column;
        align-items: center;

        padding-top: 50px;
        padding-bottom: 50px;

        background-color: white;
    }

    .best-selling-carousel{
        display: flex;
        width: 100%;
        justify-content: space-between;
    }

    .carousel-button{
        margin: 50px;
        width: 100px;
        z-index: 10000;
    }

    .scene {
        background-color: rgba(255, 255, 255, 0.393);
        position: relative;
        width: 500px;
        height: 300px;
        margin: 80px;
        perspective: 1000px;
    }

    .carousel-custom{
        width: 100%;
        height: 100%;
        position: absolute;
        transform: translateZ(-288px);
        transform-style: preserve-3d;
        transition: transform 1s;
    }

    .carousel__cell {
        background-color: rgba(255, 255, 255, 0.708);
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;

        position: absolute;
        width: 500px;
        height: 300px;
        left: 10px;
        top: 10px;
        line-height: 116px;
        font-size: 80px;
        font-weight: bold;
        color: white;
        text-align: center;
        transition: transform 1s, opacity 1s;
    }

    .carousel__cell:nth-child(1) { transform: rotateY(  0deg) translateZ(288px); }
    .carousel__cell:nth-child(2) { transform: rotateY( 40deg) translateZ(288px); }
    .carousel__cell:nth-child(3) { transform: rotateY( 80deg) translateZ(288px); }
    .carousel__cell:nth-child(4) { transform: rotateY(120deg) translateZ(288px); }
    .carousel__cell:nth-child(5) { transform: rotateY(160deg) translateZ(288px); }
    .carousel__cell:nth-child(6) { transform: rotateY(200deg) translateZ(288px); }
    .carousel__cell:nth-child(7) { transform: rotateY(240deg) translateZ(288px); }
    .carousel__cell:nth-child(8) { transform: rotateY(280deg) translateZ(288px); }
    .carousel__cell:nth-child(9) { transform: rotateY(320deg) translateZ(288px); }
</style>

<script>

    var carousel = document.querySelector('.carousel-custom');
    var cells = carousel.querySelectorAll('.carousel__cell');
    var cellCount = cells.length; // Calcula dinámicamente el número de celdas
    var selectedIndex = 0;
    var cellWidth = carousel.offsetWidth;
    var cellHeight = carousel.offsetHeight;
    var isHorizontal = true;
    var rotateFn = isHorizontal ? 'rotateY' : 'rotateX';
    var radius, theta;

    // Función para rotar el carrusel
    function rotateCarousel() {
        var angle = theta * selectedIndex * -1;
        carousel.style.transform = 'translateZ(' + -radius + 'px) ' + 
            rotateFn + '(' + angle + 'deg)';
    }

    // Configurar el carrusel al inicio
    function changeCarousel() {
        theta = 360 / cellCount;
        var cellSize = isHorizontal ? cellWidth : cellHeight;
        radius = Math.round((cellSize / 2) / Math.tan(Math.PI / cellCount));
        
        for (var i = 0; i < cells.length; i++) {
            var cell = cells[i];
            if (i < cellCount) {
                // Visible cell
                cell.style.opacity = 1;
                var cellAngle = theta * i;
                cell.style.transform = rotateFn + '(' + cellAngle + 'deg) translateZ(' + radius + 'px)';
            } else {
                // Hidden cell
                cell.style.opacity = 0;
                cell.style.transform = 'none';
            }
        }

        rotateCarousel();
    }

    // Configurar eventos de los botones
    var prevButton = document.querySelector('.previous-button');
    prevButton.addEventListener('click', function () {
        selectedIndex--;
        rotateCarousel();
    });

    var nextButton = document.querySelector('.next-button');
    nextButton.addEventListener('click', function () {
        selectedIndex++;
        rotateCarousel();
    });

    // Inicializa el carrusel al cargar la página
    changeCarousel();

</script>