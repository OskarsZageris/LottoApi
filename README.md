# LottoApi API Documentation<br>

Introduction:<br>
This API allows you to manage products and a shopping cart.<br>

Base URL:<br>
The base URL for all endpoints is https://api.example.com.<br>

Endpoints:<br>
---------------------------------------------------------------
Create Product:<br>

HTTP Method: POST<br>
Endpoint URL: /create-product<br>
Parameters: None<br>
Request Body:<br>
{<br>
  "name": "string",<br>
  "price": number<br>
}<br>
Response:<br>
{<br>
  "id": number,<br>
  "name": "string",<br>
  "price": number<br>
}<br>
---------------------------------------------------------------
Add Product to Cart:<br>

HTTP Method: POST<br>
Endpoint URL: /cart/api/add-to-cart<br>
Parameters: None<br>
Request Body:<br>
{<br>
  "id": number,<br>
  "quantity": number<br>
}<br>
Response:<br>
{<br>
  "message": "string"<br>
}<br>
---------------------------------------------------------------
Remove Product from Cart:<br>

HTTP Method: DELETE<br>
Endpoint URL: /cart/api/remove-from-cart<br>
Parameters: None<br>
Request Body:<br>
{<br>
  "id": number<br>
}<br>
Response:<br>
{<br>
  "message": "string"<br>
}<br>
---------------------------------------------------------------
List Cart Products:<br>

HTTP Method: GET<br>
Endpoint URL: /cart/api/list-cart-products<br>
Parameters: None<br>
Response:<br>
[<br>
  {<br>
    "id": number,<br>
    "productId": number,<br>
    "name": "string",<br>
    "price": number,<br>
    "quantity": number<br>
  },<br>
  ...<br>
]<br>
---------------------------------------------------------------
Calculate Total:<br>

HTTP Method: GET<br>
Endpoint URL: /cart/api/calculate-total<br>
Parameters: None<br>
Response:<br>
{<br>
  "total": number<br>
}<br>
---------------------------------------------------------------
