<?php
ini_set('date.timezone','Asia/Shanghai');
$this->load->helper('my');
?>
<div class="row-fluid">
    <div class="span8 rxitems">
        <?php foreach ($items as $item): ?>
        <div class="item bg-white" data-postid="<?=$item->id?>">
            <div class="entry-top clearfix">
                <div class="pull-right">
                    <?php
                    $time = $item->post_date;
                    $ut = strtotime($time);
                    echo "发布于 "._time($ut);
                    ?>
                </div>
            </div>
            <h1><a href="<?=site_url('subject/'.$item->id)?>"><?=$item->post_title?></a></h1>
            <div class="item-content">
                <p><?=$item->post_desc?></p>
                <?php
                    $imgarr = explode(',', $item->item_imgs);
                    $first = $imgarr[0]."_400x400.jpg";
                ?>
                <div class="fg">
                    <div class="large-img">
                        <a href="<?=site_url('subject/'.$item->id)?>">
                            <img src="<?=$first?>" alt="<?=$item->post_title?>"> 
                        </a> 
                    </div>
                    <div class="mini-img clearfix">
                    <?php foreach($imgarr as $img): ?>
                        <a class="" href="javascript:;">
                            <img src="<?=$img.'_40x40.jpg'?>" alt="">
                        </a>
                    <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="entry-misc clearfix">
                <div class="pull-left ep clearfix">
                    <a class="like" href="javascript:;" data-toggle="tooltip" title="喜欢+1"></a>
                    <a class="share" href="javascript:;" data-toggle="tooltip" title="分享到新浪微博"></a>
                    <a class="comment" href="javascript:;" data-toggle="tooltip" title="点击发表评论<?php $c = $item->comment_count; echo $c>0 ? ",已有".$c."条评论" : ""?>"></a>
                </div>
                <div class="pull-right lb">
                    <a href="<?=$item->link?>" target="_blank" class="arival-link">直达链接<i class="icon-chevron-right"></i></a>
                </div>
                <div class="pull-right lb">
                    <a href="<?=$item->link?>" target="_blank">价格：¥ <?=$item->price?></a>
                </div>
            </div>
            <div class="comments">
                <div class="comment-form">
                    <?php if($this->session->userdata('log_in')): ?>
                    <input type="text" class="span8" placeholder='发表评论...'>
                    <button type="submit" class="btn do-comment">发布评论</button>
                    <?php else: ?>
                    <p>需要 <a href="<?=site_url('sign/signin_form')?>">登录</a> 才能评论</p>
                    <?php endif; ?>    
                </div>  
                <ul class="comment-list media-list">
                </ul>
                <i class="comment-arr"></i>
            </div>
        </div>
        
        <?php endforeach; ?>  
    </div>
    <div class="span4 RX">
        <div class="Ym">
            <h3 class="tx hp">
                <span>你感兴趣的标签</span>
            </h3>
            <a class="qu" href="#">查看全部</a>
        </div>
        <div class="cloudtag">
            <?php foreach ($cloudtag as $cloud): ?>
            <a href="<?=site_url('tags/'.$cloud->tag_name)?>"><?=$cloud->tag_name?></a> <span class="divider">/</span>
            <?php endforeach; ?>
        </div>
    </div>
</div>