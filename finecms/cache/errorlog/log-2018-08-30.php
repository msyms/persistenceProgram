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
