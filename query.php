<?php
    $supplierStatements = 
    "
    CREATE OR REPLACE VIEW supplier_statement_report AS
    SELECT `credit_purchASes`.`type` AS `type`, `credit_purchASes`.`voucher_date` AS `date`, SUM(credit_purchASes.total_amount) AS lifting, 0 AS payment, 0 AS others, `credit_purchASes`.`supplier_id` AS `vendorId`
    FROM `credit_purchASes`
    GROUP BY `credit_purchASes`.`voucher_date`, `credit_purchASes`.`supplier_id`, `credit_purchASes`.`type`

    UNION ALL

    SELECT `cash_purchase`.`type` AS `type`, `cash_purchase`.`voucher_date` AS `date`, SUM(cash_purchase.total_amount) AS lifting, 0 AS payment, 0 AS others, `cash_purchase`.`supplier_id` AS `vendorId`
    FROM `cash_purchase`
    GROUP BY `cash_purchase`.`voucher_date`, `cash_purchase`.`supplier_id`, `cash_purchase`.`type`

    UNION ALL

    SELECT `supplier_payments`.`payment_type` AS `type`, `supplier_payments`.`payment_date` AS `date`, 0 AS lifting, SUM(supplier_payments.payment_now) AS payment, 0 AS others, `supplier_payments`.`supplier_id` AS `vendorId`
    FROM `supplier_payments`
    GROUP BY `supplier_payments`.`payment_date`, `supplier_payments`.`supplier_id`, `supplier_payments`.`payment_type`

    UNION ALL

    SELECT '' AS `type`,`purchASe_returns`.`purchASe_return_date` AS `date`, 0 AS lifting, 0 AS payment, SUM(purchASe_returns.total_amount) AS others,  `purchASe_returns`.`supplier_id` AS `vendorId`
    FROM `purchASe_returns`
    GROUP BY `purchASe_returns`.`purchASe_return_date`, `purchASe_returns`.`supplier_id`

    ORDER BY `date` ASC
    "


    CREATE OR REPLACE VIEW purchASe_ORDER_status AS
        SELECT `purchase_orders`.`supplier_id` AS `supplierId`, `purchase_orders`.`ORDER_no` AS `ORDERNo`,`purchase_orders`.`ORDER_date` AS `date`,`purchASe_ORDER_items`.`product_id` AS `productId`,`purchASe_ORDER_items`.`qty` AS ORDERQty, 0 AS `receiveQty`
        FROM `purchase_orders`
        INNER JOIN `purchASe_ORDER_items` ON `purchASe_ORDER_items`.`purchASe_ORDER_id` = `purchase_orders`.`id`

        UNION ALL

        SELECT `purchase_orders`.`supplier_id` AS `supplierId`,`purchase_orders`.`ORDER_no` AS `ORDERNo`,`purchase_orders`.`ORDER_date` AS `date`,`purchase_order_receive_items`.`product_id` AS `productId`,0 AS `ORDERQty`,`purchase_order_receive_items`.`qty` AS receiveQty
        FROM `purchase_order_receives`
        INNER JOIN `purchase_order_receive_items` ON `purchase_order_receive_items`.`purchASe_ORDER_receive_id` = `purchase_order_receives`.`id`
        INNER JOIN `purchase_orders` ON `purchase_orders`.`id` = `purchase_order_receives`.`purchaseOrderNo`

    $supplierPaymentSummery = 
        "
        CREATE OR REPLACE VIEW supply_payment_summery AS
        SELECT `supplier_id` AS supplierId, `type` AS type, `voucher_date` AS date, `total_amount` AS purchase, `total_amount` AS payment
        FROM `cash_purchase`

        UNION ALL

        SELECT `supplier_id` AS supplierId, `type` AS type, `voucher_date` AS date, `total_amount` AS purchase, 0 AS payment
        FROM `credit_purchASes`

        UNION ALL

        SELECT `purchase_orders`.`supplier_id` AS supplierId, 'ORDER Receive' AS type, `purchase_order_receives`.`receive_date` AS date, `purchase_order_receives`.`total_amount` AS purchase, 0 AS payment
        FROM `purchase_orders`
        INNER JOIN `purchase_order_receives` ON `purchase_order_receives`.`purchaseOrderNo` = `purchase_orders`.`id`

        UNION ALL

        SELECT `supplier_id` AS supplierId, 'Payment' AS type, `payment_date` AS date, 0 AS purchase, `payment_now` AS payment
        FROM `supplier_payments`

        ORDER BY `type` ASC,`supplierId` ASC
        "

    $salesCollectiONStANDing = 
        "
        CREATE OR REPLACE VIEW sales_collectiON_stANDings AS
        SELECT `customer_id` AS customerId, `payment_type` AS type, `invoice_date` AS date, `net_amount` AS sales, 0 AS collectiON
        FROM `credit_sales`

        UNION ALL

        SELECT `client_id` AS customerId, 'CollectiON' AS type, `payment_date` AS date, 0 AS sales, `payment_amount` AS collectiON
        FROM `credit_collectiONs`

        ORDER BY `type` ASC,`customerId` ASC
        "

    $clientStatements = 
        "
        CREATE OR REPLACE VIEW client_statement_report AS
        SELECT `customer_id` AS customerId, `payment_type` AS type, `invoice_date` AS date, `net_amount` AS sales, 0 AS collectiON, 0 AS others
        FROM `credit_sales`

        UNION ALL

        SELECT `client_id` AS customerId, 'CollectiON' AS type, `payment_date` AS date, 0 AS sales, `payment_amount` AS collectiON, 0 AS others
        FROM `credit_collectiONs`

        ORDER BY `type` ASC,`customerId` ASC
        "

    $stockStatusReport = 
        "
        CREATE OR REPLACE VIEW stock_status_report AS
        SELECT `purchase_orders`.`supplier_id` AS supplierId,`purchase_order_receives`.`receive_date` AS date,`products`.`category_id` AS categoryId,`purchase_order_receive_items`.`product_id` AS productId,`purchase_order_receive_items`.`qty` AS receiveQty,`purchase_order_receive_items`.`amount` AS receiveAmount,0 AS cashSaleQty,0 AS creditSaleQty
        FROM `purchase_orders`
        INNER JOIN `purchase_order_receives` ON `purchase_order_receives`.`purchaseOrderNo` = `purchase_orders`.`id`
        INNER JOIN `purchase_order_receive_items` ON `purchase_order_receive_items`.`purchASe_ORDER_receive_id` = `purchase_order_receives`.`id`
        INNER JOIN `products` ON `products`.`id` = `purchase_order_receive_items`.`product_id`

        UNION ALL

        SELECT `purchase_orders`.`supplier_id` AS supplierId,`cash_sales`.`invoice_date` AS date,`products`.`category_id` AS categoryId,`cash_sale_items`.`item_id` AS productId,0 AS receiveQty,0 AS receiveAmount,`cash_sale_items`.`item_quantity` AS cashSaleQty,0 AS creditSaleQty
        FROM `purchase_orders`
        INNER JOIN `purchase_order_receives` ON `purchase_order_receives`.`purchaseOrderNo` = `purchase_orders`.`id`
        INNER JOIN `purchase_order_receive_items` ON `purchase_order_receive_items`.`purchASe_ORDER_receive_id` = `purchase_order_receives`.`id`
        INNER JOIN `products` ON `products`.`id` = `purchase_order_receive_items`.`product_id`
        INNER JOIN `cash_sale_items` ON `cash_sale_items`.`item_id` = `purchase_order_receive_items`.`product_id`
        INNER JOIN `cash_sales` ON `cash_sales`.`id` = `cash_sale_items`.`cash_sale_id`
        GROUP BY `purchase_orders`.`supplier_id`,`cash_sales`.`invoice_date`,`products`.`category_id`,`cash_sale_items`.`item_id`

        UNION ALL

        SELECT `purchase_orders`.`supplier_id` AS supplierId,`credit_sales`.`invoice_date` AS date,`products`.`category_id` AS categoryId,`credit_sale_items`.`item_id` AS productId,0 AS receiveQty,0 AS receiveAmount,0 AS cashSaleQty,`credit_sale_items`.`item_quantity` AS creditSaleQty
        FROM `purchase_orders`
        INNER JOIN `purchase_order_receives` ON `purchase_order_receives`.`purchaseOrderNo` = `purchase_orders`.`id`
        INNER JOIN `purchase_order_receive_items` ON `purchase_order_receive_items`.`purchASe_ORDER_receive_id` = `purchase_order_receives`.`id`
        INNER JOIN `products` ON `products`.`id` = `purchase_order_receive_items`.`product_id`
        INNER JOIN `credit_sale_items` ON `credit_sale_items`.`item_id` = `purchase_order_receive_items`.`product_id`
        INNER JOIN `credit_sales` ON `credit_sales`.`id` = `credit_sale_items`.`credit_sale_id`
        GROUP BY `purchase_orders`.`supplier_id`,`credit_sales`.`invoice_date`,`products`.`category_id`,`credit_sale_items`.`item_id`

        ORDER BY supplierId ASC, productId ASC
        "

//         SELECT `purchase_orders`.`supplier_id` As supplirId,`cash_sales`.`invoice_date` AS date,`products`.`category_id` AS categoryId,`cash_sale_items`.`item_id` AS productId,`cash_sale_items`.`item_quantity` AS cashSaleQty
// From `cash_sales`
// INNER JOIN `cash_sale_items` ON `cash_sale_items`.`cash_sale_id` = `cash_sales`.`id`
// INNER JOIN `products` ON `products`.`id` = `cash_sale_items`.`item_id`
// INNER JOIN `purchase_order_receive_items` ON `purchase_order_receive_items`.`product_id` = `cash_sale_items`.`item_id`
// INNER JOIn `purchase_order_receives` ON `purchase_order_receives`.`id` = `purchase_order_receive_items`.`purchase_order_receive_id`
// INNER JOIN `purchase_orders` ON `purchase_orders`.`id` = `purchase_order_receives`.`purchaseOrderNo`

// GROUP BY `purchase_orders`.`supplier_id`,`cash_sales`.`invoice_date`,`products`.`category_id`,`cash_sale_items`.`item_id`

    $salesContribution = 
    "
    CREATE OR REPLACE VIEW sales_contribution AS
    SELECT `products`.`category_id` AS categoryId,`cash_sale_items`.`item_id` AS productId, SUM(`cash_sale_items`.`item_quantity`) AS cashSaleQty, SUM(`cash_sale_items`.`item_price`) AS cashSaleAmount, 0 AS creditSaleQty, 0 AS creditSaleAmount
    FROM `cash_sale_items`
    INNER JOIN `products` ON `products`.`id` = `cash_sale_items`.`item_id`
    GROUP BY `cash_sale_items`.`item_id`

    UNION ALL

    SELECT `products`.`category_id` AS categoryId,`credit_sale_items`.`item_id` AS productId, 0 AS cashSaleQty, 0 AS cashSaleAmount, SUM(`credit_sale_items`.`item_quantity`) AS creditSaleQty, SUM(`credit_sale_items`.`item_price`) AS creditSaleAmount
    FROM `credit_sale_items`
    INNER JOIN `products` ON `products`.`id` = `credit_sale_items`.`item_id`
    GROUP By `credit_sale_items`.`item_id`

    ORDER BY categoryId, productId
    "

    $stockValuation = 
    "
    CREATE OR REPLACE VIEW stock_valuation_report AS
    SELECT `cash_purchase`.`supplier_id` AS supplierId, `products`.`category_id` AS categoryId, `cash_purchase_item`.`product_id` AS productId, `cash_purchase_item`.`qty` AS cashPurchaseQty, `cash_purchase_item`.`amount` AS cashPurchaseAmount, 0 AS creditPurchaseQty, 0 AS creditPurchaseAmount, 0 AS purchaseReturnQty, 0 AS purchaseReturnAmount, 0 AS cashSaleQty, 0 AS cashSaleAmount, 0 AS creditSaleQty, 0 AS creditSaleAmount, 0 AS salesReturnQty
    FROM `cash_purchase_item`
    INNER JOIN `cash_purchase` ON `cash_purchase`.`id` = `cash_purchase_item`.`cash_puchase_id`
    INNER JOIN `products` ON `products`.`id` = `cash_purchase_item`.`product_id`

    UNION ALL

    SELECT `credit_purchases`.`supplier_id` AS supplierId, `products`.`category_id` AS categoryId, `credit_purchase_items`.`product_id` AS productId, 0 AS cashPurchaseQty, 0 AS cashPurchaseAmount, `credit_purchase_items`.`qty` AS creditPurchaseQty, `credit_purchase_items`.`amount` AS creditPurchaseAmount, 0 AS purchaseReturnQty, 0 AS purchaseReturnAmount, 0 AS cashSaleQty, 0 AS cashSaleAmount, 0 AS creditSaleQty, 0 AS creditSaleAmount, 0 AS salesReturnQty
    FROM `credit_purchase_items`
    INNER JOIN `credit_purchases` ON `credit_purchases`.`id` = `credit_purchase_items`.`credit_puchase_id`
    INNER JOIN `products` ON `products`.`id` = `credit_purchase_items`.`product_id`

    UNION ALL

    SELECT `purchase_returns`.`supplier_id` AS supplierId, `products`.`category_id` AS categoryId, `purchase_return_items`.`product_id` AS productId, 0 AS cashPurchaseQty, 0 AS cashPurchaseAmount, 0 AS creditPurchaseQty, 0 AS creditPurchaseAmount, `purchase_return_items`.`qty` AS purchaseReturnQty, `purchase_return_items`.`amount` AS purchaseReturnAmount, 0 AS cashSaleQty, 0 AS cashSaleAmount, 0 AS creditSaleQty, 0 AS creditSaleAmount, 0 AS salesReturnQty
    FROM `purchase_return_items`
    INNER JOIN `purchase_returns` ON `purchase_returns`.`id` = `purchase_return_items`.`purchase_return_id`
    INNER JOIN `products` ON `products`.`id` = `purchase_return_items`.`product_id`

    UNION ALL

    SELECT 0 AS supplierId, `products`.`category_id` AS categoryId, `cash_sale_items`.`item_id` AS productId, 0 AS cashPurchaseQty, 0 AS cashPurchaseAmount, 0 AS creditPurchaseQty, 0 AS creditPurchaseAmount, 0 AS purchaseReturnQty, 0 AS purchaseReturnAmount, `cash_sale_items`.`item_quantity` AS cashSaleQty, `cash_sale_items`.`item_price` AS cashSaleAmount, 0 AS creditSaleQty, 0 AS creditSaleAmount, 0 AS salesReturnQty
    FROM `cash_sale_items`
    INNER JOIN `products` ON `products`.`id` = `cash_sale_items`.`item_id`

    UNION ALL

    SELECT 0 AS supplierId, `products`.`category_id` AS categoryId, `credit_sale_items`.`item_id` AS productId, 0 AS cashPurchaseQty, 0 AS cashPurchaseAmount, 0 AS creditPurchaseQty, 0 AS creditPurchaseAmount, 0 AS purchaseReturnQty, 0 AS purchaseReturnAmount, 0 AS cashSaleQty, 0 AS cashSaleAmount, `credit_sale_items`.`item_quantity` AS creditSaleQty, `credit_sale_items`.`item_price` AS creditSaleAmount, 0 AS salesReturnQty
    FROM `credit_sale_items`
    INNER JOIN `products` ON `products`.`id` = `credit_sale_items`.`item_id`
    "

    $productWiseProfit =
    "
    SELECT `cash_sales`.`invoice_date` AS date, `products`.`category_id` AS categoryId, `cash_sale_items`.`item_quantity` AS cashProductQty, `cash_sale_items`.`item_price` AS cashPriceAmount, (`cash_sale_items`.`item_price`*4.5)/100 AS cashVatAmount, (`cash_sale_items`.`item_price`*`cash_sales`.`discount_as`)/100 AS cashDiscountAmount, 0 AS creditProductQty, 0 AS creditPriceAmount, 0 AS creditVatAmount, 0 AS creditDiscountAmount
    FROM `cash_sales`
    INNER JOIN `cash_sale_items` ON `cash_sale_items`.`cash_sale_id` = `cash_sales`.`id`
    INNER JOIN `products` ON `products`.`id` = `cash_sale_items`.`item_id`

    UNION ALL

    SELECT `credit_sales`.`invoice_date` AS date, `products`.`category_id` AS categoryId, 0 AS cashProductQty, 0 AS cashPriceAmount, 0 AS cashVatAmount, 0 AS cashDiscountAmount, `credit_sale_items`.`item_quantity` AS creditProductQty, `credit_sale_items`.`item_price` AS creditPriceAmount, (`credit_sale_items`.`item_price`*4.5)/100 AS creditVatAmount, (`credit_sale_items`.`item_price`*`credit_sales`.`discount_as`)/100 AS creditDiscountAmount
    FROM `credit_sales`
    INNER JOIN `credit_sale_items` ON `credit_sale_items`.`credit_sale_id` = `credit_sales`.`id`
    INNER JOIN `products` ON `products`.`id` = `credit_sale_items`.`item_id`
    "
?>

