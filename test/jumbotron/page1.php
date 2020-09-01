<?php $bg_url='img/bg1.jpg';?>
<div class="jumbotron-fluid text-center bg-dark text-white" style="background:url('<?=$bg_url ?>');
  background-size: cover; background-position:center center; background-attachment:fixed;">
  <div class="container" style="padding:5rem 0;">
      <div class="col-12 my-3 my-lg-5 text-center">
        <div class="row">
          <div class="col-12">
            <div class="  <?php if(!isset($_SESSION['ID']))echo'd-none' ?>">
              <h1>存款：NT$ <?=$user_money?></h1>
            </div>
          </div>
          <div class="col-12 my-3 text-center">
            <h3 class="text-light d-block " >
            </h3>
            <h5 class="text-light my-3" style="opacity: .9"> 
            </h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
