<div class="container my-5 admin-container">
    <h1 class="text-center admin-title">Admin Panel</h1>

    <!-- Navigation Tabs -->
    <ul class="nav nav-tabs admin-tabs" id="adminTabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link active admin-tab-link" id="users-tab" data-bs-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="true">Users</a>
      </li>
      <li class="nav-item">
        <a class="nav-link admin-tab-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false">Orders</a>
      </li>
      <li class="nav-item">
        <a class="nav-link admin-tab-link" id="articles-tab" data-bs-toggle="tab" href="#articles" role="tab" aria-controls="articles" aria-selected="false">Articles</a>
      </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content mt-4">
      <!-- Users Section -->
      <div class="tab-pane fade show active admin-tab-content" id="users" role="tabpanel" aria-labelledby="users-tab">
        <h3 class="section-title">Manage Users</h3>
        <div class="mb-3">
          <button class="btn btn-primary admin-btn" onclick="showCreateForm('users')">Add User</button>
        </div>
        <div id="usersTableContainer" class="table-container"></div>
      </div>

      <!-- Orders Section -->
      <div class="tab-pane fade admin-tab-content" id="orders" role="tabpanel" aria-labelledby="orders-tab">
        <h3 class="section-title">Manage Orders</h3>
        <div class="mb-3">
          <button class="btn btn-primary admin-btn" onclick="showCreateForm('orders')">Add Order</button>
        </div>
        <div id="ordersTableContainer" class="table-container"></div>
      </div>

      <!-- Articles Section -->
      <div class="tab-pane fade admin-tab-content" id="articles" role="tabpanel" aria-labelledby="articles-tab">
        <h3 class="section-title">Manage Articles</h3>
        <div class="mb-3">
          <button class="btn btn-primary admin-btn" onclick="showCreateForm('articles')">Add Article</button>
        </div>
        <div id="articlesTableContainer" class="table-container"></div>
      </div>
    </div>
  </div>

  <!-- Modal for CRUD Actions -->
  <div class="modal fade" id="crudModal" tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content admin-modal">
        <div class="modal-header admin-modal-header">
          <h5 class="modal-title" id="crudModalLabel">Create/Update</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body admin-modal-body">
          <form id="crudForm" class="admin-form">
            <!-- Form fields dynamically added by JS -->
          </form>
        </div>
        <div class="modal-footer admin-modal-footer">
          <button type="button" class="btn btn-secondary admin-modal-close-btn" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary admin-modal-save-btn" onclick="submitCrudForm()">Save Changes</button>
        </div>
      </div>
    </div>
  </div>

  <script src="javascript/scripts.js"></script>

