<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-08-30 09:14:06 --> 404 Page Not Found: admin/Bill/index
ERROR - 2018-08-30 09:23:29 --> 404 Page Not Found: admin/Customer/detail
ERROR - 2018-08-30 10:26:57 --> Severity: Error --> Call to a member function get_bill_detail() on null E:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\controllers\admin\Saler.php 315
ERROR - 2018-08-30 14:59:58 --> 404 Page Not Found: admin/Customer/detail
ERROR - 2018-08-30 15:10:28 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 5 - Invalid query: select detail.*,customer.cname,price.unit,price.price 
                from fn_saler_bill_detail detail 
                left join fn_customer customer on detail.customerId = customer.id
                left join fn_customer_price price on customer.id = price.customerId 
                where detail.billId = 
ERROR - 2018-08-30 15:53:18 --> 404 Page Not Found: admin/Customer/detail
ERROR - 2018-08-30 16:22:50 --> Severity: Parsing Error --> syntax error, unexpected '$customer' (T_VARIABLE) E:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\controllers\admin\Customer.php 198
ERROR - 2018-08-30 16:27:13 --> Severity: Error --> Call to undefined method Customer_model::addprice() E:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\controllers\admin\Customer.php 183
ERROR - 2018-08-30 16:27:23 --> Severity: Error --> Call to undefined method Customer_model::addprice() E:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\controllers\admin\Customer.php 183
ERROR - 2018-08-30 21:53:53 --> Severity: Error --> Call to undefined method Customer_model::get_price_bycustomer() G:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\controllers\admin\Customer.php 178
ERROR - 2018-08-30 21:54:18 --> Severity: Error --> Call to undefined method Customer_model::get_price_bycustomer() G:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\controllers\admin\Customer.php 178
ERROR - 2018-08-30 21:56:00 --> Severity: Error --> Call to undefined method Customer_model::get_price_bycustomer() G:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\controllers\admin\Customer.php 178
ERROR - 2018-08-30 21:57:10 --> Severity: Error --> Call to undefined method Customer_model::get_price_bycustomer() G:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\controllers\admin\Customer.php 178
ERROR - 2018-08-30 21:57:18 --> Severity: Error --> Call to undefined method Customer_model::get_price_bycustomer() G:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\controllers\admin\Customer.php 178
ERROR - 2018-08-30 22:02:01 --> Query error: Unknown column 'unit' in 'field list' - Invalid query: SELECT `id`, `unit`, `price`
FROM `fn_customer`
WHERE `cname` IS NULL
ERROR - 2018-08-30 22:02:13 --> Query error: Unknown column 'unit' in 'field list' - Invalid query: SELECT `id`, `unit`, `price`
FROM `fn_customer`
WHERE `cname` IS NULL
ERROR - 2018-08-30 22:04:19 --> Query error: Unknown column 'cname' in 'where clause' - Invalid query: SELECT `id`
FROM `fn_customer_price`
WHERE `cname` IS NULL
ERROR - 2018-08-30 22:05:52 --> Query error: Unknown column 'cname' in 'where clause' - Invalid query: SELECT `id`
FROM `fn_customer_price`
WHERE `cname` IS NULL
