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

<?php if(!empty($status)): ?>
<div class="alert">
  <?=$status; ?>
</div>
<?php endif; ?>
<?php echo form_open('admin/add_product',array('enctype'=>'multipart/form-data','class'=>'form-horizontal'));?>
  <input type="hidden" name='path' id="path">

  <label for="inputTitle">标题</label>
  <input type="text" class="input-xxlarge" name="title" id="inputTitle" placeholder="title" value="<?= set_value('title'); ?>">
  <hr>
  <label for="inputArea">所属品牌</label>
  <select name="owner" id="owner">
    <?php foreach($res as $row): ?>
      <option value="<?=$row->id?>"><?=$row->brandname?></option>
    <?php endforeach; ?>
  </select>
  <hr>
  <label for="inputPrice">价格</label>
  <div class="input-prepend input-append">
    <span class="add-on">$</span>
    <input class="span2" name="price" id="inputPrice" type="text" value="<?= set_value('price'); ?>">
  </div>
  <hr>
  <label for="gotoshoping">直达链接</label>
  <div class="input-prepend input-append">
    <span class="add-on">http://</span>
    <input class="span2" name="link" id="gotoshoping" type="text" value="<?= set_value('link'); ?>">
  </div>
  <hr>
  <label for="inputDes">详情</label>
  <textarea rows="3" name="description" id='inputDes' placeholder="Product description"><?php echo set_value('description'); ?></textarea>
  <hr>
  <label for="inputTag">标签</label>
  <input type="text" id="tag">
  <a id="addtag" class="btn">添加标签</a>
  <div class="tags"></div>
  <hr>
  <label for="statu">发布为</label>
  <select name="statu" id="statu">
      <option slected='true' value="publish">公开的</option>
      <option value="publish">私人的</option>
  </select>
  <hr>
  <button type="submit" class="btn btn-primary">确认添加</button>
</form>
<?php endif; ?>