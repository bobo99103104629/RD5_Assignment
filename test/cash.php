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
  <!-- 根據所在頁面 印出對應的標題 -->
  <title>商品</title>
  <?php require_once ('js.php') ?>
</head>
<?php require_once '1.php' ?>
<body>
  <!-- 引入導覽列 -->
  <?php include('nav.php') ?>
  <?php include('jumbotron/page1.php')?>
  <div class="container my-3">
    <div class="row">
      <!-- 左側選單 -->
      <div class="col-12 col-lg-3 mb-3" style="max-height:30rem; overflow-y: scroll; overflow-x: hidden;">
        <div class="list-group">
          <?php
           $list_active =
           !(isset($_GET['category']) ||
           isset($_GET['search']) ||
           isset($_GET['page']) ||
           isset($_GET['discount']) )?'active':'';
          ?>
          <a data-toggle="modal" href="#loginModal" class="list-group-item list-group-item-action <?= $list_active ?>"><i class="material-icons">money</i> 我要提款</a>
          <a href="cash.php?discount" class="list-group-item list-group-item-action <?=(isset($_GET['discount']))?'active':'';?>"><i class="material-icons">local_atm</i> 我要存款</a>

          <?php
            $sql = "SELECT CID, CName, COUNT(*) CNum
                    FROM PRODUCT_VIEW WHERE PID='$user_id'GROUP BY CID
                    ORDER BY CID";
            $result = $conn->query($sql);
            while($rows = mysqli_fetch_array($result)){
              // 查詢該類別下有多少筆商品
              if(isset($_GET['category']) && $_GET['category']== $rows['CID']){
                $list_active='active';
              }else $list_active='';
              echo '<a href="deposit.php?category='. $rows['CID'] .'"
                      class="list-group-item list-group-item-action d-flex justify-content-between align-items-center '. $list_active .'">'. $rows['CName'] .
                    '<span class="badge badge-dark badge-pill">'. $rows['CNum'] .'</span></a>';
            }
          ?>
        </div>
      </div>

      <!-- 右側商品列表 -->
      <div class="col-12 col-lg-9">
        <div class="row">
          <?php
            //基本查詢指令
            $sql = "SELECT * FROM PRODUCT_VIEW WHERE PID='$user_id'";
            $result = $conn->query($sql);
            while($rows = mysqli_fetch_array($result)){

              echo '<div class="col-12 col-lg-4 mb-2">
                      <a href="product_detail.php?ID='. $rows['PID'] .'" class="text-dark product-item">
                        <div class="card">
                          <div class="card-body position-relative">
                              
                            <div class="row no-gutters text-left text-lg-center">
                              <div class="col-4 col-lg-12 text-center">
                                <img src="' . $rows['PImg'] . '" class="img-fluid mb-3" style="max-height:6rem; width:auto;">
                              </div>
                              <div class="col-8 col-lg-12">
                                <h5 class="card-title mb-1 text-truncate">' . $rows['PName'] . '</h5>
                                <p class="card-text mb-2 text-truncate">' . $rows['PInfo'] . '</p>
                                <span class="badge badge-dark ">' .$rows['CName']  . '</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>';
              
            }
          ?>
          <div class="col-12 col-lg-9 <?php if(!isset($_GET['page'])) echo 'd-none'; ?>">
            <?php include('search.php')  ?>
          </div>
        </div>
        <hr>
      </div>
    </div>
  </div>
  
  <?php include('footer.php') ?>
</body>
</html>