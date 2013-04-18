	<h1 class="sj-title"><?=$post->post_title?></h1>
<div class="row-fluid">
	<div class="span8">
		<div class="bg-white item-content">
			<?=$post->post_content?>
		</div>
		<div id="#talk" class="talk">
			<h4 class='teal'><?php $c = $post->comment_count; echo $c>0 ? "".$c." 条评论" : "还没有评论"?></h4>
            <ul class="comment-list media-list">
            <?php foreach ($comments as $comment): ?>
            	<li class="media">
            		<a class="pull-left" href="#">
            			<img width="34px" class="media-object img-rounded" src="<?=base_url('/uploads/avatar/'.$comment->avatar)?>">
            		</a>
            		<div class="media-body">
            			<h4 class="media-heading"><?=$comment->name?>&nbsp;<?=$comment->created?></h4>
            			<p><?=$comment->content?></p>
            		</div>
            	</li>
            <?php endforeach; ?>
            </ul>
            <div class="comment-form clearfix">
            	<h4 class="teal">添加新的评论······</h4>
                <?php if($this->session->userdata('log_in')): ?>
                <form action="<?=site_url('comments/do_comment')?>" method='post'>
                	<input type="hidden" name='id' value="<?=$post->id?>">
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
			<a class="btn btn-block btn-primary" title="<?=$post->price?>" href="<?=$post->link?>">直达链接<i class="icon-chevron-right icon-white"></i></a>
		</div>
		<div class="bg-life">
			<span>所属品牌：</span><a href="<?=site_url('brand/'.$brand->id)?>"><?=$brand->brandname?></a>
		</div>
	</div>
</div>