<div class="container my-5">
  <!-- Pills navs -->
  <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="tab-login" data-bs-toggle="pill" href="#pills-login" role="tab"
      aria-controls="pills-login" aria-selected="true">Login</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="tab-register" data-bs-toggle="pill" href="#pills-register" role="tab"
      aria-controls="pills-register" aria-selected="false">Register</a>
    </li>
  </ul>
  <!-- Pills navs -->

  <!-- Pills content -->
  <div class="tab-content">
    <!-- LOG IN -->
    <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
        <form action="?controller=users&action=logIn" method="post">
          <div class="text-center mb-3">
            <p>Sign in with:</p>
            <br>
            <button type="button" class="btn btn-outline-secondary btn-floating mx-1">
              <i class="bi bi-facebook"></i>
            </button>
            <button type="button" class="btn btn-outline-secondary btn-floating mx-1">
              <i class="bi bi-google"></i>
            </button>
            <button type="button" class="btn btn-outline-secondary btn-floating mx-1">
              <i class="bi bi-twitter"></i>
            </button>
            <button type="button" class="btn btn-outline-secondary btn-floating mx-1">
              <i class="bi bi-github"></i>
            </button>
          </div>

          <p class="text-center">or:</p>

          <!-- Email input -->
          <div class="mb-4">
            <label for="loginName" class="form-label">Email or username</label>
            <input name="mail" type="email" id="loginName" class="form-control">
          </div>

          <!-- Password input -->
          <div class="mb-4">
            <label for="loginPassword" class="form-label">Password</label>
            <input name="password" type="password" id="loginPassword" class="form-control">
          </div>

          <!-- Checkbox -->
          <div class="d-flex justify-content-between mb-4">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="loginCheck" name="rememberMe" value="1">
            <label class="form-check-label" for="loginCheck">Remember me</label>
          </div>
              <a href="#!">Forgot password?</a>
          </div>

          <!-- Submit button -->
          <button type="submit" class="btn btn-primary w-100">Sign in</button>
        </form>
    </div>

    <!-- REGISTER -->
    <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
    <form action="?controller=users&action=register" method="post">
        <div class="text-center mb-3">
          <p>Sign up with:</p>
          <br>
          <button type="button" class="btn btn-outline-secondary btn-floating mx-1">
            <i class="bi bi-facebook"></i>
          </button>
          <button type="button" class="btn btn-outline-secondary btn-floating mx-1">
            <i class="bi bi-google"></i>
          </button>
          <button type="button" class="btn btn-outline-secondary btn-floating mx-1">
            <i class="bi bi-twitter"></i>
          </button>
          <button type="button" class="btn btn-outline-secondary btn-floating mx-1">
            <i class="bi bi-github"></i>
          </button>
        </div>

        <p class="text-center">or:</p>

        <!-- Name input -->
        <div class="mb-4">
          <label for="registerName" class="form-label">Name</label>
          <input name="name" type="text" id="registerName" class="form-control">
        </div>

        <!-- Username input -->
        <div class="mb-4">
          <label for="registerUsername" class="form-label">Surname</label>
          <input name="surname" type="text" id="registerSurname" class="form-control">
        </div>

        <!-- Email input -->
        <div class="mb-4">
          <label for="registerEmail" class="form-label">Email</label>
          <input name="mail" type="email" id="registerEmail" class="form-control">
        </div>

        <!-- error -->
        <?php
        // session_start();
        if (isset($_SESSION['error'])) {
        ?>
        <div class="alert alert-danger" role="alert">
          <?=$_SESSION['error']?>
        </div>
        <?php
          unset($_SESSION['error']);
        }
        ?>

        <!-- Password input -->
        <div class="mb-4">
          <label for="registerPassword" class="form-label">Password</label>
          <input name="password" type="password" id="registerPassword" class="form-control">
        </div>

        <!-- Repeat Password input -->
        <div class="mb-4">
          <label for="registerRepeatPassword" class="form-label">Repeat password</label>
          <input type="password" id="registerRepeatPassword" class="form-control">
        </div>

        <!-- Checkbox -->
        <div class="form-check d-flex justify-content-center mb-4">
          <input class="form-check-input me-2" type="checkbox" id="registerCheck" checked>
          <label class="form-check-label" for="registerCheck">
            I have read and agree to the terms
          </label>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary w-100">Sign up</button>
      </form>
    </div>
  </div>
  <!-- Pills content -->
</div>
