<main class="container mt-4">
  <div class="row">
    <!-- Order Summary -->
    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-header bg-success text-white">
          <h5>Order Summary</h5>
        </div>
        <div class="card-body">
          <p><strong>Order Number:</strong> #<?=$order->getId()?></p>
          <p><strong>Order Date:</strong> <?=$order->getDate()?></p>
          <p><strong>Total:</strong> <?=$order->getTotal()?>€</p>
          <hr>
          <h6>Items:</h6>
          <ul class="list-group">
            <?php foreach ($order_lines as $order_line) { ?>
              <li class="list-group-item d-flex justify-content-between align-items-center">
              <?=(isset($products[$order_line->getArticleId()]) ? $products[$order_line->getArticleId()]->getName() : $complements[$order_line->getArticleId()]->getName())?> <b>x <?=$order_line->getQuantity()?></b><span class="badge bg-primary rounded-pill"><?=$order_line->getTotal()?> €</span>
              </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>

    <!-- Customer Details -->
    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-header bg-info text-white">
          <h5>Customer Details</h5>
        </div>
        <div class="card-body">
          <p><strong>Name:</strong> <?=$_SESSION['user']->getName()." ".$_SESSION['user']->getSurname()?></p>
          <p><strong>Email:</strong> <?=$_SESSION['user']->getEmail()?></p>
          <p><strong>Phone:</strong> <?=$_SESSION['user']->getPhone_number()?></p>
          <p><strong>Address:</strong> <?=$_SESSION['user']->getAddress()?></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Confirmation Message -->
  <div class="alert alert-success text-center" role="alert">
    Your order has been placed successfully! You will receive an email confirmation shortly.
  </div>

  <!-- Buttons -->
  <div class="text-center d-flex justify-content-center">
    <a href="?controller=restaurant&action=categories" class="btn btn-primary me-2">Continue Shopping</a>
    <a href="?controller=cart&action=orderAgain&id=<?=$order->getId()?>" class="btn btn-primary me-2">Order Again</a>
  </div>
</main>
