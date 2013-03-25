<div class="border-gray">
	<h1>账户设置</h1>
	<div class="account">
		<?php echo form_open('usercenter/set_avatar',array('enctype'=>'multipart/form-data','class'=>'form-horizontal form-avatar'));?>
		  <legend>修改资料</legend>
		  <div class="control-group">
		    <label class="control-label" for="inputEmail">邮件地址</label>
		    <div class="controls">
		      <span class="input uneditable-input"><?=$res->email?></span>
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="profile">个人签名</label>
		    <div class="controls">
		      <input type="text" name='avadar' id="profile" placeholder="say something">
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
		  <?php 
		  if(isset($success)){
		  	echo '密码更新成功';
		  }
		  if(isset($error)){
		  	echo $error;
		  }
		  ?>
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
