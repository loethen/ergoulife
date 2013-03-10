<?php foreach ($res as $row): ?>

<h1><?=$row->cnname?> <?=$row->enname?></h1>
<div class='row-fluid'>
	<div class='span6 brand-show'>
		<img class='img-polaroid' src="<?=base_url().'/uploads/'.$row->img?>">
	</div>
	<div class='span6'>
		<p>如果你用过这个品牌的东西，请投出你神圣的一票，让其他的猫奴作为参考。</p>
		<div class='star'></div>
	</div>
</div>
<div class='row-fluid'>
	<div class='span6'>
		<h4>品牌简介</h4>
		<p><?=$row->description; ?></p>
	</div>
	<div class='span6'>
		
	</div>
</div>
<?php endforeach; ?>