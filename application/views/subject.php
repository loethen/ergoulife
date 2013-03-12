<?php foreach ($brand as $row): ?>

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
		<div class="rate clearfix">
			<?php foreach($rate as $star): ?>
			<div class="rate-wrap pull-left">
				<div class="rate-bar clearfix">
					<span class='star5 pull-left'>5星</span>
					<div class="progress progress-info pull-left">
						<div class="bar" style="width: 20%"></div>
					</div>
					<em class='pull-left'><?=$star->star5; ?></em>
				</div>
				<div class="rate-bar clearfix">
					<span class='star4 pull-left'>4星</span>
					<div class="progress progress-info pull-left">
						<div class="bar" style="width: 10%"></div>
					</div>
					<em class='pull-left'><?=$star->star4; ?></em>
				</div>
				<div class="rate-bar clearfix">
					<span class='star3 pull-left'>3星</span>
					<div class="progress progress-info pull-left">
						<div class="bar" style="width: 20%"></div>
					</div>
					<em class='pull-left'><?=$star->star3; ?></em>
				</div>
				<div class="rate-bar clearfix">
					<span class='star2 pull-left'>2星</span>
					<div class="progress progress-info pull-left">
						<div class="bar" style="width: 20%"></div>
					</div>
					<em class='pull-left'><?=$star->star2; ?></em>
				</div>
				<div class="rate-bar clearfix">
					<span class='star1 pull-left'>1星</span>
					<div class="progress progress-info pull-left">
						<div class="bar" style="width: 10%"></div>
					</div>
					<em class='pull-left'><?=$star->star1; ?></em>
				</div>	
			</div>
		<?php endforeach; ?>
			<div class="aver-rate pull-right">
				<span id="avg">6.6</span>
			</div>
		</div>
		<div class="rate">
			<p>如果你用过这个品牌的东西，请投出你神圣的一票，让其他的猫奴作为参考。</p>
			<div class="row-fluid">
				<div class="span4">
					<small>给该品牌打分:</small>
				</div>
				<div class="span5">
					<div class='star'></div>
				</div>
			</div>
		</div>

		<div id="uyan_frame"></div>
		<script type="text/javascript" id="UYScript" src="http://v1.uyan.cc/js/iframe.js?UYUserId=1752502" async=""></script>

	</div>
</div>

<?php endforeach; ?>