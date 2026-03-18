# Hello Deer POS API - AI Development Guide

## Project Overview
This is a Laravel-based REST API for Hello Deer POS system.

The system handles:
- Products
- Inventory
- Sales (POS transactions)
- Customers (loyalty program)
- Suppliers
- Users & roles
- Reports
- Employee Management
- Accounting

This API is consumed by:
1. Admin panel (Refine + React)
2. POS terminal (React/Vite)
3. Future AI services

---

## Tech Stack
- Laravel 12+
- MySQL
- Laravel Sanctum (authentication)
- REST API (JSON)
- Resource Controllers
- API Resources (Transformers)

---

## Architecture Rules

### 1. Use Service Layer
- Controllers must be thin
- Business logic goes into `app/Services`

Example:
- ProductService
- SaleService
- InventoryService

---

### 2. Use Form Request Validation
- Never validate inside controllers
- Use `app/Http/Requests`

---

### 3. Use API Resources
- All responses must use Laravel API Resources
- No raw model return

---

### 4. Standard API Response Format

Success:
```json
{
  "success": true,
  "data": {},
  "message": "Optional message"
}
```

Error:
```json
{
  "success": false,
  "message": "Error message",
  "errors": {}
}
```

---

### 5. Authentication
- Use Laravel Sanctum
- Token-based authentication
- Protect all routes except login

---

### 6. Role-Based Access Control
Roles:
- admin
- manager
- cashier

Use middleware or policies

---

### 7. Inventory Rules
- Inventory must update on every sale
- Prevent negative stock
- Track stock movements (in/out)

---

### 8. Sales Rules
- A sale has:
  - items
  - total
  - payment method
- Must be transactional (DB transaction)
- Save each item in `sale_items`

---

### 9. Naming Conventions

Controllers:
- ProductController
- SaleController

Services:
- ProductService

Routes:
- /api/v1/products
- /api/v1/sales

---

### 10. Code Quality
- Follow PSR-12
- Use dependency injection
- No duplicated logic
- Use enums/constants where needed

---

## Database Design Guidelines

Use laravel safedelete functionality.

Products:
- id
- name
- sku
- price
- cost
- stock_quantity

Sales:
- id
- total_amount
- payment_method
- user_id

Sale Items:
- id
- sale_id
- product_id
- quantity
- price

---

## Expectations from AI

When generating code:
- Use modular architecture. Example:
	- App/Modules/Sales/Controllers
	- App/Modules/Sales/Model
	- App/Modules/Products/Controllers
- Follow all rules above strictly
- Do not skip validation
- Do not put business logic in controllers
- Always include migrations, models, services, controllers
- Use clean, production-ready structure
- No hardcoded URL ever!

---

## Future Scope (Keep in mind)
- Multi-store support
- AI analytics
- Offline sync (POS)
- Barcode support