<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-4">User Profile</h1>
        <a class="btn btn-primary" role="button" href="?controller=users&action=logOut">Log Out</a>
    </div>
    
    <!-- User Details Form -->
    <div class="card mb-5">
      <div class="card-header bg-primary text-white">
        <h5>Update Your Details</h5>
      </div>
      <div class="card-body">
        <form action="?controller=users&action=updateProfile" method="POST">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" value="<?=$_SESSION['user']->getName()?>" required>
          </div>
          <div class="mb-3">
            <label for="surname" class="form-label">Surname</label>
            <input type="text" id="surname" name="surname" class="form-control" placeholder="Enter your surname" value="<?=$_SESSION['user']->getSurname()?>" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" value="<?=$_SESSION['user']->getEmail()?>" readonly>
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter your phone number" value="<?=$_SESSION['user']->getPhone_number()?>">
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea id="address" name="address" class="form-control" placeholder="Enter your address"><?=$_SESSION['user']->getAddress()?></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
      </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="card">
      <div class="card-header bg-secondary text-white">
        <h5>Recent Orders</h5>
      </div>
      <div class="card-body">
        <?php if (is_array($pedidos)): ?>
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $pedido): ?>
                        <tr>
                            <td><?php echo $pedido->getId(); ?></td>
                            <td><?php echo $pedido->getDate(); ?></td>
                            <td><?php echo $pedido->getStatus(); ?></td>
                            <td><?php echo $pedido->getTotal(); ?></td>
                            <td><a class="btn btn-primary" role="button" href="#">More Detail</a></td> 
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p><?php echo "no se encontraron resultados"; ?></p>
        <?php endif; ?>
      </div>
    </div>
  </div>