<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-08-28 10:22:06 --> Severity: Error --> Call to a member function limit_page() on null E:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\controllers\admin\Customer.php 70
ERROR - 2018-08-28 10:22:09 --> Severity: Error --> Call to a member function limit_page() on null E:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\controllers\admin\Customer.php 70
ERROR - 2018-08-28 10:22:19 --> 404 Page Not Found: admin/Home/saler
ERROR - 2018-08-28 10:22:52 --> Severity: Error --> Call to a member function limit_page() on null E:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\controllers\admin\Customer.php 70
ERROR - 2018-08-28 10:29:15 --> Severity: Error --> Call to a member function limit_page() on null E:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\controllers\admin\Customer.php 70
ERROR - 2018-08-28 10:51:02 --> Severity: Error --> Call to undefined method Customer_model::addCustomer() E:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\controllers\admin\Customer.php 106
ERROR - 2018-08-28 10:51:11 --> Severity: Error --> Call to undefined method Customer_model::addCustomer() E:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\controllers\admin\Customer.php 106
ERROR - 2018-08-28 10:51:50 --> Query error: Column 'cname' cannot be null - Invalid query: INSERT INTO `fn_customer` (`cname`, `address`, `phone`, `remark`) VALUES (NULL, '1', '18509898918', '1')
ERROR - 2018-08-28 13:57:34 --> Query error: Unknown column 'phone' in 'field list' - Invalid query: INSERT INTO `fn_customer` (`cname`, `address`, `phone`, `remark`) VALUES ('测试', '测试', '18509898918', '1')
ERROR - 2018-08-28 15:22:10 --> 404 Page Not Found: admin/Customer/detail
ERROR - 2018-08-28 15:56:09 --> Query error: Unknown column 'phone' in 'field list' - Invalid query: INSERT INTO `fn_customer` (`cname`, `address`, `phone`, `remark`) VALUES ('测试', '胶州市', '18509898918', '测试')
ERROR - 2018-08-28 15:57:40 --> Query error: Unknown column 'phone' in 'field list' - Invalid query: INSERT INTO `fn_customer` (`cname`, `address`, `phone`, `debtBucket`, `debtMoney`, `depositBucket`, `remark`) VALUES ('反倒是', '范德萨', '18509898918', '1', '11', '1', '11')
ERROR - 2018-08-28 15:57:52 --> Query error: Unknown column 'phone' in 'field list' - Invalid query: INSERT INTO `fn_customer` (`cname`, `address`, `phone`, `debtBucket`, `debtMoney`, `depositBucket`, `remark`) VALUES ('反倒是', '范德萨', '18509898918', '1', '11', '1', '11')
ERROR - 2018-08-28 16:11:40 --> 404 Page Not Found: admin/Saler/detail
ERROR - 2018-08-28 16:13:46 --> Query error: Unknown column 'uid' in 'where clause' - Invalid query: SELECT `id`, `name`, `remark`, `phone`, `carNo`
FROM `fn_saler`
WHERE `uid` =0
 LIMIT 1
ERROR - 2018-08-28 16:14:03 --> Query error: Unknown column 'uid' in 'where clause' - Invalid query: SELECT `id`, `name`, `remark`, `phone`, `carNo`
FROM `fn_saler`
WHERE `uid` =0
 LIMIT 1
ERROR - 2018-08-28 16:28:03 --> Query error: Unknown column 'groupid' in 'field list' - Invalid query: UPDATE `fn_saler` SET `name` = '测试人员', `phone` = '15111111112', `groupid` = NULL
WHERE `id` = 1
ERROR - 2018-08-28 17:13:14 --> Severity: Error --> Call to undefined method Customer_model::get_customer() E:\phpStudy\WWW\persistenceProgram\finecms\finecms\dayrui\controllers\admin\Customer.php 98
ERROR - 2018-08-28 17:16:47 --> 404 Page Not Found: admin/Saler/detail
