<?php
session_start();

// Clase para manejar el estado del carrito
$class = "";
if (isset($_GET['offcanvas'])) {
    $class = $_GET['offcanvas'] == "cart" ? "show" : "";
}

if (isset($_SESSION['cart'])) {
?>

<div class="offcanvas offcanvas-end <?= ($class) ?>" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Carrito</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <?php if (!empty($_SESSION['cart'])): ?>
            <ul class="list-group">
                <?php foreach ($_SESSION['cart'] as $order_line): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">
                                <?=(isset($products[$order_line->getArticleId()]) ? $products[$order_line->getArticleId()]->getName() : $complements[$order_line->getArticleId()]->getName())?>
                            </div>
                            <?=$order_line->getQuantity()?> x <?=$order_line->getPrice()?> €
                        </div>
                        <span class="badge bg-primary rounded-pill">
                            <?=$order_line->getTotal()?> €
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="d-flex gap-2 mt-3">
                <?php
                    foreach ($complements as $complement) {
                        ?>
                        <a class="badge bg-secondary rounded-pill" href="?controller=cart&action=addCart&id=<?=$complement->getId()?>">+ <?=$complement->getName()?></a>
                        <?php
                    }
                ?>
            </div>
            <?php 
                if(isset($_SESSION['cart'])) {
                    $totalSum = array_reduce($_SESSION['cart'], function ($total, $orderLine) {
                    return $total + $orderLine->getTotal();
                    }, 0);

                    $totalSum = number_format($totalSum, 2);
                }
            ?>
            <div class="mt-3 text-end">
                <strong>Total: 
                    <?= $totalSum ?> €
                </strong>
            </div>
            <div class="mt-3 d-flex justify-content-end">
                <a href="?controller=cart&action=show" class="btn btn-primary">Ver carrito</a>
            </div>
        <?php else: ?>
            <p>Tu carrito está vacío.</p>
        <?php endif; ?>
    </div>
</div>

<?php
}
?>