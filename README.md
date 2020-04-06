# Order Grid Extra Fields


## Overview

### Purpose of the module

The module adds `Coupon Code` and `Discount Amount` columns to the Sales Order grid at Admin section.

### How it works

The module consists of 3 parts:

1. `coupon_code` and `discount_amount` columns are added to `sales_order_grid` table
2. The columns are declared as required to be copied from `sales_order` to `sales_order_grid` table during order placement
3. The columns' values are populated for existing orders. This runs once on module install.


## Deployment

### System requirements

Magento\Sales module is required


### Installation

Use [Composer](https://getcomposer.org/) to install the library.


    composer require victorkon/orders-grid-extra-fields

