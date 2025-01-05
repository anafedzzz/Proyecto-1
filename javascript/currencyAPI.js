// Tu clave de API de FreeCurrencyAPI
const apiKey = 'fca_live_zdwgsYIZEY7cl84kU7RJURY1xAO4w4MWPalAWSQZ';

// URL base de FreeCurrencyAPI
const url = `https://api.freecurrencyapi.com/v1/latest?apikey=${apiKey}&currencies=USD%2CCAD%2CEUR&base_currency=EUR`;

// Hacer la solicitud GET usando fetch
fetch(url)
  .then(response => response.json())  // Convertir la respuesta en formato JSON
  .then(data => {
    console.log(data);
    // Aquí puedes usar los datos, por ejemplo:
    exchangeRates = data.data;
    console.log("Tasas de cambio:", exchangeRates);
  })
  .catch(error => {
    console.error("Error al obtener las tasas de cambio:", error);
  });
