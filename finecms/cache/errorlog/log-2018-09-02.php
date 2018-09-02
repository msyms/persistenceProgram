<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-09-02 08:33:17 --> Severity: Error --> Call to undefined method Customer_model::get_customer_bill_exp() G:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\controllers\admin\Customer.php 150
ERROR - 2018-09-02 08:35:38 --> Severity: Error --> Call to undefined method Customer_model::get_customer_bill_exp() G:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\controllers\admin\Customer.php 150
ERROR - 2018-09-02 08:36:16 --> Severity: Error --> Call to undefined method Customer_model::get_customer_bill_exp() G:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\controllers\admin\Customer.php 150
ERROR - 2018-09-02 08:36:32 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 9 - Invalid query: select customer.cname,detail.bucketNum,detail.botttleNum,
                CONCAT(price.unit,price.price) as unitpirce,detail.backBucketNum,detail.knot,
                detail.debt,detail.debtBucket,detail.depositBucket,
                bill.saleTime,detail.remark 
                from fn_saler_bill_detail detail 
                left join fn_saler_bill bill on detail.billId = bill.id 
                left join fn_customer customer on detail.customerId = customer.id
                left join fn_customer_price price on detail.priceId = price.id 
                where customer.id =  
ERROR - 2018-09-02 08:37:12 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 9 - Invalid query: select customer.cname,detail.bucketNum,detail.botttleNum,
                CONCAT(price.unit,price.price) as unitpirce,detail.backBucketNum,detail.knot,
                detail.debt,detail.debtBucket,detail.depositBucket,
                bill.saleTime,detail.remark 
                from fn_saler_bill_detail detail 
                left join fn_saler_bill bill on detail.billId = bill.id 
                left join fn_customer customer on detail.customerId = customer.id
                left join fn_customer_price price on detail.priceId = price.id 
                where customer.id =  
ERROR - 2018-09-02 08:37:28 --> Query error: Unknown column 'detail.botttleNum' in 'field list' - Invalid query: select customer.cname,detail.bucketNum,detail.botttleNum,
                CONCAT(price.unit,price.price) as unitpirce,detail.backBucketNum,detail.knot,
                detail.debt,detail.debtBucket,detail.depositBucket,
                bill.saleTime,detail.remark 
                from fn_saler_bill_detail detail 
                left join fn_saler_bill bill on detail.billId = bill.id 
                left join fn_customer customer on detail.customerId = customer.id
                left join fn_customer_price price on detail.priceId = price.id 
                where customer.id = 1 
ERROR - 2018-09-02 08:59:50 --> Severity: Parsing Error --> syntax error, unexpected '$t' (T_VARIABLE) G:\phpStudy\WWW\persistenceProgram\finecms\cache\templates\finecms.dayrui.templates.billdetail_index.html.cache.php 48
ERROR - 2018-09-02 10:41:51 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 4 - Invalid query: select saler.name,saler.carNo,fuel.rise,fuel.money,fuel.date
                from fn_saler_fuel fuel 
                left join fn_saler saler on saler.id = fuel.salerId 
                where fuel.salerId = 
ERROR - 2018-09-02 10:44:10 --> Severity: Error --> Call to undefined method Customer_model::get_saler_bill_exp() G:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\controllers\admin\Saler.php 504
ERROR - 2018-09-02 10:44:42 --> Severity: Error --> Call to undefined method Customer_model::get_saler_bill_exp() G:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\controllers\admin\Saler.php 504
ERROR - 2018-09-02 10:45:12 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 2 - Invalid query: select salerName,bucketNum,bottleNum,checker,saleTime,remark 
                from fn_saler_bill where salerId =  
ERROR - 2018-09-02 10:45:53 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 2 - Invalid query: select salerName,bucketNum,bottleNum,checker,saleTime,remark 
                from fn_saler_bill where salerId =  
