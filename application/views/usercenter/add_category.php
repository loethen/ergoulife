<?php if($this->session->userdata('admin')==true) : ?>
<?php if(validation_errors()): ?>
<div class="alert alert-error">
  <?=validation_errors(); ?>
</div>
<?php endif; ?>

<?php if(!empty($error)): ?>
<div class="alert alert-error">
  <?=$error; ?>
</div>
<?php endif; ?>

<?php echo form_open('admin/add_category',array('enctype'=>'multipart/form-data','class'=>'form-horizontal'));?>
  <div class="control-group">
    <label class="control-label" for="inputEnBrand">分类名称</label>
    <div class="controls">
      <input type="text" name="category" id="inputCategory" placeholder="Category name">
    </div>
  </div>
  <div class="control-group">
      <div class="controls">
      		<button type="submit" class="btn btn-primary">确认添加</button>
      </div>
  </div>
</form>
<?php endif; ?>