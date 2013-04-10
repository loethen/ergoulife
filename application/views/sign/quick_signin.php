<?php echo form_open('sign/signin'); ?>
        <div class="group">
        	<label>Email</label>
        	<input type="hidden" name="cur_url" value="<?=$cur_url?>">
        	<input name='email' type="text" class="input-block-level" placeholder="Email address" value="<?=set_value('email'); ?>">
        	<label>密码</label>
        	<input name='password' type="password" class="input-block-level" placeholder="Password">
        	<button class="btn btn-block btn-margin10 btn-primary" type="submit">登录</button>
        </div>
</form>