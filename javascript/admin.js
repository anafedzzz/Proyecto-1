const data = {
    users: JSON.parse(sessionStorage.getItem('users')) || [],
    orders: JSON.parse(sessionStorage.getItem('orders')) || [],
    articles: JSON.parse(sessionStorage.getItem('articles')) || []
};

let fields = [];
let sortOrder = 'asc'; // Variable para almacenar el orden actual
let exchangeRates = {}; // Variable para almacenar las tasas de cambio
  
  
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
      sessionStorage.setItem('articles', JSON.stringify(articles));
    } else {
      console.error('Error: articles response is not an array');
    }

    if (Array.isArray(users)) {
      data.users = users;
      sessionStorage.setItem('users', JSON.stringify(users));
    } else {
      console.error('Error: users response is not an array');
    }

    if (Array.isArray(orders)) {
      data.orders = orders;
      sessionStorage.setItem('orders', JSON.stringify(orders));
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
  let items = data[section];

  // Si no hay elementos, mostrar un mensaje
  if (!items || items.length === 0) {
    container.innerHTML = `<p>No ${section} available.</p>`;
    return;
  }

  // Ordenar los elementos según la sección y el orden actual
  switch (section) {
    case 'users':
      items = items.sort((a, b) => sortOrder === 'asc' ? a.id - b.id : b.id - a.id);
      $orderfield = 'id';
      break;
    case 'orders':
      items = items.sort((a, b) => sortOrder === 'asc' ? new Date(a.date) - new Date(b.date) : new Date(b.date) - new Date(a.date));
      $orderfield = 'date';
      break;
    case 'articles':
      items = items.sort((a, b) => sortOrder === 'asc' ? a.price - b.price : b.price - a.price);
      $orderfield = 'price';
      break;
  }

  // Generar el contenido de los filtros y el botón de ordenación
  const filtersHtml = `
    <div class="mb-3">
      <label>Ordenar por ${$orderfield}</label>
      <button class="btn btn-primary" onclick="toggleSortOrder('${section}')">
        ${sortOrder === 'asc' ? 'Descendente' : 'Ascendente'}
      </button>
    </div>

  `;

  // Generar el contenido de la tabla
  let tableHtml = `
    <table class="table table-bordered">
      <thead>
        <tr>
          ${Object.keys(items[0]).map(key => `<th class="${key}">${key}</th>`).join('')}
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        ${items.map((item, index) => `
          <tr>
            ${Object.values(item).map((value, i) => `<td>${i === 4 ? convertPrice(value) : value}</td>`).join('')}
            <td>
              <button class="btn btn-warning btn-sm" onclick="showUpdateForm('${section}', ${index})">Edit</button>
              <button class="btn btn-danger btn-sm" onclick="deleteItem('${section}', ${index})">Delete</button>
            </td>
          </tr>
        `).join('')}
      </tbody>
    </table>
  `;

  // Insertar los filtros y la tabla en el contenedor
  container.innerHTML = filtersHtml + tableHtml;
};

// Función para cambiar el orden de ordenación
const toggleSortOrder = (section) => {
  sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
  renderTable(section);
};

// Función para ordenar los datos
const sortData = (section) => {
  const criteria = document.getElementById('sortCriteria').value;
  let sortedData;

  switch (criteria) {
    case 'user':
      sortedData = data[section].sort((a, b) => sortOrder === 'asc' ? a.user.localeCompare(b.user) : b.user.localeCompare(a.user));
      break;
    case 'date':
      sortedData = data[section].sort((a, b) => sortOrder === 'asc' ? new Date(a.date) - new Date(b.date) : new Date(b.date) - new Date(a.date));
      break;
    case 'price':
      sortedData = data[section].sort((a, b) => sortOrder === 'asc' ? a.price - b.price : b.price - a.price);
      break;
    default:
      sortedData = data[section];
  }

  renderTableWithSortedData(section, sortedData);
};

// Función para renderizar la tabla con datos ordenados
const renderTableWithSortedData = (section, sortedData) => {
  const container = document.getElementById(`${section}TableContainer`);

  let tableHtml = `
    <table class="table table-bordered">
      <thead>
        <tr>
          ${Object.keys(sortedData[0]).map(key => `<th class="${key}">${key}</th>`).join('')}
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        ${sortedData.map((item, index) => `
          <tr>
            ${Object.values(item).map((value, i) => `<td>${i === 2 ? convertPrice(value) : value}</td>`).join('')}
            <td>
              <button class="btn btn-warning btn-sm" onclick="showUpdateForm('${section}', ${index})">Edit</button>
              <button class="btn btn-danger btn-sm" onclick="deleteItem('${section}', ${index})">Delete</button>
            </td>
          </tr>
        `).join('')}
      </tbody>
    </table>
  `;

  container.innerHTML = container.innerHTML.split('</div>')[0] + '</div>' + tableHtml;
};

// Función para convertir el precio según la moneda seleccionada
const convertPrice = (price) => {
  const currency = document.getElementById('currencySelector').value;
  return (price * exchangeRates[currency]).toFixed(2);
};

// Función para actualizar los precios según la moneda seleccionada
const updatePrices = () => {
  renderTable('articles');
};

// Función para crear un artículo, usuario o pedido
const createItem = (section) => {

  // Obtener el formulario
  const form = document.getElementById('crudForm');

  // Crear un objeto FormData para recoger los datos
  const formData = new FormData(form);

  // Convertir FormData a un objeto simple usando Object.fromEntries
  const newData = Object.fromEntries(formData.entries());

  if (typeof newData.IMG !== 'undefined') {
    newData.IMG = newData.IMG.name
  }

  fetch(`api.php?resource=${section}`, {
    method: 'POST',
    body: formData,
  })
  .then(response => response.json())
  .then(response => {
    if (response.success) {
      alert(`${section.slice(0, -1)} added successfully`);
      location.reload();
      
    } else {
      alert(`Error adding ${section.slice(0, -1)}: ${data.error || 'Unknown error'}`);
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert(`An error occurred while adding the ${section.slice(0, -1)}.`);
  });
    
};

// Función para editar un artículo, usuario o pedido
const updateItem = (section, index) => {
  // Obtener el formulario
  const form = document.getElementById('crudForm');

  // Crear un objeto FormData para recoger los datos
  const formData = new FormData(form);

  // Convertir FormData a un objeto simple usando Object.fromEntries
  const newData = Object.fromEntries(formData.entries());

  if (typeof newData.IMG !== 'undefined') {
    newData.IMG = newData.IMG.name
    if (newData.IMG=="") {
      newData.IMG = data[section][index].IMG
    }
  }

  // Agregar el ID del elemento a actualizar al objeto de datos
  const updatedData = {
    ...newData, // Incluye todos los campos del formulario
    id: data[section][index].id, // Incluye el ID del elemento
  };

  // Enviar la solicitud al backend
  fetch(`api.php?resource=${section}`, {
    method: 'PUT',
    body: JSON.stringify(updatedData), // Enviar datos como un objeto plano
  })
    .then(response => response.json())
    .then(result => {
      if (result.success) {
        alert('Item updated successfully!');
        location.reload();
      } else {
        alert('Error updating item: ' + (result.error || 'Unknown error'));
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('An error occurred while updating the item.');
    });
};
  


// Función para eliminar un artículo, usuario o pedido
const deleteItem = (section, index) => {
  // Confirmación de eliminación
  if (confirm(`Are you sure you want to delete this ${section.slice(0, -1)}?`)) {
    // Eliminar del backend
    fetch(`api.php?resource=${section}`, {
      method: 'DELETE',
      headers: {
          'Content-Type': 'application/json',
      },
      body: JSON.stringify({
          id: data[section][index].id,
      }),
    })
    .then(response => response.json())
    .then(response => {
      if (response.success) {
          // Eliminar del array local
          data[section].splice(index, 1);
          
          // Volver a renderizar la tabla
          renderTable(section);

          alert(`${section.slice(0, -1)} deleted successfully`);
      } else {
          alert(`Error deleting ${section.slice(0, -1)}: ${data.error || 'Unknown error'}`);
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert(`An error occurred while deleting the ${section.slice(0, -1)}.`);
    });
  }
};



// Mostrar el formulario para agregar elementos
const showCreateForm = (section) => {
  const form = document.getElementById('crudForm');
  form.innerHTML = "";


  // Definir los campos dependiendo de la sección
  if (section === 'users') {
    fields = ['name', 'surname', 'email', 'password'];  // Correspondiente a la tabla USER
  } else if (section === 'orders') {
    fields = ['user_id', 'date', 'status', 'promo_code_id'];  // Correspondiente a la tabla ORDER
  } else if (section === 'articles') {
    fields = ['category_id', 'name', 'description', 'price', 'type', 'IMG','novedad'];  // Correspondiente a la tabla ARTICLE
  }

  // Crear los campos del formulario
  fields.forEach(field => {
    console.log(field);
    if (field=="IMG") {
      form.innerHTML += `
      <div class="mb-3">
        <label for="${field}" class="form-label">${field}</label>
        <input type="file" id="${field}" name="${field}" class="form-control" accept="image/*" required>
      </div>
    `;
    } else {
    form.innerHTML += `
      <div class="mb-3">
        <label for="${field}" class="form-label">${field}</label>
        <input type="text" id="${field}" name="${field}" class="form-control" required>
      </div>
    `;
    }
  });

  // Establecer el título del modal
  document.getElementById('crudModalLabel').innerText = `Add New ${section.slice(0, -1)}`;
  new bootstrap.Modal(document.getElementById('crudModal')).show();
  document.getElementById('saveButton').setAttribute('onclick',`createItem('${section}')`) //todo #4
};

// Mostrar el formulario para editar elementos
const showUpdateForm = (section,index) => {
  const form = document.getElementById('crudForm');
  form.innerHTML = '';


  // Definir los campos dependiendo de la sección
  if (section === 'users') {
    fields = ['name', 'surname', 'email', 'role_id', 'phone_number', 'address'];  // Correspondiente a la tabla USER
  } else if (section === 'orders') {
    fields = ['user_id', 'date', 'status', 'promo_code_id'];  // Correspondiente a la tabla ORDER
  } else if (section === 'articles') {
    fields = ['category_id', 'name', 'description', 'price', 'type', 'IMG','novedad'];  // Correspondiente a la tabla ARTICLE
  }

  // Crear los campos del formulario
  fields.forEach(field => {
    if (field=="IMG") {
      form.innerHTML += `
      <div class="mb-3">
        <label for="${field}" class="form-label">${field}</label>
        <img src="${data[section][index][field]}" alt="${data[section][index][field]}">
        <input type="file" value="${data[section][index][field]}" id="${field}" name="${field}" class="form-control" accept="image/*" disabled>
      </div>
    `;
    } else {
      form.innerHTML += `
      <div class="mb-3">
        <label for="${field}" class="form-label">${field}</label>
        <input type="text" value="${(data[section][index][field] == null ? "" : data[section][index][field])}" id="${field}" name="${field}" class="form-control" required>
      </div>
    `;
    }
  });

  // Establecer el título del form
  document.getElementById('crudModalLabel').innerText = `Edit ${section.slice(0, -1)}`;
  new bootstrap.Modal(document.getElementById('crudModal')).show();
  document.getElementById('saveButton').setAttribute('onclick',`updateItem('${section}',${index})`);
};

  
// Inicializar las tablas
const initializeTables = () => {
  console.log('Inicializando tablas...');
  ['users', 'orders', 'articles'].forEach(renderTable); // Renderizamos las tablas inicialmente
  fetchAllData();  // Cargamos los datos de la API al iniciar
};

// Asegurarnos de que el DOM esté completamente cargado antes de ejecutar el script
document.addEventListener("DOMContentLoaded", initializeTables);
