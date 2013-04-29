<?php if(validation_errors()): ?>
<div class="alert alert-error">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php if(!empty($error)): ?>
<div class="alert alert-error">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<?=$error?>
</div>
<?php endif; ?>
<?php echo form_open('sign/signin',array('class'=>'form-signin')); ?>
        <h2 class="form-heading">登录到<br>ergoulife.com</h2>
        <div class="group">
            <img src="http://img.t.sinajs.cn/t4/appstyle/open/images/website/loginbtn/loginbtn_02.png" alt="">
        </div>
        <div class="group">
            <div class="divider-top">
                <h4 class="divider-title">或者</h4>
            </div>    
        </div>
        
        <div class="group">
        	<label>Email</label>
        	<input name='email' type="text" class="input-block-level" placeholder="Email address" value="<?=set_value('email'); ?>">
        	<label>密码</label>
        	<input name='password' type="password" class="input-block-level" placeholder="Password">
        	<button class="btn btn-block btn-margin10 btn-large btn-primary" type="submit">登录</button>
        </div>
        <div class="group">
            <div class="divider-top">
                <h4 class="divider-title">没有账号？</h4>
            </div>    
        </div>
        <div class="group">
            <a class="font16" href="<?=site_url('sign/signup_form')?>">请注册</a>
        </div>
</form>