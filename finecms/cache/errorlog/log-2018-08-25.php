<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-08-25 19:04:50 --> Severity: Error --> Call to a member function limit_page() on null G:\phpStudy\WWW\finecms\finecms\dayrui\controllers\admin\Sale.php 70
ERROR - 2018-08-25 19:10:20 --> Query error: Table 'finecms.fn_sale' doesn't exist - Invalid query: SELECT count(*) as total
FROM `fn_sale`
ERROR - 2018-08-25 19:11:45 --> Severity: error --> Exception: Unable to locate the model you have specified: Saler_model G:\phpStudy\WWW\finecms\finecms\system\core\Loader.php 344
ERROR - 2018-08-25 19:12:06 --> Query error: Table 'finecms.fn_sale' doesn't exist - Invalid query: SELECT count(*) as total
FROM `fn_sale`
ERROR - 2018-08-25 19:13:28 --> Query error: Unknown column 'uid' in 'order clause' - Invalid query: SELECT *
FROM `fn_saler`
ORDER BY `uid` desc
 LIMIT 8
ERROR - 2018-08-25 19:24:35 --> 404 Page Not Found: admin/Sale/index
ERROR - 2018-08-25 19:24:42 --> 404 Page Not Found: admin/Saler/index
