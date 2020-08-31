<div class="discount" style=" background-image: linear-gradient(120deg, #e0c3fc 0%, #8ec5fc 100%);">
  <div class="container">
    <div class="row" style="cursor:pointer" onclick="location.href='deposit.php'">
      <div class="col-12 my-3 my-lg-5 text-center">
        <div class="row">
          <div class="col-12">
            <div class="  <?php if(!isset($_SESSION['ID']))echo'd-none' ?>">
              <h1>存款：<?=$user_money?></h1>
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
