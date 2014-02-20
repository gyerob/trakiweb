<?php

/*
 * All database connection variables
 */

define('DB_USER', "root"); // db user
define('DB_PASSWORD', ""); // db password (mention your db password here)
define('DB_DATABASE', "traktorverseny"); // database name
define('DB_SERVER', "localhost"); // db server

mysql_query("SET character_set_client=utf8");

mysql_query("SET character_set_connection=utf8");

mysql_query("SET character_set_database=utf8");

mysql_query("SET character_set_results=utf8");

mysql_query("SET character_set_server=utf8");

mysql_query("SET NAMES 'utf8'");
?>