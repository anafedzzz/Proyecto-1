<header>
    <div id="preHeader" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item ">
                <p>Promo code <b>TUESDAYSANDWICH</b> for <b>2x1</b> in sandwiches</p>
            </div>
            <div class="carousel-item active">
                <p>otra promo</p>
            </div>
        </div>
    </div> 
    
    <nav class="bottomHeader navbar navbar-expand-lg">
        <div class="container-fluid">
            <div class="header-logo">
                <a href="?controller=restaurant&action=home" class="header-logo__link" data-nav-name="cupra-logo" data-nav-position="Top left|global-header" data-header-logo-link>
                  <?php include 'img/logo.svg'; ?>
                </a>
            </div>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Food
                      <span class="material-icons-outlined">keyboard_arrow_down</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="?controller=restaurant&action=categories#meals">Meals</a></li>
                      <li><a class="dropdown-item" href="?controller=restaurant&action=categories#drinks">Drinks</a></li>
                      <li><a class="dropdown-item" href="?controller=restaurant&action=categories#snacks">Snacks</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Concept
                      <span class="material-icons-outlined">keyboard_arrow_down</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Else
                      <span class="material-icons-outlined">keyboard_arrow_down</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
            </ul>

            <div id="quickSearch" class="quickSearch">
              <form class="form d-flex" onsubmit="return false" data-url="/search.php" data-quick-search-form="">
                <button type="submit" aria-label="Buscar">
                  <span class="material-icons-outlined">search</span>
                </button>
                <input class="form-input" data-search-quick="" name="quick_search_header" id="quick_search_header" data-error-message="El campo de búsqueda no puede estar vacío." placeholder="Buscar..." autocomplete="off" data-last-active-input="">
              </form>
            </div>

            <div class="bottomHeader-item text-right d-flex">
              <nav class="navUser d-flex">
                <ul class="navUser-section navUser-section--link d-flex">
                  <li class="navUser-item">
                    <a class="navUser-action" href="https://en-shop.cupraofficial.com/" data-nav-name="ENG" data-nav-position="User navigation|global-header" aria-label="ENG">
                      ENG
                    </a>
                  </li>
                  <li class="navUser-item">
                    <a class="navUser-action" href="/faqs" aria-label="FAQs">
                      FAQs
                    </a>
                  </li>
                </ul>
                
                <ul class="navUser-section navUser-section--alt d-flex">
                  <li class="navUser-item navUser-item--account">
                    <a class="navUser-action navUserInteraction" data-interaction="Account" href=<?= isset( $_SESSION['user']) ? "?controller=users&action=userPage" : "?controller=users&action=account";?> aria-label="Iniciar sesión" data-login-form="">
                      <i class="bi bi-person"></i>
                    </a>
                  </li>

                  <li class="navUser-item navUser-item--wishlist">
                    <a class="navUser-action navUserInteraction" data-interaction="Wishlist" href=<?= isset( $_SESSION['user']) ? "#" : "?controller=users&action=account";?>>
                      <i class="bi bi-heart"></i>
                    </a>
                  </li>

                  <li class="navUser-item navUser-item--cart">
                    <a class="navUser-action" data-cart-preview="" data-options="align:right" href=<?= isset( $_SESSION['user']) ? "?controller=cart&action=show" : "?controller=users&action=account";?> aria-label="Carrito con 0&nbsp;artículos">
                      <i class="bi bi-cart"></i>
                      <span class="countPill cart-quantity countPill--positive"><?=(isset($_SESSION['cart']) ? count($_SESSION['cart']) : "")?></span>
                    </a>
                    <div class="dropdown-cart" id="cart-preview-dropdown" aria-hidden="true"></div>
                  </li>
                </ul>
              </nav>
            </div>

            <?php 
            if (isset($_SESSION['user'])) {
              if ($_SESSION['user']->getRole_id()==1) {
                ?><a class="btn btn-primary" role="button" href="?controller=restaurant&action=admin">ADMIN</a><?php
              }
            }?>

          </div>
        </div>
    </nav>
</header>