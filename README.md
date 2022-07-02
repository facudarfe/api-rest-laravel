# Basic API REST with Laravel

This is a basic API Rest built in Laravel for manage Products, Providers and Users (Register, login, logout).

Laravel Sanctum is used to authenticate users and generate an API Token.

## Endpoints for Users

```code
POST /api/register
POST /api/login
GET /api/logout
```

## Endpoints for Providers

```code
GET /api/proveedores
GET /api/proveedores/<id>
POST /api/proveedores
PUT /api/proveedores/<id>
DELETE /api/proveedores/<id>
GET /api/proveedores/<id>/productos
POST /api/proveedores/<id>/productos
```

## Endpoints for Products
```code
GET /api/productos
GET /api/productos/<id>
POST /api/productos
PUT /api/productos/<id>
DELETE /api/productos/<id>
```