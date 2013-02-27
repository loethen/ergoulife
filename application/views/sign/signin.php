<?php if(validation_errors()): ?>
<div class="alert alert-error">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php echo form_open('sign/signin',array('class'=>'form-signin')); ?>
        <h2 class="form-signin-heading">请登录</h2>
        <input name='email' type="text" class="input-block-level" placeholder="Email address" value="<?=set_value('email'); ?>">
        <input name='password' type="password" class="input-block-level" placeholder="Password">
        <button class="btn btn-large btn-primary" type="submit">登录</button>
</form>