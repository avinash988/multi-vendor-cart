# Multi Vendor Cart & Order Management System

## Project Overview

This project is built using Laravel.

Features included:

* Role Based Login (Admin & Customer)
* Product Management
* Cart Management
* Multi Vendor Checkout
* Vendor Wise Order Creation
* Payment Handling
* Order Management
* Events & Listeners
* Service Classes
* Form Requests

---

# Setup Instructions

## Install Dependencies

composer install

## Environment Setup

cp .env.example .env

Update database credentials in `.env`

## Generate Application Key

php artisan key:generate

## Create Tables & Sample Data

php artisan migrate:fresh --seed

## Run Project

php artisan serve

Application URL:

text
http://127.0.0.1:8000

---

# Sample Credentials
## Admin

Email: admin@test.com

## Customer

Email: customer@test.com

Note:

Vendor login is not implemented.
Vendors are seeded and used for products and order splitting.

---

# Features

## Customer

* Login
* View Products
* Add Products To Cart
* Remove Products From Cart
* Checkout
* View My Orders
* View Order Details

## Admin

* Login
* View All Orders
* Filter Orders By Vendor Name
* Filter Orders By Customer Name
* Filter Orders By Payment Status
* View Order Details

---

# Business Flow

## Add To Cart

* Customer selects product
* Quantity is validated against available stock
* Product is added to cart

## Checkout

* Product stock validated
* Cart is processed vendor wise
* Separate order created for each vendor
* Order items created
* Product stock reduced
* Payment record created
* Cart cleared

---

# Authentication

Session based authentication is used.

Roles:

* Admin
* Customer

Middleware:

* auth.custom
* admin.custom

---

# Validation

Form Requests Used:

* AddToCartRequest
* CheckoutRequest

---

# Service Classes

## CartService

Handles:

* Add To Cart
* Remove Cart Item
* Get Cart

## CheckoutService

Handles:

* Stock Validation
* Order Creation
* Order Items Creation
* Payment Creation
* Stock Deduction
* Cart Cleanup

---

# Events & Listeners

## Events

* OrderPlaced
* PaymentSuccess

## Listeners

* LogOrderActivity
* SendOrderConfirmationEmail

Email notification is mocked using Laravel logs.

Log file:

text
storage/logs/laravel.log

---

# Architecture Decisions

* Service Classes are used to keep business logic separate from controllers.
* Cart logic is handled in CartService.
* Checkout logic is handled in CheckoutService.
* Events and Listeners are used for order related actions.
* Form Requests are used for validation.
* Middleware is used for role based access.

---

# Assumptions

* Payment flow is simulated and marked as paid after checkout.
* Email notification is mocked using logs.
* Session based login is used.
* Stock is validated before checkout.
* Separate orders are created for different vendors.

---

# Notes

* Vendors, products and users are created using seeders.
* Admin can view all orders.
* Customer can view only their own orders.
* Product stock is reduced after successful checkout.
* Multi Vendor Checkout is supported.