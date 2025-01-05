class APIManager {
    constructor(baseURL) {
        this.baseURL = baseURL;
    }
  
    async fetchData(resource) {
      try {
        const response = await fetch(`${this.baseURL}?resource=${resource}`);
        if (!response.ok) throw new Error(`Error fetching ${resource}`);
        return await response.json();
      } catch (error) {
        console.error(`APIManager fetchData Error:`, error);
        throw error;
      }
    }
  
    async createItem(section, data) {
        fetch(`api.php?resource=${section}`, {
        method: 'POST',
        body: data,
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
    }
  
    async updateItem(section, data) {
        fetch(`api.php?resource=${section}`, {
            method: 'PUT',
            body: JSON.stringify(data), // Enviar datos como un objeto plano
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
    }
  
    async deleteItem(section, id) {
        fetch(`api.php?resource=${section}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id: id,
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
          });
    }
}

export default APIManager;
  