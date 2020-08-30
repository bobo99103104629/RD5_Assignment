<?php $bg_url='img/bg1.jpg' ?>

<div class="jumbotron-fluid text-center bg-dark text-white" style="background:url('<?=$bg_url ?>');
  background-size: cover; background-position:center center; background-attachment:fixed;">
  <div class="container"><?php include('echo_alert.php') ?></div>
  <div class="container" style="padding:5rem 0;">
    <h1 id="head1" class="display-2 my-0 text-shadow-dark" >BOBO</h1>
    <p  id="head2" class="lead text-shadow-dark" >foods Online Shop System</p>
    <h5 id="head3" class="text-shadow-dark " style="letter-spacing:.5rem" >專業の食品購物系統</h5>
    <div id="head4">
      <button onclick="location.href='product.php'" class="btn btn-light mt-3 mr-1">去逛逛</button>
    </div>
  </div>
</div>
