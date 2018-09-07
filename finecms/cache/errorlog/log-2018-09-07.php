<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-09-07 10:27:23 --> Query error: Table 'finecms.fn_saler_fuel' doesn't exist - Invalid query: SELECT count(*) as total
FROM `fn_saler_fuel`
WHERE `salerId` = '1'
ERROR - 2018-09-07 13:32:03 --> Severity: Error --> Call to undefined method CI_DB_mysqli_driver::wehre() E:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\models\Saler_model.php 121
ERROR - 2018-09-07 13:32:45 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND `date` <
ORDER BY `id` desc
 LIMIT 20' at line 5 - Invalid query: SELECT *
FROM `fn_saler_fuel`
WHERE `salerId` = '1'
AND `date` >
AND `date` <
ORDER BY `id` desc
 LIMIT 20
ERROR - 2018-09-07 14:45:25 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND `date` <
ORDER BY `id` desc
 LIMIT 20' at line 5 - Invalid query: SELECT *
FROM `fn_saler_fuel`
WHERE `salerId` = '1'
AND `date` >
AND `date` <
ORDER BY `id` desc
 LIMIT 20
ERROR - 2018-09-07 14:46:00 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND `date` <
ORDER BY `id` desc
 LIMIT 20' at line 5 - Invalid query: SELECT *
FROM `fn_saler_fuel`
WHERE `salerId` = '1'
AND `date` >
AND `date` <
ORDER BY `id` desc
 LIMIT 20
ERROR - 2018-09-07 14:50:46 --> Severity: Parsing Error --> syntax error, unexpected 'isset' (T_ISSET) E:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\controllers\admin\Saler.php 135
ERROR - 2018-09-07 15:19:27 --> Query error: Unknown column 'knot' in 'field list' - Invalid query: update fn_customer 
                set knot = knot + 10,
                debtMoney = debtMoney + 0,
                depositBucket = depositBucket + 2,
                debtBucket = debtBucket + 2
                where id = 2
ERROR - 2018-09-07 15:19:39 --> Query error: Unknown column 'knot' in 'field list' - Invalid query: update fn_customer 
                set knot = knot + 10,
                debtMoney = debtMoney + 0,
                depositBucket = depositBucket + 2,
                debtBucket = debtBucket + 2
                where id = 2
