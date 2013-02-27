<?php if(validation_errors()): ?>
<div class="alert alert-error">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php echo form_open('sign/signup',array('class'=>'form-signup')); ?>
        <h2 class="form-signin-heading">请注册</h2>
        <input name='email' type="text" class="input-block-level" placeholder="Email address" value="<?=set_value('email'); ?>">
        <input name='password' type="password" class="input-block-level" placeholder="Password">
        <input name='repassword' type="password" class="input-block-level" placeholder="rePassword">
        <button class="btn btn-large btn-primary" type="submit">注册</button>
</form>