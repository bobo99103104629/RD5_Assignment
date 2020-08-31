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
          <a href="deposit.php" class="list-group-item list-group-item-action <?= $list_active ?>"><i class="material-icons">view_list</i> 交易明細</a>
          <a href="deposit.php?discount" class="list-group-item list-group-item-action <?=(isset($_GET['discount']))?'active':'';?>"><i class="material-icons">qr_code</i> 帳戶號碼</a>

          <?php
            $sql = "SELECT CID, CName, COUNT(*) CNum
                    FROM PRODUCT_VIEW GROUP BY CID
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
            $search_keyword=$search_category=$price_from=$price_to=NULL;
            //基本查詢指令
            $sql = "SELECT * FROM PRODUCT_VIEW
                    WHERE PState = 'in_stock' ";

            if(isset($_GET['keyword'])){
              if($_GET['keyword']!=""){
                // 加入keyword做篩選條件
                $search_keyword=$_GET['keyword'];
                $sql .= "AND (PName LIKE '%$search_keyword%'
                        OR PInfo LIKE '%$search_keyword%'
                        OR CName LIKE '%$search_keyword%') ";
              }
            }
            if(isset($_GET['category'])){
              if($_GET['category']!=""){
                // 加入種類做篩選條件
                $search_category=$_GET['category'];
                $sql .= "AND CID=$search_category ";
              }
            }
            if(isset($_GET['price_from'])&&isset($_GET['price_to'])){
              if(is_numeric($_GET['price_from']) && is_numeric($_GET['price_to'])){
                if($_GET['price_from'] <= $_GET['price_to']){
                  // 加入價做篩選條件
                  $price_from=$_GET['price_from'];
                  $price_to=$_GET['price_to'];
                  $sql .= "AND (PPrice>=$price_from AND PPrice<=$price_to) ";
                }
              }
            }

            // 查看所有DISCOUNT中的項目
            if(isset($_GET['discount'])){
              $sql.= "AND (DEventType IS NOT NULL)";
            }

            $sql .= "ORDER BY CID,PID"; // 令查詢到的項目按類別->PID排序
            $result = $conn->query($sql);  // $result 存放查詢到的所有物件

            if(isset($_GET['discount'])){
              echo '<div class="col-12">
                    <div class="alert alert- text-danger text-center border-danger">
                    <em><strong>優惠活動中，售完為止！</strong></em>';
              echo '</div></div>';
            }

            if($search_keyword!=NULL || $search_category!=NULL || $price_from!=NULL || $price_to!=NULL)
            echo '<div class="col-12">
                  <div class="alert alert-info">
                    <i class="material-icons">search</i>
                    查到 <strong>'. mysqli_num_rows($result) .'</strong> 項商品。 搜尋條件：';
            if($search_keyword!=NULL)
              echo '<span class="badge badge-light">“'. $search_keyword .'”</span> ';
            if($search_category!=NULL)
              echo '<span class="badge badge-light">'. mysqli_fetch_array($conn->query("SELECT Name FROM CATEGORY WHERE ID=$search_category"))['Name'] .'</span> ';
            if($price_from!=NULL && $price_to!=NULL)
              echo '<span class="badge badge-light"> $'. $price_from .' ~ $'. $price_to .'</span> ';

            if($search_keyword!=NULL || $search_category!=NULL || $price_from!=NULL || $price_to!=NULL)
            echo '</div></div>';

            // 用迴圈把每列內容取出 存放在$rows 並印出
            if(!isset($_GET['page'])){
              while($rows = mysqli_fetch_array($result)){

              // 如果有折扣的話 顯示有折扣後的價格

              $gift_icon = '<span class="position-absolute" style="right:.8rem; top:.8rem;">
                              <i class="material-icons text-info">card_giftcard</i>
                            </span>';
              if($rows['DEventType']=='Discount'){
                $price_text='<span class="badge badge-danger ">NT$ ' . $rows['PPriceDiscountF'] . '</span> ';
                $price_text.='<span class="badge badge-info">Event</span> ';
              } else if($rows['DEventType']=='BOGO'){
                  $price_text='<span class="badge badge-primary ">NT$ ' . $rows['PPriceF'] . '</span> ';
                  $price_text.='<span class="badge badge-info">買一送一</span> ';
              } else{
                $price_text='<span class="badge badge-primary ">NT$ ' . $rows['PPriceF'] . '</span> ';
                $gift_icon = '';
              }

              echo '<div class="col-12 col-lg-4 mb-2">
                      <a href="product_detail.php?ID='. $rows['PID'] .'" class="text-dark product-item">
                        <div class="card">
                          <div class="card-body position-relative">
                              '.$gift_icon.'
                            <div class="row no-gutters text-left text-lg-center">
                              <div class="col-4 col-lg-12 text-center">
                                <img src="' . $rows['PImg'] . '" class="img-fluid mb-3" style="max-height:6rem; width:auto;">
                              </div>
                              <div class="col-8 col-lg-12">
                                <h5 class="card-title mb-1 text-truncate">' . $rows['PName'] . '</h5>
                                <p class="card-text mb-2 text-truncate">' . $rows['PInfo'] . '</p>'
                                 . $price_text . '
                                <span class="badge badge-dark ">' . $rows['CName'] . '</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>';
              }
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
