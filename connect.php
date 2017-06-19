<?php
//how to connect to a database
$msql_host = 'localhost';
$msql_user = 'j';
$msql_pass = 'j85';

@$msql_con = mysqli_connect($msql_host, $msql_user, $msql_pass) or die('Database connection unsucessful');

mysqli_select_db($msql_con, 'new_database') or die('Database not found');

echo 'connection successful';

?>