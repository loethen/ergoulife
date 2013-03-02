<?php if($this->session->userdata('admin')==true) : ?>
<?php 
	$current = $this->uri->segment(2,'add_brand');
?>
<ul class="nav nav-tabs">
  <li class="<?=($current==='add_brand')?'active':''?>">
    <a href="<?=site_url('usercenter/add_brand'); ?>">添加品牌</a>
  </li>
  <li class="<?=($current==='manage_brand')?'active':''?>">
  	<a href="<?=site_url('usercenter/manage_brand'); ?>">管理品牌</a>
  </li>
  <li>
  	<a href="#">...</a>
  </li>
</ul>
<?php endif; ?>