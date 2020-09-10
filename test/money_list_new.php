<div class="col-12 col-lg-6 offset-lg-3 my-3">
  <?php
    // for CATEGORY
    $sql3 = "SELECT * FROM CATEGORY";
    $result3 = $conn -> query($sql3);
  ?>
  <div class="card">
    <div class="card-header text-center">存款</div>
    <div class="card-body">
      <form class="row" action="money_list_new_add.php" method="post" enctype="multipart/form-data" >
      <div class="col-12 col-lg-3 form-group">
          <label>代號 <span class="text-info">*</span></label>
          <input value="700" type="text" name="Number" placeholder="存款名稱" maxlength="3" class="form-control" onkeyup="this.value=this.value.replace(/\D/g,'').replace(/....(?!$)/g,'$& ')" required>
        </div>
        <div class="col-12 col-lg-6 form-group">
          <label>分行代號 <span class="text-info">*</span></label>
          <input value="1234567" type="text" name="Number2" placeholder="存款名稱" maxlength="8" class="form-control" onkeyup="this.value=this.value.replace(/\D/g,'').replace(/....(?!$)/g,'$& ')" required>
        </div>
      <div class="col-12 col-lg-9 form-group">
          <label>存款帳號 <span class="text-info">*</span></label>
          <input value="1234567" type="text" name="Name" placeholder="存款名稱" maxlength="8" class="form-control" onkeyup="this.value=this.value.replace(/\D/g,'').replace(/....(?!$)/g,'$& ')" required>
        </div>
        <div class="col-12 col-lg-6 form-group">
          <label>金額 <span class="text-info">*</span></label>
          <input type="number" value="250" name="Price" placeholder="" maxlength="5" class="form-control" required>
          <small class="text-muted">單筆不得超過NT$500萬</small>
        </div>

        <div class="col-12 form-group">
          <label>存款簡介 <span class="text-info">*</span></label>
          <textarea type="text" name="Info" placeholder="" maxlength="100" class="form-control" rows="5" required>我中樂透啦！</textarea>
        </div>

        <div class="col-12 col-lg-6 form-group">
          <label for="exampleFormControlFile1">上傳圖片</label>
          <input type="file" class="form-control-file" name="file">
        </div>
        <div class="col-12 form-group mt-3">
          <button class="btn btn-success btn-block" type="submit" >確認存款</button>
        </div>
      </form>
    </div>
  </div>
</div>
