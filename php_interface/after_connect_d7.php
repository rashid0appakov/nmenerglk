<?
$this->queryExecute("SET NAMES 'utf8'");
$this->queryExecute('SET collation_connection = "utf8_unicode_ci"');
$this->queryExecute("SET LOCAL time_zone='".date('P')."'");
$this->queryExecute("SET innodb_strict_mode='OFF'");
$this->queryExecute("SET sql_mode=''"); 
?>