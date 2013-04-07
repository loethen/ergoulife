	<h1><?=$post->post_title?></h1>
<div class="row-fluid">
	<div class="span8">
		<div class="bg-white">
			<?=$post->post_content?>
		</div>
	</div>
	<div class="span4">
		<div class="bg-life">
			<a class="btn btn-block btn-primary" title="<?=$post->price?>" href="<?=$post->link?>">直达链接</a>
		</div>
		<div class="bg-life">
			<span>所属品牌：</span><a href="<?=site_url('brand/'.$brand->id)?>"><?=$brand->brandname?></a>
		</div>
	</div>
</div>