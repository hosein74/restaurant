<?php

$filename = 'db-backup.sql';
// MySQL host
$mysql_host = 'localhost';
// MySQL username
$mysql_username = 'root';
// MySQL password
$mysql_password = '';
// Database name
$mysql_database = 'resturant';
//$mysqlImportFilename ='db-backup-1529328159-f9756e8997a44960ed23118569ed9a48.sql';
//DONT EDIT BELOW THIS LINE
//Export the database and output the status to the page
$link=mysqli_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysql_error());
// Select database
mysqli_select_db($link,$mysql_database) or die('Error selecting MySQL database: ' . mysql_error());
mysqli_query($link,"SET NAMES 'utf8'");

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == ';')
{
    // Perform the query
    mysqli_query($link,$templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
    // Reset temp variable to empty
    $templine = '';
}
}
 echo "Tables imported successfully";

?>