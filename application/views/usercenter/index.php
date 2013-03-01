
<?php if($this->session->userdata('admin')==true) : ?>
<ul class="nav nav-tabs">
  <li class="active">
    <a href="#">添加品牌</a>
  </li>
  <li>
  	<a href="#">管理品牌</a>
  </li>
  <li>
  	<a href="#">...</a>
  </li>
</ul>
<div class="alert alert-error">
	<?=$error;?>
</div>
<form class="form-horizontal" enctype='multipart/form-data' >
  <div class="control-group">
    <label class="control-label" for="inputBrand">品牌名称</label>
    <div class="controls">
      <input type="text" id="inputBrand" placeholder="name">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputImage">上传图片</label>
    <div class="controls">
      <input type="file" name='imgfile' id="inputImage" placeholder="Upload">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputArea">产地</label>
    <div class="controls">
      <input type="text" id="inputArea" placeholder="area">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputDes">品牌描述</label>
    <div class="controls">
      	<textarea rows="3" id='inputDes' placeholder="Brand description"></textarea>
    </div>
  </div>
  <div class="control-group">
      <div class="controls">
      		<button type="submit" class="btn btn-primary">确认添加</button>
      </div>
  </div>
</form>
<?php endif; ?>