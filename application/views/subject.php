	<h1 class="sj-title"><?=$item->post_title?></h1>
<div class="row-fluid">
	<div class="span8 sc rxitems">
		<div class="bg-white item-content item">
			<p><?=$item->post_desc?></p>
            <?php
                $imgarr = explode(',', $item->item_imgs);
                if($item->wherefrom=='taobao'){
                    $first = $imgarr[0]."_400x400.jpg";
                }else{
                    $first = $imgarr[0]."&w=400&h=400";
                }
            ?>
            <div class="fg">
                <div class="large-img">
                    <a>
                        <img src="<?=$first?>" alt="<?=$item->post_title?>"> 
                    </a> 
                </div>
                <div class="mini-img clearfix">
                <?php foreach($imgarr as $img): ?>
                    <a class="" href="javascript:;">
                    <?php if($item->wherefrom=='taobao'): ?>
                        <img src="<?=$img.'_40x40.jpg'?>" alt="">
                    <?php else: ?>
                        <img src="<?=$img.'&w=40&h=40'?>" alt="">
                    <?php endif; ?>
                    </a>
                <?php endforeach; ?>
                </div>
            </div>
		</div>
		<div id="talk" class="talk">
			<h4 class='teal'><?php $c = $item->comment_count; echo $c>0 ? "".$c." 条评论" : "还没有评论"?></h4>
            <ul class="comment-list media-list">
            <?php if(!$comments): ?>
                <li>快来发表第一条评论!</li>
            <?php else: ?>
            <?php foreach ($comments as $comment): ?>
            	<li class="media">
            		<a class="pull-left" href="#">
            			<img width="34px" class="media-object img-rounded" src="<?=base_url('/uploads/avatar/'.$comment->avatar)?>">
            		</a>
            		<div class="media-body">
            			<h4 class="media-heading clearfix">
                            <div class="pull-left"><a href="#"><?=$comment->name?></a>&nbsp;<?=$comment->created?></div>
                            <a href="javascript:;" data-id="<?=$comment->uid?>" data-name="<?=$comment->name?>" class="pull-right reply">回复</a>
                        </h4>
            			<p><?=$comment->content?></p>
            		</div>
            	</li>
            <?php endforeach; ?>
            <?php endif; ?>
            </ul>
            <div class="comment-form clearfix">
            	<h4 class="teal">添加新的评论······<small id="tiperr"></small></h4>
                <?php if($this->session->userdata('log_in')): ?>
                <form action="<?=site_url('comments/do_comment')?>" method='post'>
                	<input type="hidden" name='id' value="<?=$item->id?>">
                	<textarea rows='1' name="content" class='span12' placeholder='发表评论...'></textarea>
                	<button type="submit" class="btn">发表评论</button>
                </form>
                <?php else: ?>
                <p>需要 <a href="<?=site_url('sign/signin_form')?>">登录</a> 才能评论</p>
                <?php endif; ?>    
            </div>
        </div>
	</div>
	<div class="span4">
		<div class="bg-life">
			<a class="btn btn-block btn-primary" title="<?=$item->price?>" href="<?=$item->link?>">直达链接<i class="icon-chevron-right icon-white"></i></a>
		</div>
        <div class="bg-life">
            <span>价格：</span><span class="text-price">¥ <?=$item->price?></span>
        </div>
		<div class="bg-life">
			<span>店铺：</span><?=$item->shopname?>
		</div>
	</div>
</div>