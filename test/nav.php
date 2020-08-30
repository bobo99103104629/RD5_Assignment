<?php
  // 取得當前頁面的檔名
  $this_page = pathinfo($_SERVER['PHP_SELF'])['filename'];

  $login_display = isset($_SESSION['ID'])?'d-none ':''; // 登入按鈕display
  $reg_display   = isset($_SESSION['ID'])?'d-none ':''; // 註冊按鈕display
  $user_display  = isset($_SESSION['ID'])?'':'d-none '; // 用戶按鈕display

  $customer_display  = ($user_position=='C'||$user_position=='G')?'':'d-none '; // Customer和Guest的Display
  $admin_display  = ($user_position=='A'||$user_position=='S')?'':'d-none '; // Admin和Staff的Display
?>
<?php require_once 'login.php' ?>
<nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-primary1 sticky-top " style="background:rgba(62,63,58,1);">
  <div class="container ">
    <a class="navbar-brand align-middle" href="index.php">
      <class="img-fluid" style="max-height:1.1rem"> BOBO美食
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- 靠左 -->
      <ul class="navbar-nav mr-auto">


      </ul>

      <!-- 靠右 -->
      <ul class="navbar-nav ml-auto">
        <!-- Customer -->

        <li class="nav-item <?=($this_page =='login')?'':'' ?> <?=$login_display ?>">
          <a class="nav-link" data-toggle="modal" href="#loginModal">登入</a>
        </li>
        <li class="nav-item <?=($this_page =='reg')?'active ':'' ?> <?=$reg_display ?>">
          <a class="nav-link" href="reg.php">註冊</a>
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
              echo '<span class="badge badge-pill badge-warning">管理員</span>';
            }else if($user_position=='S'){
              echo '<span class="badge badge-pill badge-info">店員</span>';
            }
            ?>

          </a>
          <div class="dropdown-menu" >
            <h6 class="dropdown-header">ID: <?=$user_id ?></h6>
            <a class="dropdown-item <?=$customer_display ?>" href="customer_order.php">訂單</a>
            <a class="dropdown-item" href="member_information.php">會員資料</a>
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
