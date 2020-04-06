# Order Grid Extra Fields



### Purpose of the module

The module adds `Coupon Code` and `Discount Amount` columns to the Sales Orders grid at Admin section.

### How it works

The module does the following:

- `coupon_code` and `discount_amount` columns are added to `sales_order_grid` table
- The appropriate columns are added to Sales Orders grid
- The columns are declared as required to be copied from `sales_order` to `sales_order_grid` table during order placement
- The columns' values are populated for existing orders. This runs once on module install



### System requirements

Magento\Sales module is required


### Installation

Use [Composer](https://getcomposer.org/) to install the module:


    composer require victorkon/orders-grid-extra-fields

