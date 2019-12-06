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


    