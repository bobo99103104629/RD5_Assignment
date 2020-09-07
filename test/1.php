<div class="modal fade" id="loginModal" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">提款驗證</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row login-panel" method="post">
            <div class="col-5">
              <div id="LoginAlert" class="alert text-center d-none"></div>
            </div>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>php圖形驗證碼</title>
   
            <script>
            function refresh_code(){ 
                document.getElementById("imgcode").src="2.php"; 
            } 
            </script>

          <form name="form1" method="post" action="./3.php">
              <p>請輸入下圖字樣：</p><p><img id="imgcode" src="2.php" onclick="refresh_code()" /><br />
                點擊圖片可以更換驗證碼
              </p>
              <input type="text" name="checkword" size="10" maxlength="10" />
              <input type="submit" name="Submit" value="送出" />
          </form>
           
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
