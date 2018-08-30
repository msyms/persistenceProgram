<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-08-29 10:07:36 --> Query error: Unknown column 'salerId' in 'where clause' - Invalid query: SELECT *
FROM `fn_saler`
WHERE `salerId` = `Array`
ORDER BY `id` desc
 LIMIT 8
ERROR - 2018-08-29 10:07:38 --> Query error: Unknown column 'salerId' in 'where clause' - Invalid query: SELECT *
FROM `fn_saler`
WHERE `salerId` = `Array`
ORDER BY `id` desc
 LIMIT 8
ERROR - 2018-08-29 10:39:21 --> Severity: Error --> Call to undefined method Saler_model::get_saler() E:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\controllers\admin\Saler.php 209
ERROR - 2018-08-29 11:06:55 --> Query error: Unknown column 'cname' in 'field list' - Invalid query: SELECT `id`, `cname`, `phone`, `address`, `remark`
FROM `fn_saler`
WHERE `id` = 1
 LIMIT 1
ERROR - 2018-08-29 11:10:52 --> 404 Page Not Found: admin/Salerbill/add
ERROR - 2018-08-29 11:11:32 --> 404 Page Not Found: admin/Salerbill/add
ERROR - 2018-08-29 11:11:42 --> 404 Page Not Found: admin/Salerbill/add
ERROR - 2018-08-29 11:12:32 --> 404 Page Not Found: admin/Saler/billadd
ERROR - 2018-08-29 11:14:26 --> Severity: Parsing Error --> syntax error, unexpected '&' E:\phpStudy\WWW\persistenceProgram\finecms\cache\templates\finecms.dayrui.templates.salerbill_index.html.cache.php 4
ERROR - 2018-08-29 14:37:54 --> Query error: Column 'salerId' cannot be null - Invalid query: INSERT INTO `fn_saler_bill` (`salerId`, `bucketNum`, `bottleNum`, `checker`, `saleTime`, `remark`) VALUES (NULL, NULL, NULL, NULL, '2018-08-29', '')
ERROR - 2018-08-29 14:41:46 --> Query error: Column 'salerId' cannot be null - Invalid query: INSERT INTO `fn_saler_bill` (`salerId`, `bucketNum`, `bottleNum`, `checker`, `saleTime`, `remark`) VALUES (NULL, NULL, NULL, NULL, '2018-08-29', '')
ERROR - 2018-08-29 15:17:31 --> Query error: Column 'salerId' cannot be null - Invalid query: INSERT INTO `fn_saler_bill` (`salerId`, `bucketNum`, `bottleNum`, `checker`, `saleTime`, `remark`) VALUES (NULL, NULL, NULL, NULL, '2018-08-29', '')
ERROR - 2018-08-29 15:20:39 --> Query error: Column 'salerId' cannot be null - Invalid query: INSERT INTO `fn_saler_bill` (`salerId`, `bucketNum`, `bottleNum`, `checker`, `saleTime`, `remark`) VALUES (NULL, NULL, NULL, NULL, '2018-08-29', '')
ERROR - 2018-08-29 15:23:42 --> Query error: Column 'checker' cannot be null - Invalid query: INSERT INTO `fn_saler_bill` (`salerId`, `bucketNum`, `bottleNum`, `checker`, `saleTime`, `remark`) VALUES ('1', '20', '', NULL, '2018-08-29', '')
ERROR - 2018-08-29 17:19:11 --> Severity: Error --> Call to undefined method CI_DB_mysqli_result::where() E:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\models\Saler_model.php 132
ERROR - 2018-08-29 17:20:01 --> Severity: Error --> Call to undefined method CI_DB_mysqli_driver::count() E:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\models\Saler_model.php 132
ERROR - 2018-08-29 17:20:43 --> Severity: Error --> Call to undefined method CI_DB_mysqli_driver::result_array() E:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\models\Saler_model.php 132
ERROR - 2018-08-29 17:22:32 --> Query error: Unknown column 'id' in 'order clause' - Invalid query: SELECT *
FROM `fn_member`
ORDER BY `id` desc
 LIMIT 8, 8
