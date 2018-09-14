<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-09-12 11:48:29 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 6 - Invalid query: update fn_customer 
                set knot = knot - 0,
                debtMoney = debtMoney - 0,
                depositBucket = depositBucket - 0,
                debtBucket = debtBucket - 0
                where id = 
ERROR - 2018-09-12 13:37:06 --> Query error: Unknown column 'name' in 'field list' - Invalid query: SELECT `customerId`, `name`, `phone`, `carNo`, `remark`
FROM `fn_saler_bill_detail`
WHERE `id` = '4'
 LIMIT 1
