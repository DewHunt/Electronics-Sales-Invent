<?php
    $vendorStatements = 
    "
    CREATE OR REPLACE VIEW view_vendor_statement_report AS
    SELECT `tbl_liftings`.`vendor_id` as `vendorId`,`tbl_liftings`.`vouchar_date` as `date`,SUM(`tbl_liftings`.`total_price`) as `lifting`, 0 as `payment`, 0 as `others`
    FROM `tbl_liftings`
    GROUP BY `tbl_liftings`.`vouchar_date`,`tbl_liftings`.`vendor_id`

    UNION ALL

    SELECT `tbl_payment_to_company`.`vendor_id` as `vendorId`,`tbl_payment_to_company`.`payment_date` as `date`,0 as `lifting`,SUM(`tbl_payment_to_company`.`payment_now`) as `payment`,0 as `others`
    FROM `tbl_payment_to_company`
    GROUP BY `tbl_payment_to_company`.`payment_date`,`tbl_payment_to_company`.`vendor_id`
    "

    $liftingRecord = 
    "
    CREATE OR REPLACE VIEW view_lifting_record AS    
    SELECT `tbl_liftings`.`vouchar_date` as `liftingDate`, `tbl_liftings`.`vaouchar_no` as `liftingNo`,`tbl_liftings`.`vendor_id` as `vendorId`,`tbl_vendors`.`name` as `vendorName`,`tbl_products`.`category_id` as `categoryId`,`tbl_categories`.`parent` as `parentId`,`tbl_categories`.`name` as `categoryName`,`tbl_lifting_products`.`product_id` as `productId`,`tbl_products`.`name` as `productName`,`tbl_products`.`model_no` as `productModelNo`,`tbl_products`.`color` as `productColor`,`tbl_lifting_products`.`serial_no` as `productSerialNo`,`tbl_lifting_products`.`qty` as `productQty`,`tbl_lifting_products`.`price`
    FROM `tbl_liftings`
    INNER JOIN `tbl_vendors` ON `tbl_vendors`.id = `tbl_liftings`.`vendor_id`
    INNER JOIN `tbl_lifting_products` ON `tbl_lifting_products`.`lifting_id` = `tbl_liftings`.`id`
    INNER JOIN `tbl_products` ON `tbl_products`.`id` = `tbl_lifting_products`.`product_id`
    INNER JOIN `tbl_categories` ON `tbl_categories`.`id` = `tbl_products`.`category_id`
    ORDER BY `tbl_lifting_products`.`product_id`
    "

    $liftingPaymentSummary = 
    "
    CREATE OR REPLACE VIEW view_lifting_payment_summary AS  
    SELECT `tbl_liftings`.`vendor_id` AS `vendorId`,`tbl_vendors`.`name` AS `vendorName`,`tbl_liftings`.`vouchar_date` AS `date`,`tbl_liftings`.`total_price` AS `lifting`,0 AS `payment`
    FROM `tbl_liftings`
    INNER JOIN `tbl_vendors` ON `tbl_vendors`.`id` = `tbl_liftings`.`vendor_id`

    UNION ALL

    SELECT `tbl_payment_to_company`.`vendor_id` AS `vendorId`,`tbl_vendors`.`name` AS `vendorName`,`tbl_payment_to_company`.`payment_date` AS `date`,0 AS `lifting`,`tbl_payment_to_company`.`payment_now` AS `payment`
    FROM `tbl_payment_to_company`
    INNER JOIN `tbl_vendors` ON `tbl_vendors`.`id` = `tbl_payment_to_company`.`vendor_id`
    "

    $stockValuation = 
    "
    CREATE OR REPLACE VIEW view_stock_valuation AS 
    SELECT `tbl_liftings`.`vouchar_date` AS `date`,`tbl_liftings`.`vendor_id` AS `vendorId`,`tbl_vendors`.`name` AS `vendorName`,`tbl_products`.`category_id` AS `categoryId`,`tbl_categories`.`parent` AS `categoryParent`,`tbl_categories`.`name` AS `categoryName`,`tbl_lifting_products`.`product_id` AS `productId`,`tbl_products`.`name` AS `productName`,`tbl_lifting_products`.`serial_no` AS `serialNo`,`tbl_products`.`model_no` AS `modelNo`,`tbl_products`.`color` AS `color`,`tbl_products`.`reorder_level_qty` AS `reorderQty`,`tbl_lifting_products`.`qty` AS `liftingQty`,`tbl_lifting_products`.`price` AS `liftingAmount`,0 AS `liftingReturnQty`,0 AS `liftingReturnAmount`,0 AS `salesQty`,0 AS `salesAmount`,0 AS `salesReturnQty`,0 AS `salesReturnAmount`
    FROM `tbl_liftings`
    INNER JOIN `tbl_vendors` ON `tbl_vendors`.`id` = `tbl_liftings`.`vendor_id`
    INNER JOIN `tbl_lifting_products` ON `tbl_lifting_products`.`lifting_id` = `tbl_liftings`.`id`
    INNER JOIN `tbl_products` ON `tbl_products`.`id` = `tbl_lifting_products`.`product_id`
    INNER JOIN `tbl_categories` ON `tbl_categories`.`id` = `tbl_products`.`category_id`
    "

    $customerOutstanding = 
    "
    CREATE OR REPLACE VIEW view_customer_outstanding AS 
    SELECT `tbl_customer_products`.`customer_id` AS `customerId`,`tbl_customers`.`name` AS `customerName`,`tbl_customers`.`phone_no` AS `customerPhoneNo`,`tbl_customer_products`.`product_id` AS `productId`,`tbl_invoice`.`invoice_no` AS `invoiceNo`,`tbl_products`.`name` AS `productName`,`tbl_invoice`.`customer_product_price` AS `salesAmount`,SUM(`tbl_cash_collection`.`collection_amount`) AS `collection`,(`tbl_invoice`.`customer_product_price` - SUM(`tbl_cash_collection`.`collection_amount`)) AS `balance`
    FROM `tbl_customer_products`
    LEFT JOIN `tbl_invoice` ON `tbl_invoice`.`customer_product_id` = `tbl_customer_products`.`id`
    LEFT JOIN `tbl_products` ON `tbl_products`.`id` = `tbl_customer_products`.`product_id`
    LEFT JOIN `tbl_customers` ON `tbl_customers`.`id` = `tbl_customer_products`.`customer_id`
    LEFT JOIN `tbl_cash_collection` ON `tbl_cash_collection`.`invoice_id` = `tbl_invoice`.`id`
    WHERE `tbl_customer_products`.`purchase_type` = 'Cash'
    Group By `tbl_invoice`.`invoice_no`,`tbl_cash_collection`.`invoice_id`
    ";

    $customerStatement = 
    "
    CREATE OR REPLACE VIEW view_customer_statement AS
    SELECT `tbl_customer_products`.`purchase_date` AS `date`,`tbl_customer_products`.`customer_id` AS `customerId`,`tbl_customers`.`name` AS `customerName`,`tbl_customer_products`.`product_id` AS `productId`,`tbl_invoice`.`invoice_no` AS `invoiceNo`,`tbl_products`.`name` AS `productName`,`tbl_invoice`.`customer_product_price` AS `salesAmount`,0 AS `collection`
    FROM `tbl_customer_products`
    LEFT JOIN `tbl_invoice` ON `tbl_invoice`.`customer_product_id` = `tbl_customer_products`.`id`
    LEFT JOIN `tbl_products` ON `tbl_products`.`id` = `tbl_customer_products`.`product_id`
    LEFT JOIN `tbl_customers` ON `tbl_customers`.`id` = `tbl_customer_products`.`customer_id`
    WHERE `tbl_customer_products`.`purchase_type` = 'Cash'

    UNION ALL

    SELECT `tbl_cash_collection`.`collection_date` AS `date`,`tbl_customer_products`.`customer_id` AS `customerId`,`tbl_customers`.`name` AS `customerName`,`tbl_customer_products`.`product_id` AS `productId`,`tbl_invoice`.`invoice_no` AS `invoiceNo`,`tbl_products`.`name` AS `productName`,0 AS `salesAmount`,`tbl_cash_collection`.`collection_amount` AS `collection`
    FROM `tbl_cash_collection`
    LEFT JOIN `tbl_invoice` ON `tbl_invoice`.`id` = `tbl_cash_collection`.`invoice_id`
    LEFT JOIN `tbl_customer_products` ON `tbl_customer_products`.`id` = `tbl_invoice`.`customer_product_id`
    LEFT JOIN `tbl_customers` ON `tbl_customers`.`id` = `tbl_invoice`.`customer_id`
    LEFT JOIN `tbl_products` ON `tbl_products`.`id` = `tbl_invoice`.`product_id`
    ";

    

    