<?php $bg_url='img/bg1.png';?>
<script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>

<div class="jumbotron-fluid text-center bg-dark text-white" style="background:url('<?=$bg_url ?>');
  background-size: cover; background-position:center center; background-attachment:fixed;">
  <div class="container" style="padding:5rem 0;">
      <div class="col-12 my-3 my-lg-5 text-center">
        <div class="row">
          <div class="col-12">
            <div class="  <?php if(!isset($_SESSION['ID']))echo'd-none' ?>">
            
            <?php
            $ff = str_repeat('*', mb_strlen($user_money, 'utf-8') );
            ?>
              <div id="app">
              <div v-if="!login"><h1>當前存款：NT$ <?=$user_money?></h1></div>
		          <div v-if='login'><h1>當前存款：NT$ <?=$ff?></h1></div>
              <button @click='toggleView'name='yy'>顯示或隱藏</button>
              </div>
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
<script type="text/javascript">
		var vm = new Vue({
			el: "#app",
			data:{
				login:false,
			},
			methods:{
				toggleView:function(value){
					this.login ^= true;
				}
			}
		})
	</script>