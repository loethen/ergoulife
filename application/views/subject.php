<h1 id="brand-head" data-id="<?=$brand->id?>"><?=$brand->cnname?> <?=$brand->enname?></h1>
<div class='row-fluid'>
	<div class='span6'>
		<div class='brand-show'>
			<img src="<?=base_url().'/uploads/'.$brand->img?>">
		</div>
		<div class="bg-gray">
			<h4>品牌简介</h4>
			<p><?=$brand->description; ?></p>
		</div>
	</div>
	<div class='span6'>
		<div class="rate clearfix">
			<div class="rate-wrap pull-left">
				<div class="rate-bar clearfix">
					<span class='star5 pull-left'>5星</span>
					<div class="progress progress-info pull-left">
						<div class="bar" style="width: 1%"></div>
					</div>
					<em class='pull-left' data-star='5'><?=$rate->star5; ?></em>
				</div>
				<div class="rate-bar clearfix">
					<span class='star4 pull-left'>4星</span>
					<div class="progress progress-info pull-left">
						<div class="bar" style="width: 1%"></div>
					</div>
					<em class='pull-left' data-star='4'><?=$rate->star4; ?></em>
				</div>
				<div class="rate-bar clearfix">
					<span class='star3 pull-left'>3星</span>
					<div class="progress progress-info pull-left">
						<div class="bar" style="width: 1%"></div>
					</div>
					<em class='pull-left' data-star='3'><?=$rate->star3; ?></em>
				</div>
				<div class="rate-bar clearfix">
					<span class='star2 pull-left'>2星</span>
					<div class="progress progress-info pull-left">
						<div class="bar" style="width: 1%"></div>
					</div>
					<em class='pull-left' data-star='2'><?=$rate->star2; ?></em>
				</div>
				<div class="rate-bar clearfix">
					<span class='star1 pull-left'>1星</span>
					<div class="progress progress-info pull-left">
						<div class="bar" style="width: 1%"></div>
					</div>
					<em class='pull-left' data-star='1'><?=$rate->star1; ?></em>
				</div>	
			</div>
			<div class="aver-rate pull-right">
				<span id="avg">5星</span>
			</div>
		</div>
		<div class="rate">
			<p>如果你用过这个品牌的东西，请投出你神圣的一票，让其他的猫奴作为参考。</p>
			<div class="row-fluid">
				<div class="span4">
					<small>给该品牌打分:</small>
				</div>
				<div class="span5">
					<div class='star' data-score="<?=$init_rate?>"></div>
				</div>
			</div>
		</div>
		<div class=" comment">
			<span class="label label-comment">我要评论</span>
			<?php echo form_open('subject/comment',array('class'=>'')); ?>
			<h4>「我来回应」</h4>
        	<div class="clearfix">
	        	<textarea name="comment-content" id="comment-content" rows="3"></textarea>
	        	<button class="btn btn-small pull-right" type="submit">发表</button>
        	</div>
			</form>
		</div>
		
	</div>
</div>