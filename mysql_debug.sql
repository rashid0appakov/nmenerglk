
TIME: 0.000157 SESSION:  

SET NAMES 'utf8'

 from Bitrix\Main\DB\Connection->query() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/db/connection.php:379
 from Bitrix\Main\DB\Connection->queryExecute() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/php_interface/after_connect_d7.php:3
 from include() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/db/connection.php:1008
 from Bitrix\Main\DB\Connection->afterConnected() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/db/mysqliconnection.php:81
 from Bitrix\Main\DB\MysqliConnection->connectInternal() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/data/connection.php:53
--------------------------

TIME: 0.000128 SESSION:  

SET collation_connection = "utf8_unicode_ci"

 from Bitrix\Main\DB\Connection->query() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/db/connection.php:379
 from Bitrix\Main\DB\Connection->queryExecute() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/php_interface/after_connect_d7.php:4
 from include() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/db/connection.php:1008
 from Bitrix\Main\DB\Connection->afterConnected() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/db/mysqliconnection.php:81
 from Bitrix\Main\DB\MysqliConnection->connectInternal() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/data/connection.php:53
--------------------------

TIME: 3.0E-5 SESSION:  

SET LOCAL time_zone='+03:00'

 from Bitrix\Main\DB\Connection->query() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/db/connection.php:379
 from Bitrix\Main\DB\Connection->queryExecute() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/php_interface/after_connect_d7.php:5
 from include() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/db/connection.php:1008
 from Bitrix\Main\DB\Connection->afterConnected() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/db/mysqliconnection.php:81
 from Bitrix\Main\DB\MysqliConnection->connectInternal() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/data/connection.php:53
------------------------

TIME: 2.2E-5 SESSION:  

SET innodb_strict_mode='OFF'

 from Bitrix\Main\DB\Connection->query() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/db/connection.php:379
 from Bitrix\Main\DB\Connection->queryExecute() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/php_interface/after_connect_d7.php:6
 from include() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/db/connection.php:1008
 from Bitrix\Main\DB\Connection->afterConnected() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/db/mysqliconnection.php:81
 from Bitrix\Main\DB\MysqliConnection->connectInternal() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/data/connection.php:53
------------------------

TIME: 1.9E-5 SESSION:  

SET sql_mode=''

 from Bitrix\Main\DB\Connection->query() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/db/connection.php:379
 from Bitrix\Main\DB\Connection->queryExecute() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/php_interface/after_connect_d7.php:7
 from include() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/db/connection.php:1008
 from Bitrix\Main\DB\Connection->afterConnected() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/db/mysqliconnection.php:81
 from Bitrix\Main\DB\MysqliConnection->connectInternal() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/data/connection.php:53
------------------------

TIME: 0.000463 SESSION:  

SELECT NAME, VALUE 
FROM b_option 
WHERE MODULE_ID = 'main' 

 from Bitrix\Main\DB\Connection->query() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/config/option.php:196
 from Bitrix\Main\Config\Option::load() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/config/option.php:38
 from Bitrix\Main\Config\Option::get() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/httprequest.php:394
 from Bitrix\Main\HttpRequest->prepareCookie() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/httprequest.php:71
 from Bitrix\Main\HttpRequest->__construct() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/httpapplication.php:48
--------------------------

TIME: 0.000157 SESSION:  

SELECT SITE_ID, NAME, VALUE 
FROM b_option_site 
WHERE MODULE_ID = 'main' 

 from Bitrix\Main\DB\Connection->query() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/config/option.php:212
 from Bitrix\Main\Config\Option::load() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/config/option.php:38
 from Bitrix\Main\Config\Option::get() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/httprequest.php:394
 from Bitrix\Main\HttpRequest->prepareCookie() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/httprequest.php:71
 from Bitrix\Main\HttpRequest->__construct() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/lib/httpapplication.php:48
--------------------------

TIME: 1.2E-5 SESSION:  CONN: 

SELECT L.*, L.LID as ID, L.LID as LANGUAGE_ID, 	C.FORMAT_DATE, C.FORMAT_DATETIME, C.FORMAT_NAME, C.WEEK_START, C.CHARSET, C.DIRECTION FROM b_language L, b_culture C WHERE C.ID = L.CULTURE_ID  AND (L.LID='')  AND (L.ACTIVE='')  ORDER BY L.SORT 

 from CDatabaseMysql->Query() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/classes/general/main.php:4715
 from CAllLanguage::GetList() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/classes/mysql/main.php:48
 from CMain->GetLang() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/include.php:49
 from require_once() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/include/prolog_admin_before.php:31
 from require_once() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/interface/desktop.php:2
 from require() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/admin/index.php:2
------------------------------

TIME: 0 SESSION:  CONN: 

ERROR: [] 

 from CDatabaseMysql->Query() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/classes/general/main.php:4715
 from CAllLanguage::GetList() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/classes/mysql/main.php:48
 from CMain->GetLang() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/include.php:49
 from require_once() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/include/prolog_admin_before.php:31
 from require_once() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/modules/main/interface/desktop.php:2
 from require() /home/n/nmenergo/nm-energylk.ru/public_html/bitrix/admin/index.php:2
-------------------------
