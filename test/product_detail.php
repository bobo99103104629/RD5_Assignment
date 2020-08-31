<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php
$sql = "SELECT * FROM PRODUCT_VIEW WHERE PID = ".$_GET['ID'];
$page_name = mysqli_fetch_array($conn->query($sql))['PName'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- 引入CSS等樣式內容 -->
  <?php include('style.php') ?>
  <title><?php echo  $page_name ?></title>
  <?php require_once ('js.php') ?>
</head>

<body>
  <!-- 引入導覽列 -->
  <?php include('nav.php') ?>
  <div class="container my-3">
    <div class="row">
      <?php
      $sql = "SELECT * FROM PRODUCT_VIEW WHERE PID = ".$_GET['ID'];

      $result = $conn->query($sql);
      $rows = mysqli_fetch_array($result);
      ?>

      <div class="col-12 col-lg-12 offset-lg-0">
        <div class="card py-3 " >
          <div class="card-body">
            <div class="row">

              <div class="col-12 col-lg-4 text-center">
                <img src="<?php echo $rows['PImg'] ?>" class="img-fluid rounded mx-auto d-block" style="max-height: 16rem; width: auto;">
              </div>
              <div class="col-12 col-lg-8">
                <div class="mb-3">
                  <h2 class="text-center text-lg-left d-inline"><?php echo $rows['PName']; ?></h2>
                  <span class="badge badge-dark badge-pill mx-2"><?php echo $rows['CName']; ?></span>
                </div>

                <hr class="my-4">
                <p><?php echo $rows['PInfo']; ?></p>
                <div class="card bg-light border-light">
                  <div class="card-body">
                    <div class="">
                      <h4 class="text-danger d-inline-block">NT$ </h4>
                      <?php
                      if($rows['PPriceDiscountF'] != ''){ // 有折扣
                          echo '<h1 class="text-danger d-inline-block price">'. $rows['PPriceDiscountF'].'</h1>';
                          echo '<h5 class="text-muted d-inline-block ml-2 "><del>NT$ '. $rows['PPriceF'].'</del></h5>';
                      }else{ // 無折扣
                        echo '<h1 class="text-danger d-inline-block price">'. $rows['PPriceF'].'</h1>';
                      }
                      ?>

                    </div>
                    <div>
                      <span class="badge badge-pill badge-primary">手續費: NT $0</span>
                      <!-- 印出資訊折扣的資訊 -->
                    </div>
                  </div>
                </div>
                <form class="my-4" method="post" action="cart_add.php">
                  <div class="form-group row ">
                  </div>
                </form>
                <hr class="my-4">
                <!-- 評論 -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include('footer.php') ?>
</body>

</html>
