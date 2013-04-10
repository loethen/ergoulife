<ul class="breadcrumb">
  <li><a href="<?=site_url() ?>"><i class="icon-home"></i></a> <span class="divider">/</span></li>
  <li><a href="<?=site_url('allbrand') ?>">所有品牌</a> <span class="divider">/</span></li>
  <li class="active"><?=$brand->brandname?></li>
</ul>
<h1 id="brand-head" data-id="<?=$brand->id?>"><?=$brand->brandname?></h1>
<div class='row-fluid'>
	<div class='span7'>
		<div class='brand-show'>
			<img src="<?=base_url().'uploads/'.$brand->img?>">
		</div>
		<div class="bg-gray">
			<h4>简介</h4>
			<p><?=$brand->description; ?></p>
		</div>
	
		<div class="bg-gray relate-post clearfix">
			<h4>相关商品</h4>
		<?php foreach($posts as $row): ?>
			<a data-toggle="popover" data-trigger="click" data-placement="right" data-content="<?=$row->link;?>" title="<?=$row->price;?>" href="<?=site_url().'/subject/'.$row->id;?>">
				<?=$row->post_title?>
			</a>
		<?php endforeach; ?>
		</div>
	</div>
	<div class='span5'>
		<div class="bg-white">
			<?php if($is_focus): ?>
			<a href="javascript:;" data-target="#myModal" data-flag="unfocus" id="focus" class="btn-block btn btn-info">已关注</a>
			<?php else: ?>
			<a href="javascript:;" data-target="#myModal"data-flag="focus" id="focus" class="btn-block btn btn-info">关注品牌</a>
			<?php endif; ?>
			<span>关注以后，你将收到 [<?=$brand->brandname?>] 最新的特价信息</span>
		</div>
		
	</div>
</div>