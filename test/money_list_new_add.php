<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name = '新增中' ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('style.php') ?>
  <title><?php echo  $page_name ?></title>
  <meta http-equiv="refresh" content="<?php echo 0 ?>;URL=money_list.php">
  <?php require_once ('js.php') ?>
</head>
<body>
  <?php include('nav.php'); ?>
  <?php
  //設定地點為台北時區
  date_default_timezone_set('Asia/Taipei');
      include ('connection.php');
      $name = $_POST['Name'];
      $price = $_POST['Price'];
      $info = $_POST['Info'];
      $ptime = Date("Y年m月d日 H:i:s");
      $uploadOk = 1;
      $total = $user_money-$price;
      if (!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name'])){
        // 未選擇圖片
        $target_file = 'img/no_img-01.png'; // 沒有選擇圖片時，設定成預設飲料圖
      } else{
        // 有選擇圖片
        $file = basename($_FILES["file"]["name"]);
        $fileExplode = explode(".", $file);
        $fileName = $fileExplode[0];  //檔名
        $fileType = $fileExplode[1];  //檔案類型

        $target_dir = "upload/";
        $target_file = $target_dir . md5(password_hash($fileName, PASSWORD_DEFAULT)) . "." . $fileType;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        if(!empty(basename($_FILES["file"]["name"]))) {
          $check = getimagesize($_FILES["file"]["tmp_name"]);
          if($check !== false) {
              $uploadOk = 1;
              move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
          }else{
            $_SESSION['AlertMsg'] = array('danger','<i class="material-icons">block</i> 檔案不為圖片！',false);
          }
        }else{
          $_SESSION['AlertMsg'] = array('danger','<i class="material-icons">block</i> 檔案不存在！',false);
        }

      }
      $result = $conn->query($sql);
      $sql = "INSERT INTO PRODUCT
              VALUE(null,'$user_id', '$name', $price, '$total', '$target_file', '$info', '$ptime','2')";
      if (($conn -> query($sql) === TRUE)||($user_money >= '0')){
        $_SESSION['AlertMsg'] = array('success','<i class="material-icons">done</i> 存款成功！', false);
        $sql = "UPDATE MEMBER
        SET money= $user_money++$price
        WHERE ID ='$user_id';";
        $conn->query($sql);

    }else{
      $_SESSION['AlertMsg'] = array('danger','<i class="material-icons">block</i> 存款失敗！',false);
    }
   ?>
   <?php include('footer.php') ?>
</body>


</html>