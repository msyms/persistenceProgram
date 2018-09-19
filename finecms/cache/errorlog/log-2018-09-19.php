<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-09-19 14:37:04 --> Query error: Unknown column 'bill.date' in 'where clause' - Invalid query: select bill.*,detail.bucketTotal,detail.bottleTotal from fn_saler_bill bill
				left join (select billId, sum(bucketNum) as bucketTotal,sum(bottleNum) as bottleTotal
				 			from fn_saler_bill_detail GROUP BY billId ) detail 
				on bill.id = detail.billId
				where bill.salerId = 2  and bill.date >= 2018-09-19 and bill.date <= 2018-09-19  order by bill.id desc 
ERROR - 2018-09-19 14:50:55 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''2018-09-19''  order by bill.id desc' at line 5 - Invalid query: select bill.*,detail.bucketTotal,detail.bottleTotal from fn_saler_bill bill
				left join (select billId, sum(bucketNum) as bucketTotal,sum(bottleNum) as bottleTotal
				 			from fn_saler_bill_detail GROUP BY billId ) detail 
				on bill.id = detail.billId
				where bill.salerId = 2  and bill.saleTime >= '2018-09-19' and bill.saleTime <= '2018-09-19''  order by bill.id desc 
ERROR - 2018-09-19 15:32:27 --> Severity: Parsing Error --> syntax error, unexpected '}' E:\phpStudy\WWW\persistenceProgram\finecms\cache\templates\finecms.dayrui.templates.saler_index.html.cache.php 55
