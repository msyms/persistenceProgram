<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-08-31 14:02:42 --> Query error: Unknown column 'billId' in 'field list' - Invalid query: INSERT INTO `fn_saler_bill` (`billId`, `customerId`, `priceId`, `bucketNum`, `bottleNum`, `backBucketNum`, `knot`, `debt`, `depositBucket`, `debtBucket`, `remark`) VALUES ('9', NULL, NULL, '', '20', '0', '100', '', '', '', '')
ERROR - 2018-08-31 14:04:57 --> Query error: Unknown column 'priceId' in 'field list' - Invalid query: INSERT INTO `fn_saler_bill_detail` (`billId`, `customerId`, `priceId`, `bucketNum`, `bottleNum`, `backBucketNum`, `knot`, `debt`, `depositBucket`, `debtBucket`, `remark`) VALUES ('9', NULL, NULL, '', '20', '0', '100', '', '', '', '')
ERROR - 2018-08-31 14:39:33 --> Query error: Unknown column 'priceId' in 'field list' - Invalid query: INSERT INTO `fn_saler_bill_detail` (`billId`, `customerId`, `priceId`, `bucketNum`, `bottleNum`, `backBucketNum`, `knot`, `debt`, `depositBucket`, `debtBucket`, `remark`) VALUES ('9', NULL, '1', '20', '', '', '50', '', '', '', '')
ERROR - 2018-08-31 14:53:33 --> Query error: Unknown column 'priceId' in 'field list' - Invalid query: INSERT INTO `fn_saler_bill_detail` (`billId`, `customerId`, `priceId`, `bucketNum`, `bottleNum`, `backBucketNum`, `knot`, `debt`, `depositBucket`, `debtBucket`, `remark`) VALUES ('9', NULL, '1', '20', '', '', '50', '', '', '', '')
ERROR - 2018-08-31 14:53:46 --> Query error: Column 'customerId' cannot be null - Invalid query: INSERT INTO `fn_saler_bill_detail` (`billId`, `customerId`, `priceId`, `bucketNum`, `bottleNum`, `backBucketNum`, `knot`, `debt`, `depositBucket`, `debtBucket`, `remark`) VALUES ('9', NULL, '1', '20', '', '', '50', '', '', '', '')
ERROR - 2018-08-31 14:54:38 --> Query error: Column 'customerId' cannot be null - Invalid query: INSERT INTO `fn_saler_bill_detail` (`billId`, `customerId`, `priceId`, `bucketNum`, `bottleNum`, `backBucketNum`, `knot`, `debt`, `depositBucket`, `debtBucket`, `remark`) VALUES ('9', NULL, '2', '20', '', '', '40', '', '', '', '')
ERROR - 2018-08-31 15:39:41 --> Query error: Column 'customerId' cannot be null - Invalid query: INSERT INTO `fn_saler_bill_detail` (`billId`, `customerId`, `priceId`, `bucketNum`, `bottleNum`, `backBucketNum`, `knot`, `debt`, `depositBucket`, `debtBucket`, `remark`) VALUES ('9', NULL, '1', '20', '0', '', '100', '', '', '', '')
ERROR - 2018-08-31 15:46:39 --> Query error: Column 'customerId' cannot be null - Invalid query: INSERT INTO `fn_saler_bill_detail` (`billId`, `customerId`, `priceId`, `bucketNum`, `bottleNum`, `backBucketNum`, `knot`, `debt`, `depositBucket`, `debtBucket`, `remark`) VALUES ('9', NULL, '2', '20', '0', '0', '100', '', '', '', '')
ERROR - 2018-08-31 17:03:53 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'limit 0,SITE_ADMIN_PAGESIZE' at line 5 - Invalid query: select detail.*,customer.cname,price.unit,price.price 
                from fn_saler_bill_detail detail 
                left join fn_customer customer on detail.customerId = customer.id
                left join fn_customer_price price on detail.priceId = price.id 
                where customer.id =  limit 0,SITE_ADMIN_PAGESIZE
ERROR - 2018-08-31 17:04:47 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'limit 0,4' at line 5 - Invalid query: select detail.*,customer.cname,price.unit,price.price 
                from fn_saler_bill_detail detail 
                left join fn_customer customer on detail.customerId = customer.id
                left join fn_customer_price price on detail.priceId = price.id 
                where customer.id =  limit 0,4
