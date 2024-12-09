<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn11.bigcommerce.com/s-otp4rjqsbz/product_images/cupra-favicon.png?t=1695226097" rel="shortcut icon">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Round" rel="stylesheet">    
    <link rel="stylesheet" href="./css/styles.css">
    <title>CUPRA PITSTOP - <?php echo strtoupper($_GET['action']); ?> </title>
</head>
<body>

    <?php include 'header.php'; ?>
    <?php include $view; ?>    
    <?php include 'footer.php'; ?>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Carrito</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <!-- Aquí van los elementos del carrito  -->
    </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- darken screen when dropdown -->
    <script>
        document.addEventListener("DOMContentLoaded", function(){
        document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
            everydropdown.addEventListener('shown.bs.dropdown', function () {
                el_overlay = document.createElement('span');
                el_overlay.className = 'screen-darken';
                document.body.appendChild(el_overlay)
            });

            everydropdown.addEventListener('hide.bs.dropdown', function () {
            document.body.removeChild(document.querySelector('.screen-darken'));
            });
        });

        }); 
    </script>
    
</html>