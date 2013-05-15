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
                <?php
                    $imgarr = explode(',', $item->item_imgs);
                    if($item->wherefrom=='taobao'){
                        $first = $imgarr[0]."_310x310.jpg";
                    }else{
                        if(preg_match('/^http:\/\/im007\.b0\.upaiyun\.com/i', $imgarr[0])){
                            $first = $imgarr[0]."_310";
                        }else{
                            $first = $imgarr[0]."&w=310&h=310";
                        }
                    }
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
                        <?php if($item->wherefrom=='taobao'): ?>
                            <img src="<?=$img.'_40x40.jpg'?>">
                        <?php else: ?>
                            <?php if(preg_match('/^http:\/\/im007\.b0\.upaiyun\.com/i', $img)): ?>
                            <img src="<?=$img.'_40'?>">
                            <?php else: ?>
                            <img src="<?=$img.'&w=40&h=40'?>">
                            <?php endif; ?>
                        <?php endif; ?>
                        </a>
                    <?php endforeach; ?>
                    </div>
                </div>
                <p><?=$item->post_desc?></p>
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
                    价格： 
                    <span class='text-error font16'>¥  <?=$item->price?></span>
                </div>
                <div class="pull-right lb">
                    商家：
                    <span class='text-warning'>
                    <?php   if($item->wherefrom=='taobao'){
                                echo $item->shopname."  淘宝(天猫)";
                            }else{
                                echo $item->shopname;
                            }
                    ?>
                    </span>
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