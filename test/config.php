<?php
// 儲存MYSQL伺服器資訊, 及定義各種資訊
// define(名稱 , 值, case_insensitive)

if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST']== '127.0.0.1'){
  // 若當前主機為localhost
  define('db_host',     'localhost', false); // 資料庫host
  define('db_username', 'root',     false); // 資料庫用戶名
  define('db_password', '',         false); // 資料庫密碼
  define('db_name',     'bobo',     false); // 資料庫名稱
 }else{
  // 若當前主機在遠端上
  // 建立 'host_info.php'，如上方格式定義資料庫資訊。
  require_once 'host_info.php';
 }


function EchoCode($sql){
  echo '<pre>'.$sql.'</pre>';
}
