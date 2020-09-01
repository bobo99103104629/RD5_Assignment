<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name = '更改中' ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('style.php') ?>
  <title><?php echo  $page_name ?></title>
  <meta http-equiv="refresh" content="<?php echo 0 ?>;URL=product_list.php">
  <?php require_once ('js.php') ?>
</head>
<body>
  <?php include('nav.php'); ?>

  <?php include ('connection.php');


    $sql = "DELETE PRODUCT
      FROM PRODUCT
      WHERE pID =  $gg ";

      if ($conn -> query($sql) === TRUE)
        $_SESSION['AlertMsg'] = array('success','<i class="material-icons">done</i> 刪除成功！', false);
      else
        $_SESSION['AlertMsg'] = array('danger','<i class="material-icons">block</i> 刪除失敗！',false);

   ?>
   <?php include('footer.php') ?>
</body>


</html>
