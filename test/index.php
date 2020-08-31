<?php session_start(); ?>


<?php include('connection.php'); ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- 引入CSS等樣式內容 -->
  <?php include('style.php') ?>
  <title>BOBO銀行</title>
  <?php require_once ('js.php') ?>
</head>

<body>
  <!-- 引入導覽列 -->
  <?php include('nav.php') ?>
  <div class="container">
  </div>
  <?php include('jumbotron/head.php') ?>
  <div class="container my-3">

  </div>

  <?php include('footer.php') ?>
</body>

</html>
