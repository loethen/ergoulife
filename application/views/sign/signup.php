<?php if(validation_errors()): ?>
<div class="alert alert-error">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php echo form_open('sign/signup',array('class'=>'form-signup')); ?>
        <h2 class="form-heading">注册一个账号</h2>
        <div class="group">
        	<label>昵称</label>
        	<input name='name' type="text" class="input-block-level" placeholder="Name" value="<?=set_value('name'); ?>">
        	<label>邮件地址</label>
        	<input name='email' type="text" class="input-block-level" placeholder="Email address" value="<?=set_value('email'); ?>">
	        <label>密码</label>
	        <input name='password' type="password" class="input-block-level" placeholder="Password">
	        <button class="btn btn-block btn-large btn-margin10 btn-primary" type="submit">注册</button>
        </div>
        <div class="group">
            <div class="divider-top">
                <h4 class="divider-title">或者</h4>
            </div>    
        </div>
        <div class="group">
            <img src="http://img.t.sinajs.cn/t4/appstyle/open/images/website/loginbtn/loginbtn_02.png" alt="">
        </div>
        <div class="group">
            <div class="divider-top">
                <h4 class="divider-title">已有账号？</h4>
            </div>    
        </div>
        <div class="group">
            <a class="font16" href="<?=site_url('sign/signin_form')?>">请登录</a>
        </div>
</form>