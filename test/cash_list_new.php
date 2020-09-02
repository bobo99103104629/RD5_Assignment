<div class="col-12 col-lg-6 offset-lg-3 my-3">
  <?php
    // for CATEGORY
    $sql3 = "SELECT * FROM CATEGORY";
    $result3 = $conn -> query($sql3);
  ?>
  <div class="card">
    <div class="card-header text-center">提款</div>
    <div class="card-body">
      <form class="row" action="cash_list_new_add.php" method="post" enctype="multipart/form-data" >
        <div class="col-12 form-group">
          <label>提款帳戶 <span class="text-info">*</span></label>
          <input value="xxx－xxxxxxx－xxxxxxx" type="text" name="Name" placeholder="存款名稱" maxlength="20" class="form-control" required>
        </div>
        <div class="col-12 col-lg-6 form-group">
          <label>金額 <span class="text-info">*</span></label>
          <input type="number" value="250" name="Price" placeholder="" maxlength="5" class="form-control" required>
        </div>

        <div class="col-12 form-group">
          <label>存款簡介 <span class="text-info">*</span></label>
          <textarea type="text" name="Info" placeholder="" maxlength="100" class="form-control" rows="5" required>買了一瓶很貴的水。</textarea>
        </div>

        <div class="col-12 col-lg-6 form-group">
          <label for="exampleFormControlFile1">上傳圖片</label>
          <input type="file" class="form-control-file" name="file">
        </div>
        <div class="col-12 form-group mt-3">
          <button class="btn btn-success btn-block" type="submit" >確認新增</button>
        </div>
      </form>
    </div>
  </div>
</div>
