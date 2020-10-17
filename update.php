<?php
session_start();

/* Database Credentials */
defined("DB_HOST") ? null : define("DB_HOST", "localhost");
defined("DB_USER") ? null : define("DB_USER", "root");
defined("DB_PASS") ? null : define("DB_PASS", "");
defined("DB_NAME") ? null : define("DB_NAME", "pix_db");


/* Connect */
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$connection->query("SET CHARACTER SET utf8");
$connection->query("SET NAMES utf8");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed! Please check your database credentials.");
    exit();
}else{

  /* update database */

  mysqli_query($connection, "ALTER TABLE settings ADD COLUMN `photo_download` int DEFAULT 1;");
  mysqli_query($connection, "ALTER TABLE settings ADD COLUMN `enable_registration` int DEFAULT 1;");
  mysqli_query($connection, "ALTER TABLE settings ADD COLUMN `enable_ad` int DEFAULT 1;");
  mysqli_query($connection, "ALTER TABLE settings ADD COLUMN `video_file_limit` int DEFAULT 10;");
  mysqli_query($connection, "ALTER TABLE user ADD COLUMN `is_verified` int DEFAULT 0;");
  mysqli_query($connection, "ALTER TABLE user ADD COLUMN `type` int DEFAULT 0;");


  /* Import ads table */
  // $query = '';
  // $sqlScript = file('updates/google_ads.sql');
  // foreach ($sqlScript as $line) {
    
  //   $startWith = substr(trim($line), 0 ,2);
  //   $endWith = substr(trim($line), -1 ,1);
    
  //   if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
  //     continue;
  //   }
      
  //   $query = $query . $line;
  //   if ($endWith == ';') {
  //     mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
  //     $query= '';   
  //   }
  // }

  // $query = '';
  // $sqlScript = file('updates/videos.sql');
  // foreach ($sqlScript as $line) {
    
  //   $startWith = substr(trim($line), 0 ,2);
  //   $endWith = substr(trim($line), -1 ,1);
    
  //   if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
  //     continue;
  //   }
      
  //   $query = $query . $line;
  //   if ($endWith == ';') {
  //     mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
  //     $query= '';   
  //   }
  // }
  


  /* close connection */
  mysqli_close($connection);

  printf("Database Updated successfully!");
  exit();
}
