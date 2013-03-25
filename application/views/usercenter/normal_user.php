<div class="border-gray">
	<h1>账户设置</h1>
	<div class="account">
		<?php echo form_open('usercenter/add_product',array('enctype'=>'multipart/form-data','class'=>'form-horizontal'));?>
		  <legend>修改资料</legend>
		  <div class="control-group">
		    <label class="control-label" for="inputEmail">邮件地址</label>
		    <div class="controls">
		      <input type="text" name="email" id="inputEmail" value="<?=$res->email?>">
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="inputImage">上传头像</label>
		    <div class="controls">
		      <input type="file" name='imgfile' id="inputImage" placeholder="Upload">
		    </div>
		  </div>
		  <div class="control-group">
		      <div class="controls">
		      		<button type="submit" class="btn btn-primary">更新资料</button>
		      </div>
		  </div>
		</form>	
		<hr>
		<?php echo form_open('usercenter/setpw',array('enctype'=>'multipart/form-data','class'=>'form-horizontal'));?>
		  <legend>修改密码</legend>
		  <?php if(validation_errors()): ?>
			<div class="alert alert-error">
				  <?=validation_errors(); ?>
			</div>
		  <?php endif; ?>
		  <div class="control-group">
		    <label class="control-label" for="oldPassword">旧密码</label>
		    <div class="controls">
		      <input type="password" name="oldpw" id="oldPassword">
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="newPassword">新密码</label>
		    <div class="controls">
		      <input type="password" name="newpw" id="newPassword">
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="rePassword">确认新密码</label>
		    <div class="controls">
		      <input type="password" name="repw" id="rePassword">
		    </div>
		  </div>
		  <div class="control-group">
		      <div class="controls">
		      		<button type="submit" class="btn btn-primary">更新密码</button>
		      </div>
		  </div>
		</form>		
	</div>
</div>
