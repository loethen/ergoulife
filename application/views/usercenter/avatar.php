<div class="border-gray">
	<h1>头像设置</h1>
	<div class='msg-tip'>
	 <?php 
	  if(isset($success)){
	  	echo $success;
	  }
	  if(isset($error)){
	  	echo $error;
	  }
	?>
	</div>
	<div class="account">
		<?php echo form_open('avatar/setthumb',array('enctype'=>'multipart/form-data','class'=>'form-horizontal form-avatar'));?>
		  <legend>修改头像</legend>
		  <div class="control-group">
		    <label class="control-label" for="inputEmail">上传头像</label>
		    <div class="controls" style="position:relative;">
		      <img id="avatar" src="<?=base_url('uploads/avatar/'.$row->avatar)?>" alt="头像">
		      <span class="crop_preview" id="preview_box">
		      	<img src="<?=base_url('uploads/avatar/'.$row->avatar)?>" id="crop_preview">
		      </span>
		    </div>
		  </div>
		  <div class="control-group">
		      <div class="controls">
		      		<button type="submit" class="btn btn-primary">保存小头像</button>
		      		<small>修改完头像记得保存</small>
		      </div>
		  </div>
		</form>	
	</div>
</div>
