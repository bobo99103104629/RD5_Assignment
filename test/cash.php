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
          <a href="cash_list_mi.php" class="list-group-item list-group-item-action"><i class="material-icons">money</i> 我要提款</a>
          <a href="money_list.php" class="list-group-item list-group-item-action"><i class="material-icons">local_atm</i> 我要存款</a>
          <a href="cash_total.php" class="list-group-item list-group-item-action"><i class="material-icons">local_atm</i> 查詢記錄</a>
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
              echo '<a href="cash.php?category='. $rows['CID'] .'"
                      class="list-group-item list-group-item-action d-flex justify-content-between align-items-center '. $list_active .'">'. $rows['CName'] .'紀錄'.
                    '<span class="badge badge-dark badge-pill">'. $rows['CNum'] .'</span></a>';
            }
          ?>
        </div>
      </div>

      <!-- 右側商品列表 -->
      <div class="col-12 col-lg-9">
        <div class="row">
          <?php
            $search_keyword=$search_category=$price_from=$price_to=NULL;

            //基本查詢指令
            $sql = "SELECT * FROM PRODUCT_VIEW WHERE PID='$user_id'";
            if(isset($_GET['category'])){
              if($_GET['category']!=""){
                // 加入種類做篩選條件
                $search_category=$_GET['category'];
                $sql .= "AND CID=$search_category ";
              }
            }
            $sql .= "ORDER BY CID,PID"; // 令查詢到的項目按類別->PID排序
            $result = $conn->query($sql);
            $aaa = $conn->query($sql);
            if($search_keyword!=NULL || $search_category!=NULL || $price_from!=NULL || $price_to!=NULL)
            echo '<div class="col-12">
                  <div class="alert alert-info">
                    <i class="material-icons">search</i>
                    查到 <strong>'. mysqli_num_rows($aaa) .'</strong> 項商品。 搜尋條件：';
            if($search_category!=NULL)
              echo '<span class="badge badge-light">'.mysqli_fetch_array($conn->query("SELECT Name FROM CATEGORY WHERE ID=$search_category"))['Name'] .'</span> ';

            if($search_keyword!=NULL || $search_category!=NULL || $price_from!=NULL || $price_to!=NULL)
            echo '</div></div>';
            
            if(!isset($_GET['page'])){
              while($rows = mysqli_fetch_array($result)){
              
                echo '<div class="col-12 col-lg-4 mb-2">
                        <a href="cash_detail.php?ID='. $rows['PP'] .'" class="text-dark product-item">
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
            }
          ?>
        </div>
        <hr>
      </div>
    </div>
  </div>
  
  <?php include('footer.php') ?>
</body>
</html>