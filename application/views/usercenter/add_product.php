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

<?php echo form_open('usercenter/add_product',array('enctype'=>'multipart/form-data','class'=>'form-horizontal'));?>
  <div class="control-group">
    <label class="control-label" for="inputEnBrand">产品名称</label>
    <div class="controls">
      <input type="text" name="pname" id="inputProduct" placeholder="Product name" value="<?= set_value('pname'); ?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputImage">上传图片</label>
    <div class="controls">
      <input type="file" name='imgfile' id="inputImage" placeholder="Upload">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputArea">所属品牌</label>
    <div class="controls">
      <select name="owner" id="owner">
      <?php foreach($res as $row): ?>
        <option value="<?=$row->id?>"><?=$row->cnname?></option>
      <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputDes">产品描述</label>
    <div class="controls">
      	<textarea rows="3" name="description" id='inputDes' placeholder="Product description"><?php echo set_value('description'); ?></textarea>
    </div>
  </div>
  <div class="control-group">
      <div class="controls">
      		<button type="submit" class="btn btn-primary">确认添加</button>
      </div>
  </div>
</form>
<?php endif; ?>