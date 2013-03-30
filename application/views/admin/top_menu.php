<?php if($this->session->userdata('admin')==true) : ?>
<?php 
	$current = $this->uri->segment(2,'add_brand');
?>
<ul class="nav nav-tabs">
  <li class="<?=($current==='add_brand')?'active':''?>">
    <a href="<?=site_url('admin/add_brand'); ?>">添加品牌</a>
  </li>
  <li class="<?=($current==='manage_brand')?'active':''?>">
  	<a href="<?=site_url('admin/manage_brand'); ?>">管理品牌</a>
  </li>
  <li class="<?=($current==='product_page')?'active':''?>">
  	<a href="<?=site_url('admin/product_page'); ?>">添加产品</a>
  </li>
  <li class="<?=($current==='manage_product')?'active':''?>">
    <a href="<?=site_url('admin/manage_product'); ?>">管理产品</a>
  </li>
  <li class="<?=($current==='category_page')?'active':''?>">
    <a href="<?=site_url('admin/category_page'); ?>">添加分类</a>
  </li>
  <li class="<?=($current==='category_manage')?'active':''?>">
    <a href="<?=site_url('admin/category_manage'); ?>">分类管理</a>
  </li>
</ul>
<?php endif; ?>