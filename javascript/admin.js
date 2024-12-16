const data = {
    users: [],
    orders: [],
    articles: []
  };
  
  // Render table for a given section
  const renderTable = (section) => {
    const container = document.getElementById(`${section}TableContainer`);
    const items = data[section];
  
    if (!items.length) {
      container.innerHTML = `<p>No ${section} available.</p>`;
      return;
    }
  
    let tableHtml = `
      <table class="table table-bordered">
        <thead>
          <tr>
            ${Object.keys(items[0]).map(key => `<th>${key}</th>`).join('')}
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          ${items.map((item, index) => `
            <tr>
              ${Object.values(item).map(value => `<td>${value}</td>`).join('')}
              <td>
                <button class="btn btn-warning btn-sm" onclick="editItem('${section}', ${index})">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deleteItem('${section}', ${index})">Delete</button>
              </td>
            </tr>
          `).join('')}
        </tbody>
      </table>
    `;
    container.innerHTML = tableHtml;
  };
  
  // Show form for adding/updating an item
  const showCreateForm = (section) => {
    const form = document.getElementById('crudForm');
    form.innerHTML = '';
  
    // Fields based on the section
    const fields = section === 'users'
      ? ['Name', 'Email', 'Role']
      : section === 'orders'
      ? ['OrderID', 'Date', 'Amount']
      : ['Title', 'Price', 'Stock'];
  
    fields.forEach(field => {
      form.innerHTML += `
        <div class="mb-3">
          <label for="${field}" class="form-label">${field}</label>
          <input type="text" id="${field}" name="${field}" class="form-control" required>
        </div>
      `;
    });
  
    document.getElementById('crudModalLabel').innerText = `Add New ${section.slice(0, -1)}`;
    new bootstrap.Modal(document.getElementById('crudModal')).show();
  };
  
  // Submit form data
  const submitCrudForm = () => {
    const formData = new FormData(document.getElementById('crudForm'));
    const section = document.getElementById('crudModalLabel').innerText.toLowerCase().includes('user') ? 'users'
      : document.getElementById('crudModalLabel').innerText.toLowerCase().includes('order') ? 'orders' : 'articles';
  
    const newItem = {};
    for (const [key, value] of formData.entries()) {
      newItem[key] = value;
    }
  
    // Add new item
    data[section].push(newItem);
    renderTable(section);
    bootstrap.Modal.getInstance(document.getElementById('crudModal')).hide();
  };
  
  // Edit item
  const editItem = (section, index) => {
    showCreateForm(section);
    const form = document.getElementById('crudForm');
    const keys = Object.keys(data[section][index]);
  
    keys.forEach(key => {
      form[key].value = data[section][index][key];
    });
  
    document.getElementById('crudModalLabel').innerText = `Edit ${section.slice(0, -1)}`;
  };
  
  // Delete item
  const deleteItem = (section, index) => {
    data[section].splice(index, 1);
    renderTable(section);
  };
  
  // Initialize tables
  ['users', 'orders', 'articles'].forEach(renderTable);
  