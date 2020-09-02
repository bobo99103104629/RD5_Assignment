<?php $bg_url='img/bg1.png';?>

<div class="jumbotron-fluid text-center bg-dark text-white" style="background:url('<?=$bg_url ?>');
  background-size: cover; background-position:center center; background-attachment:fixed;">
  <div class="container" style="padding:5rem 0;">
    <h1 id="head1" class="display-2 my-0 text-shadow-dark" >BOBO銀行</h1>
    <p  id="head2" class="lead text-shadow-dark" >Internet banking</p>
    <h5 id="head3" class="text-shadow-dark " style="letter-spacing:.5rem" >不專業の網路銀行系統</h5>
    <br>
    <div class="  <?php if(isset($_SESSION['ID']))echo'd-none' ?>">
    <button type="button" class="btn btn-outline-" data-toggle="modal" data-target="#loginModal">請先登入</button>
    </div>
    <div class="  <?php if(!isset($_SESSION['ID']))echo'd-none' ?>">
    <h1>您好！親愛的<?=$user_name ?></h1>
    <button onclick="location.href='cash.php'" class="btn btn-primary mt-3 mr-1">前往帳戶</button>
    </div>
  </div>
</div>
