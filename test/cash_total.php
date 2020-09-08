<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name = '管理商品' ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- 引入CSS等樣式內容 -->
  <?php include('style.php') ?>
  <?php // 若無權限
  if(!($user_position=='A'))
    die ('<meta http-equiv="refresh" content="0;URL=index.php">');
  // 若未GET顯示頁面
  if(!(isset($_GET['show']))){
    die ('<meta http-equiv="refresh" content="0;URL=cash_total.php?show=list&page=0">');
  }else{
    // 若GET顯示頁面且為‘list’但未GET到頁數
    if($_GET['show']=='list'&&!(isset($_GET['page'])))
      die ('<meta http-equiv="refresh" content="0;URL=cash_total.php?show=list&page=0">');
  }
  ?>
  <!-- 根據所在頁面 印出對應的標題 -->
  <title><?php echo  $page_name ?></title>
  <?php require_once ('js.php') ?>
</head>
<body>

  <?php include('nav.php'); ?>

  <div class="container mt-3">
    <?php include('echo_alert.php') ?>

    <div class="row">
      <div class="col-12 btn-group">
        <button class="btn btn-outline-primary btn-lg <?php if($_GET['show']=='list')echo 'active '?>" onclick="location.href='?show=list'">查詢紀錄</button>
      </div>
      <!-- 管理商品 -->
      <div class="col-12 <?=($_GET['show']!='list')?'d-none ':''; ?> ">
        <?php
          if(isset($_GET['page'])){
            $total = mysqli_num_rows($conn->query("SELECT * FROM PRODUCT WHERE ID='$user_id'")); // 共幾筆資料
          
            $limit = 5; // 每頁5筆
            $start = $_GET['page'] * $limit;
            $currentPage=$_GET['page'];
            $maxPage= ceil($total/$limit);
          }
        ?>
        <table class="table mt-3 d-none d-lg-table ">
          <thead>
            <tr class="thead-dark text-center">
              <th scope="col" style="width:8rem">1.提款 2.存款</th>
              <th scope="col" style="width:8rem">帳戶</th>
              <th scope="col" style="width:5rem">金額</th>
              <th scope="col" style="width:10rem" >圖片</th>
              <th scope="col" style="width:8rem">介紹</th>
              <th scope="col" style="width:8rem">剩餘金額</th>
              <th scope="col" style="width:12rem">提款時間</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM PRODUCT WHERE ID='$user_id'";
            if(isset($_GET['page'])) // 若有GET到頁數
               $sql .= " ORDER BY pid DESC LIMIT $start, $limit";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
              while($row = $result->fetch_assoc()){
                
                

                echo
                '<tr class= "text-center">
                <td>' . $row["CategoryID"] . '</td>
                <td><a class="text-dark" href="cash_detail.php?ID='.  $row["pid"] .'">' . $row["Name"] . '</a></td>
                <td>' . 'NT$ '.$row["Price"] . '</td>
                <td class="text-center"> <img src ="' .$row['Img'] . '" class="img-fluid" style="max-height:5rem"></td>
                <td>' . $row["Info"] . '</td>
                <td>' . 'NT$ '.$row["total"] . '</td>
                <td>'. $row['ptime'] .'</td>

                

                </tr>';
              }
            }
            ?>
          </tbody>
        </table>
        <!-- 翻頁 -->
        <div class="btn-toolbar mt-3">
          <div class="d-inline-block mx-auto">
            <div class="btn-group mr-2">
              <?php $goPageURL = 'onclick="location.href=\'?show=list&page='. ($currentPage-1) .'\'" '; ?>
              <button type="button" <?=$goPageURL?> class="btn btn-secondary" <?=($currentPage==0)?'disabled':''?>>&laquo;</button>
            </div>
            <div class="btn-group mr-2" >
              <?php
                if(isset($_GET['page'])){
                  for ($i=0; $i < $maxPage ; $i++) {
                    $goPageURL = 'onclick="location.href=\'?show=list&page='. $i .'\'" ';
                    $isActive = ($currentPage==$i)?'active ':'';
                    echo '<button type="button" '. $goPageURL.' class="btn btn-secondary '. $isActive .' " >'. ($i+1) .'</button>';
                  }
                }
              ?>
            </div>
            <div class="btn-group" >
              <?php $goPageURL = 'onclick="location.href=\'?show=list&page='. ($currentPage+1) .'\'" '; ?>
              <button type="button" <?=$goPageURL?> class="btn btn-secondary" <?=($currentPage>=$maxPage-1)?'disabled':''?> >&raquo;</button>
            </div>
          </div>
        </div>
      </div>
      <!-- 新增 -->
      <?php if($_GET['show']=='new') include 'cash_total_new.php' ?>

    </div>
  </div>

  <?php include('footer.php') ?>
</body>

<html>
