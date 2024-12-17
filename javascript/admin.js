console.log("Holaaa");

const data = {
    users: [],
    orders: [],
    articles: []
  };
  
  // Fetch all data from the API (articles, users, orders)
  const fetchAllData = () => {
    // Mostrar un mensaje de carga mientras obtenemos los datos
    console.log("Cargando datos...");
  
    Promise.all([
      fetch('http://localhost/Proyecto1/api.php?resource=articles').then(response => response.json()),
      fetch('http://localhost/Proyecto1/api.php?resource=users').then(response => response.json()),
      fetch('http://localhost/Proyecto1/api.php?resource=orders').then(response => response.json())
    ])
    .then(([articles, users, orders]) => {
      // Verificar que las respuestas son arrays
      if (Array.isArray(articles)) {
        data.articles = articles;
      } else {
        console.error('Error: articles response is not an array');
      }
  
      if (Array.isArray(users)) {
        data.users = users;
      } else {
        console.error('Error: users response is not an array');
      }
  
      if (Array.isArray(orders)) {
        data.orders = orders;
      } else {
        console.error('Error: orders response is not an array');
      }
  
      // Renderizamos las tablas con los nuevos datos
      renderTable('articles');
      renderTable('users');
      renderTable('orders');
    })
    .catch(error => {
      console.error('Error fetching all data:', error);
    })
    .finally(() => {
      console.log("Datos cargados");
    });
  };
  
  // Render table for a given section
  const renderTable = (section) => {
    const container = document.getElementById(`${section}TableContainer`);
    const items = data[section];
  
    // Si no hay elementos, mostrar un mensaje
    if (!items || items.length === 0) {
      container.innerHTML = `<p>No ${section} available.</p>`;
      return;
    }
  
    // Generar el contenido de la tabla
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
  
  // Función para editar un artículo, usuario o pedido
  const editItem = (section, index) => {
    showCreateForm(section);
    const form = document.getElementById('crudForm');
    const keys = Object.keys(data[section][index]);
  
    keys.forEach(key => {
      form[key].value = data[section][index][key];
    });
  
    document.getElementById('crudModalLabel').innerText = `Edit ${section.slice(0, -1)}`;
  };
  
  // Función para eliminar un artículo, usuario o pedido
  const deleteItem = (section, index) => {
    data[section].splice(index, 1);
    renderTable(section);
  };
  
  // Mostrar el formulario para agregar o editar elementos
  const showCreateForm = (section) => {
    const form = document.getElementById('crudForm');
    form.innerHTML = '';
  
    let fields = [];
  
    // Definir los campos dependiendo de la sección
    if (section === 'users') {
      fields = ['Name', 'Surname', 'Email', 'Role'];  // Correspondiente a la tabla USER
    } else if (section === 'orders') {
      fields = ['UserID', 'Date', 'Status', 'PromoCodeID'];  // Correspondiente a la tabla ORDER
    } else if (section === 'articles') {
      fields = ['CategoryID', 'Name', 'Description', 'Price', 'Type'];  // Correspondiente a la tabla ARTICLE
    }
  
    // Crear los campos del formulario
    fields.forEach(field => {
      form.innerHTML += `
        <div class="mb-3">
          <label for="${field}" class="form-label">${field}</label>
          <input type="text" id="${field}" name="${field}" class="form-control" required>
        </div>
      `;
    });
  
    // Establecer el título del modal
    document.getElementById('crudModalLabel').innerText = `Add New ${section.slice(0, -1)}`;
    new bootstrap.Modal(document.getElementById('crudModal')).show();
  };
    
  // Inicializar las tablas
  const initializeTables = () => {
    console.log('Inicializando tablas...');
    ['users', 'orders', 'articles'].forEach(renderTable); // Renderizamos las tablas inicialmente
    fetchAllData();  // Cargamos los datos de la API al iniciar
  };
  
  // Asegurarnos de que el DOM esté completamente cargado antes de ejecutar el script
  document.addEventListener("DOMContentLoaded", initializeTables);
  