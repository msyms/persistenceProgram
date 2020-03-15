<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-10-08 11:45:11 --> Query error: Unknown column 'customer.name' in 'where clause' - Invalid query: select customer.*,saler.name from fn_customer customer 
				left join fn_saler saler on customer.salerId = saler.id where 1 = 1 and customer.name like '%辛%'  limit 0, 20
