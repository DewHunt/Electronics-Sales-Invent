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
    SELECT `tbl_liftings`.`vouchar_date` as `liftingDate`, `tbl_liftings`.`vaouchar_no` as `liftingNo`,`tbl_liftings`.`vendor_id` as `vendorId`,`tbl_vendors`.`name` as `vendorName`,`tbl_liftings`.`store_or_showroom_type` AS `storeOrShowroomType`,`tbl_liftings`.`store_or_showroom_id` AS `storeOrShowroomId`,`view_store_and_showroom`.`name` AS `storeOrShowroomName`,`tbl_products`.`category_id` as `categoryId`,`tbl_categories`.`parent` as `parentId`,`tbl_categories`.`name` as `categoryName`,`tbl_lifting_products`.`product_id` as `productId`,`tbl_lifting_products`.`product_name` as `productName`,`tbl_products`.`model_no` as `productModelNo`,`tbl_products`.`color` as `productColor`,`tbl_lifting_products`.`serial_no` as `productSerialNo`,`tbl_lifting_products`.`qty` as `productQty`,`tbl_lifting_products`.`price`
    FROM `tbl_liftings`
    LEFT JOIN `tbl_vendors` ON `tbl_vendors`.id = `tbl_liftings`.`vendor_id`
    LEFT JOIN `tbl_lifting_products` ON `tbl_lifting_products`.`lifting_id` = `tbl_liftings`.`id`
    LEFT JOIN `tbl_products` ON `tbl_products`.`id` = `tbl_lifting_products`.`product_id`
    LEFT JOIN `tbl_categories` ON `tbl_categories`.`id` = `tbl_products`.`category_id`
    LEFT JOIN `view_store_and_showroom` ON `view_store_and_showroom`.`type` = `tbl_liftings`.`store_or_showroom_type` AND `view_store_and_showroom`.`id` = `tbl_liftings`.`store_or_showroom_id`
    ORDER BY `tbl_lifting_products`.`product_id`
    "

    $liftingReturnRecord = 
    "
    CREATE OR REPLACE VIEW view_lifting_return_record AS    
    SELECT `tbl_lifting_returns`.`date` as `liftingReturnDate`, `tbl_lifting_returns`.`serial_no` as `liftingReturnNo`,`tbl_lifting_returns`.`vendor_id` as `vendorId`,`tbl_vendors`.`name` as `vendorName`,`tbl_lifting_returns`.`store_or_showroom_type` AS `storeOrShowroomType`,`tbl_lifting_returns`.`store_or_showroom_id` AS `storeOrShowroomId`,`view_store_and_showroom`.`name` AS `storeOrShowroomName`,`tbl_products`.`category_id` as `categoryId`,`tbl_categories`.`parent` as `parentId`,`tbl_categories`.`name` as `categoryName`,`tbl_lifting_return_products`.`product_id` as `productId`,`tbl_products`.`code` AS `productCode`,`tbl_lifting_return_products`.`product_name` as `productName`,`tbl_lifting_return_products`.`model_no` as `productModelNo`,`tbl_lifting_return_products`.`color` as `productColor`,`tbl_lifting_return_products`.`serial_no` as `productSerialNo`,`tbl_lifting_return_products`.`qty` as `productQty`,`tbl_lifting_return_products`.`price`
    FROM `tbl_lifting_returns`
    LEFT JOIN `tbl_vendors` ON `tbl_vendors`.id = `tbl_lifting_returns`.`vendor_id`
    LEFT JOIN `tbl_lifting_return_products` ON `tbl_lifting_return_products`.`lifting_return_id` = `tbl_lifting_returns`.`id`
    LEFT JOIN `tbl_products` ON `tbl_products`.`id` = `tbl_lifting_return_products`.`product_id`
    LEFT JOIN `tbl_categories` ON `tbl_categories`.`id` = `tbl_products`.`category_id`
    LEFT JOIN `view_store_and_showroom` ON `view_store_and_showroom`.`type` = `tbl_lifting_returns`.`store_or_showroom_type` AND `view_store_and_showroom`.`id` = `tbl_lifting_returns`.`store_or_showroom_id`
    ORDER BY `tbl_lifting_return_products`.`product_id`
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

    $storeAndShowroom = 
    "
    CREATE OR REPLACE VIEW view_store_and_showroom AS
    SELECT `tbl_stores`.`id` as `id`,'store' as `type`,`tbl_stores`.`type` as `storeType`,`tbl_stores`.`name` as `name`
    FROM `tbl_stores`
    WHERE `tbl_stores`.`status` = '1'

    UNION

    SELECT `tbl_showroom`.`id` as `id`,'showroom' as `type`,'' as `storeType`,`tbl_showroom`.`name` as `name`
    FROM `tbl_showroom`
    WHERE `tbl_showroom`.`status` = '1'
    "

    $transportRecord = 
    "
    CREATE OR REPLACE VIEW view_transport_record AS
    SELECT `tbl_transfers`.`date` AS `date`,`tbl_transfers`.`host_type` AS `hostType`,`tbl_transfers`.`host_id` AS `hostId`,`tbl_transfers`.`destination_type` AS `destinationType`,`tbl_transfers`.`destination_id` AS `destinationId`,`tbl_transfer_products`.`product_id` AS `productId`,`tbl_transfer_products`.`name` AS
    `productName`,`tbl_transfer_products`.`model_no` AS `productModelNo`,`tbl_transfer_products`.`serial_no` AS `productSerialNo`,`tbl_transfer_products`.`color` AS `productColor`,`tbl_transfer_products`.`qty` AS `productQty`
    FROM `tbl_transfers`
    RIGHT JOIN `tbl_transfer_products` ON `tbl_transfer_products`.`transfer_id` = `tbl_transfers`.`id`
    "

    $productStatement = 
    "
    CREATE OR REPLACE VIEW view_product_statement AS
    SELECT `tbl_liftings`.`vouchar_date` as `date`,`tbl_lifting_products`.`product_id` AS `productId`,`tbl_lifting_products`.`product_name` AS `productName`,`tbl_lifting_products`.`qty` AS `liftingQty`,`tbl_lifting_products`.`price` AS `liftingPrice`,0 AS `liftingReturnPrice`,0 AS `productIssuePrice`,0 AS `productReturnPrice`,0 AS `salesPrice`,0 AS `slaesReturnPrice`
    FROM `tbl_liftings`
    INNER JOIN `tbl_lifting_products` ON `tbl_lifting_products`.`lifting_id` = `tbl_liftings`.`id`

    UNION ALL

    SELECT `tbl_lifting_returns`.`date` AS `date`,`tbl_lifting_return_products`.`product_id` AS `productId`,`tbl_lifting_return_products`.`product_name` AS `productName`,`tbl_lifting_return_products`.`qty` AS `productQty`,0  AS `liftingPrice`,`tbl_lifting_return_products`.`price` AS `liftingReturnPrice`,0 AS `productIssuePrice`,0 AS `productReturnPrice`,0 AS `salesPrice`,0 AS `slaesReturnPrice`
    FROM `tbl_lifting_returns`
    INNER JOIN `tbl_lifting_return_products` ON `tbl_lifting_return_products`.`lifting_return_id` = `tbl_lifting_returns`.`id`
    "

    $groupAndStaff = 
    "
    CREATE OR REPLACE VIEW view_group_and_staff AS
    SELECT `tbl_groups`.`id` AS `groupId`,`tbl_staffs`.`id` AS `staffId`,`tbl_groups_sales_target`.id AS `groupSalesTargetId`
    FROM `tbl_staffs`
    INNER JOIN `tbl_groups` ON `tbl_groups`.`team_leader` = `tbl_staffs`.`id` OR FIND_IN_SET (`tbl_staffs`.`id`,`tbl_groups`.`team_member`)
    INNER JOIN `tbl_groups_sales_target` ON `tbl_groups_sales_target`.`group_id` = `tbl_groups`.`id`
    "

    $dealerCommissionStatement = 
    "
    CREATE OR REPLACE VIEW view_dealer_commission_statement AS    
    SELECT `tbl_product_issue`.`date` AS `date`,`tbl_product_issue`.`dealer_id` AS `dealerId`,`tbl_dealers`.`name` AS `dealerName`,`tbl_product_issue_lists`.`product_id` AS `productId`,`tbl_products`.`name` AS `productName`,`tbl_categories`.`id` AS `categoryId`,`tbl_categories`.`name` AS `categoryName`,`tbl_product_issue_lists`.`commission_rate` AS `commissionRate`,SUM(`tbl_product_issue_lists`.`amount`) AS `saleAmount`,(SUM(`tbl_product_issue_lists`.`amount`)*`tbl_product_issue_lists`.`commission_rate`)/100 AS `commissionAmount`
    FROM `tbl_product_issue`
    LEFT JOIN `tbl_dealers` ON `tbl_dealers`.`id` = `tbl_product_issue`.`dealer_id`
    LEFT JOIN `tbl_product_issue_lists` ON `tbl_product_issue_lists`.`issue_id` = `tbl_product_issue`.`id`
    LEFT JOIN `tbl_products` ON `tbl_products`.`id` = `tbl_product_issue_lists`.`product_id`
    LEFT JOIN `tbl_categories` ON `tbl_categories`.`id` = `tbl_products`.`category_id`
    GROUP BY `tbl_product_issue`.`dealer_id`,`tbl_product_issue_lists`.`product_id`,`tbl_product_issue_lists`.`commission_rate`
    ORDER BY `tbl_product_issue`.`dealer_id`,`tbl_product_issue_lists`.`product_id`
    "

    "SELECT `tbl_lifting_products`.`product_id`,`tbl_lifting_products`.`serial_no`
FROM `tbl_lifting_products`
LEFT JOIN `tbl_product_issue_lists` ON `tbl_product_issue_lists`.`serial_no` = `tbl_lifting_products`.`serial_no`
WHERE `tbl_product_issue_lists`.`serial_no` IS NULL"

    

    