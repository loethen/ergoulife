<div class="border-gray">
	<h1>账户设置</h1>
	<div class='msg-tip'>
	<?php if(validation_errors()): ?>
		<div class="alert">
			<?=validation_errors(); ?>
		</div>
	  <?php endif; ?>
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
		<?php echo form_open('avatar/upload',array('enctype'=>'multipart/form-data','class'=>'form-horizontal form-avatar'));?>
		  <legend>更换头像</legend>
		  <div class="control-group">
		    <label class="control-label">
		    <?php if(!isset($res->avatar)): ?>
		    	<img src="<?=base_url('img/d-avatar.png')?>" class="img-rounded img-avatar" alt="头像" >
		    <?php else: ?>
				<img src="<?=base_url('uploads/avatar/'.$res->avatar)?>" alt="头像" class="img-rounded img-avatar" style="width: 48px; height: 48px;">
		    <?php endif; ?>
		    </label>
		    <div class="controls">
		    	<div class='w80 pos-relate'>
		    		<a href="javascript:;">选择图片</a>
		      		<input type="file" name='avatar' id="avatar">
		    	</div>
		    	<span class='filename'></span>
		      	<div class="progress progress-striped active">
				  <div class="bar" style="width: 0%;"></div>
				</div>
			    <button type="submit" class="btn btn-primary">上传头像</button>
			    <small>支持 gif | jpg | png 格式图片，不超过2M</small>
		    </div>
		  </div>
		</form>	
		<hr>
		<?php echo form_open('setting/set_profile',array('enctype'=>'multipart/form-data','class'=>'form-horizontal form-info'));?>
		  <legend>个人资料</legend>
		  <div class="control-group">
		  	<?php if($active=='true'):?>
		  	<p class='controls'>账号还没激活，<a id="sendAcEmail" href="<?=site_url('setting/active_email')?>">点击发送激活邮件</a></p>
		  	<?php else: ?>
		  	<p class='controls'>账号已经激活</p>
			<?php endif;?>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="inputEmail">昵称</label>
		    <div class="controls">
		      <input type="text" name='name' value="<?=$res->name?>">
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="inputEmail">邮件地址</label>
		    <div class="controls">
		      <span class="input uneditable-input"><?=$res->email?></span><small>  不可更改，如要更改，请联系管理员</small>
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="profile">个人签名</label>
		    <div class="controls">
		      <input type="text" name='profile' id="profile" placeholder="写点什么吧..." value="<?=$res->profile?>">
		    </div>
		  </div>
		  <div class="control-group">
		      <div class="controls">
		      		<button type="submit" class="btn btn-primary">更新资料</button>
		      </div>
		  </div>
		</form>	
		<hr>
		<?php echo form_open('setting/setpw',array('enctype'=>'multipart/form-data','class'=>'form-horizontal'));?>
		  <legend>修改密码</legend>
		  
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
