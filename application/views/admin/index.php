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

<?php echo form_open('admin/add_brand',array('enctype'=>'multipart/form-data','class'=>'form-horizontal admin_form'));?>
  <input type="hidden" name='path' id="path">
  <div class="control-group">
    <label class="control-label" for="inputCnBrand">品牌名称</label>
    <div class="controls">
      <input type="text" name="brandname" id="inputCnBrand" placeholder="Name" value="<?= set_value('cnbrand'); ?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputImage">上传图片</label>
    <div class="controls">
      <input type="file" name='imgfile' id="inputImage" placeholder="Upload">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputImage"></label>
    <div class="controls">
      <div id="respos"></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputArea">分类</label>
    <div class="controls">
      <select name="category" id="inputCate">
      <?php foreach($res as $row): ?>
        <option value="<?=$row->id?>"><?=$row->cate_name?></option>
      <?php endforeach;?>
      </select>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputArea">产地</label>
    <div class="controls">
      <input type="text" name="area" id="inputArea" placeholder="area" value="<?= set_value('area'); ?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputDes">品牌描述</label>
    <div class="controls">
      	<textarea rows="3" name="description" id='inputDes' placeholder="Brand description"><?php echo set_value('description'); ?></textarea>
    </div>
  </div>
  <div class="control-group">
      <div class="controls">
      		<button type="submit" class="btn btn-primary">确认添加</button>
      </div>
  </div>
</form>
<?php endif; ?>