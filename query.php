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
    CREATE OR REPLACE VIEW stock_valuation AS 
    SELECT `tbl_liftings`.`vouchar_date` AS `date`,`tbl_liftings`.`vendor_id` AS `vendorId`,`tbl_vendors`.`name` AS `vendorName`,`tbl_products`.`category_id` AS `categoryId`,`tbl_categories`.`parent` AS `categoryParent`,`tbl_categories`.`name` AS `categoryName`,`tbl_lifting_products`.`product_id` AS `productId`,`tbl_products`.`name` AS `productName`,`tbl_lifting_products`.`serial_no` AS `serialNo`,`tbl_products`.`model_no` AS `modelNo`,`tbl_products`.`color` AS `color`,`tbl_lifting_products`.`qty` AS `liftingQty`,`tbl_lifting_products`.`price` AS `liftingAmount`,0 AS `liftingReturnQty`,0 AS `liftingReturnAmount`,0 AS `salesQty`,0 AS `salesAmount`,0 AS `salesReturnQty`,0 AS `salesReturnAmount`
    FROM `tbl_liftings`
    INNER JOIN `tbl_vendors` ON `tbl_vendors`.`id` = `tbl_liftings`.`vendor_id`
    INNER JOIN `tbl_lifting_products` ON `tbl_lifting_products`.`lifting_id` = `tbl_liftings`.`id`
    INNER JOIN `tbl_products` ON `tbl_products`.`id` = `tbl_lifting_products`.`product_id`
    INNER JOIN `tbl_categories` ON `tbl_categories`.`id` = `tbl_products`.`category_id`
    "

    

    