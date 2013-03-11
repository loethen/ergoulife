<?php foreach ($res as $row): ?>

<h1><?=$row->cnname?> <?=$row->enname?></h1>
<div class='row-fluid'>
	<div class='span6'>
		<div class='brand-show'>
			<img src="<?=base_url().'/uploads/'.$row->img?>">
		</div>
		<div class="bg-gray">
			<h4>品牌简介</h4>
			<p><?=$row->description; ?></p>
		</div>
	</div>
	<div class='span6'>
		<div class="rate">
			<p>如果你用过这个品牌的东西，请投出你神圣的一票，让其他的猫奴作为参考。</p>
			<div class='star'></div>
		</div>
	</div>
</div>

<?php endforeach; ?>