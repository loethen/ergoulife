<?php foreach ($res as $row): ?>

<h1 id="brand-head" data-id="<?=$row->id?>"><?=$row->cnname?> <?=$row->enname?></h1>
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
			<div class="rate-bar clearfix">
				<span class='pull-left'>5星</span>
				<div class="progress progress-info pull-left">
					<div class="bar" style="width: 40%"></div>
				</div>
				<em class='pull-left'>50</em>
			</div>
			<div class="rate-bar clearfix">
				<span class='pull-left'>4星</span>
				<div class="progress progress-info pull-left">
					<div class="bar" style="width: 10%"></div>
				</div>
				<em class='pull-left'>20</em>
			</div>
			<div class="rate-bar clearfix">
				<span class='pull-left'>3星</span>
				<div class="progress progress-info pull-left">
					<div class="bar" style="width: 20%"></div>
				</div>
				<em class='pull-left'>28</em>
			</div>
			<div class="rate-bar clearfix">
				<span class='pull-left'>2星</span>
				<div class="progress progress-info pull-left">
					<div class="bar" style="width: 20%"></div>
				</div>
				<em class='pull-left'>20</em>
			</div>
			<div class="rate-bar clearfix">
				<span class='pull-left'>1星</span>
				<div class="progress progress-info pull-left">
					<div class="bar" style="width: 10%"></div>
				</div>
				<em class='pull-left'>5</em>
			</div>
		</div>
		<div class="rate">
			<p>如果你用过这个品牌的东西，请投出你神圣的一票，让其他的猫奴作为参考。</p>
			<div class='star'></div>
		</div>

		<div id="uyan_frame"></div>
		<script type="text/javascript" id="UYScript" src="http://v1.uyan.cc/js/iframe.js?UYUserId=1752502" async=""></script>

	</div>
</div>

<?php endforeach; ?>