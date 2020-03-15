<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-09-17 10:55:28 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'sum(detail.bottleNum) as allbottleNum,sum(detail.drinkNum) as alldrinkNum 
 			' at line 2 - Invalid query: select saler.*,sum(detail.knot) as allknot,sum(detail.bucketNum) as allbucket
				sum(detail.bottleNum) as allbottleNum,sum(detail.drinkNum) as alldrinkNum 
 				from fn_saler saler  
				left join fn_saler_bill bill on bill.salerId = saler.id and saleTime = 2018-09-17
				left join fn_saler_bill_detail detail on detail.billId  = bill.id 
				group by saler.id 
ERROR - 2018-09-17 10:55:56 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'sum(detail.bottleNum) as allbottleNum,sum(detail.drinkNum) as alldrinkNum 
 			' at line 2 - Invalid query: select saler.*,sum(detail.knot) as allknot,sum(detail.bucketNum) as allbucket
				sum(detail.bottleNum) as allbottleNum,sum(detail.drinkNum) as alldrinkNum 
 				from fn_saler saler  
				left join fn_saler_bill bill on bill.salerId = saler.id and saleTime = 2018-09-17
				left join fn_saler_bill_detail detail on detail.billId  = bill.id 
				group by saler.id 
ERROR - 2018-09-17 10:57:12 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'sum(detail.bottleNum) as allbottleNum,sum(detail.drinkNum) as alldrinkNum 
 			' at line 2 - Invalid query: select saler.*,sum(detail.knot) as allknot,sum(detail.bucketNum) as allbucket
				sum(detail.bottleNum) as allbottleNum,sum(detail.drinkNum) as alldrinkNum 
 				from fn_saler saler  
				left join fn_saler_bill bill on bill.salerId = saler.id and saleTime = 2018-09-17
				left join fn_saler_bill_detail detail on detail.billId  = bill.id 
				group by saler.id 
ERROR - 2018-09-17 10:57:13 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'sum(detail.bottleNum) as allbottleNum,sum(detail.drinkNum) as alldrinkNum 
 			' at line 2 - Invalid query: select saler.*,sum(detail.knot) as allknot,sum(detail.bucketNum) as allbucket
				sum(detail.bottleNum) as allbottleNum,sum(detail.drinkNum) as alldrinkNum 
 				from fn_saler saler  
				left join fn_saler_bill bill on bill.salerId = saler.id and saleTime = 2018-09-17
				left join fn_saler_bill_detail detail on detail.billId  = bill.id 
				group by saler.id 
ERROR - 2018-09-17 10:57:26 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'sum(detail.bottleNum) as allbottleNum,sum(detail.drinkNum) as alldrinkNum 
 			' at line 2 - Invalid query: select saler.*,sum(detail.knot) as allknot,sum(detail.bucketNum) as allbucket
				sum(detail.bottleNum) as allbottleNum,sum(detail.drinkNum) as alldrinkNum 
 				from fn_saler saler  
				left join fn_saler_bill bill on bill.salerId = saler.id and saleTime = '2018-09-17'
				left join fn_saler_bill_detail detail on detail.billId  = bill.id 
				group by saler.id 
ERROR - 2018-09-17 14:45:33 --> Severity: Parsing Error --> syntax error, unexpected '}' E:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\models\Customer_model.php 185
ERROR - 2018-09-17 14:45:35 --> Severity: Parsing Error --> syntax error, unexpected '}' E:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\models\Customer_model.php 185
ERROR - 2018-09-17 14:45:36 --> Severity: Parsing Error --> syntax error, unexpected '}' E:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\models\Customer_model.php 185
ERROR - 2018-09-17 17:01:27 --> Query error: Column 'salerId' cannot be null - Invalid query: INSERT INTO `fn_customer` (`cname`, `address`, `phone`, `salerId`, `debtTime`, `meetTime`, `remark`) VALUES ('测A', '胶州', '18509898918', NULL, '10', '10', '')
ERROR - 2018-09-17 17:02:47 --> Query error: Column 'salerId' cannot be null - Invalid query: INSERT INTO `fn_customer` (`cname`, `address`, `phone`, `salerId`, `debtTime`, `meetTime`, `remark`) VALUES ('测A', '胶州', '18509898918', NULL, '15', '15', '')
