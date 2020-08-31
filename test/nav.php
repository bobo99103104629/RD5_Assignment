<?php
  // 取得當前頁面的檔名
  $this_page = pathinfo($_SERVER['PHP_SELF'])['filename'];

  $login_display = isset($_SESSION['ID'])?'d-none ':''; // 登入按鈕display
  $reg_display   = isset($_SESSION['ID'])?'d-none ':''; // 註冊按鈕display
  $user_display  = isset($_SESSION['ID'])?'':'d-none '; // 用戶按鈕display

  $admin_display  = ($user_position=='A')?'':'d-none '; // Admin和Staff的Display
?>
<?php require_once 'login.php' ?>
<nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-primary1 sticky-top " style="background:rgba(62,63,58,1);">
  <div class="container ">
    <a class="navbar-brand align-middle" href="index.php">
      <class="img-fluid" style="max-height:1.1rem"> BOBO銀行
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- 靠左 -->
      <ul class="navbar-nav mr-auto">
        <li class="nav-item <?=($this_page =='reg')?'active':'' ?> <?=isset($_SESSION['ID'])?'':'d-none'?>">
          <a class="nav-link" href="deposit.php">存款</a>
        </li>
        <li class="nav-item <?=($this_page =='reg')?'active':'' ?> <?=isset($_SESSION['ID'])?'':'d-none'?>">
          <a class="nav-link" href="customer_order.php">提款</a>
        </li>
        <li class="nav-item <?=($this_page =='reg')?'active':'' ?> <?=isset($_SESSION['ID'])?'':'d-none'?>">
          <a class="nav-link" href="customer_order.php">查詢餘額</a>
        </li>
        <li class="nav-item <?=($this_page =='reg')?'active':'' ?> <?=isset($_SESSION['ID'])?'':'d-none'?>">
          <a class="nav-link" href="customer_order.php">查詢明細</a>
        </li>
      </ul>

      <!-- 靠右 -->
      <ul class="navbar-nav ml-auto">
        <!-- Customer -->
        <li class="nav-item <?=($this_page =='product_list')?'active ':'' ?> <?=$admin_display ?>">
          <a class="nav-link" href="product_list.php">管理交易</a>
        </li>
        <li class="nav-item <?=($this_page =='login')?'active':'' ?> <?=$login_display ?>">
          <a class="nav-link" data-toggle="modal" href="#loginModal">登入</a>
        </li>
        <li class="nav-item <?=($this_page =='reg')?'active':'' ?> <?=$reg_display ?>">
          <a class="nav-link " href="reg.php">註冊</a>
        </li>


        <li class="nav-item <?=($this_page =='logout')?'active ':''?> d-none">
          <a class="nav-link" href="logout.php">
            <i class="material-icons">exit_to_app</i>
            登出 <?=$user_id ?>
          </a>
        </li>
        <li class="nav-item dropdown <?=isset($_SESSION['ID'])?'':'d-none'?>">
          <a class="nav-link dropdown-toggle" href="#" id="user" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">account_circle</i>
            <?=$user_name?>
            <?php
            if($user_position=='A'){
              echo '<span class="badge badge-pill badge-warning">會員</span>';
            }
            ?>
          </a>
          <div class="dropdown-menu" >
            <h6 class="dropdown-header">ID: <?=$user_id ?></h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" onclick="$.post('logout.php');location.reload();">
              <i class="material-icons">exit_to_app</i> 登出
            </a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
