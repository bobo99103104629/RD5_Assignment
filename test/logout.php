<?php
session_start();

// 清空登入的Session
unset($_SESSION['ID']);
header("Location: index.php");
?>