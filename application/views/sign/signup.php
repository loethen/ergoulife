<?php if(validation_errors()): ?>
<div class="alert alert-error">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php echo form_open('sign/signup',array('class'=>'form-signup')); ?>
        <h3 class="form-heading">请注册</h3>
        <div class="group">
        	<label>昵称</label>
        	<input name='nickname' type="text" class="input-block-level" placeholder="Name" value="<?=set_value('name'); ?>">
        	<label>邮件地址</label>
        	<input name='email' type="text" class="input-block-level" placeholder="Email address" value="<?=set_value('email'); ?>">
	        <label>密码</label>
	        <input name='password' type="password" class="input-block-level" placeholder="Password">
	        <button class="btn btn-block btn-margin10 btn-primary" type="submit">注册</button>
        </div>
        
</form>