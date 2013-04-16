<?php
ini_set('date.timezone','Asia/Shanghai');
function _time($time){
    $t=time()-$time;
    $f=array(
        '31536000'=>'年',
        '2592000'=>'个月',
        '604800'=>'星期',
        '86400'=>'天',
        '3600'=>'小时',
        '60'=>'分钟',
        '1'=>'秒'
    );

    foreach ($f as $k=>$v)
    {        
        if (0 != $c=floor($t/(int)$k))
        {
            return $c.$v.'前';
        }
    }
}
?>
<div class="row-fluid">
    <div class="span8">
        <?php foreach ($items as $item): ?>
        <div class="item bg-white" data-postid="<?=$item->id?>">
            <div class="entry-top clearfix">
                <div class="pull-left">
                    <?php $id = $item->id;
                    foreach ($tags as $key=>$tag):
                        if($key == $id):
                            foreach ($tag as $row):
                                 if($row->post_id == $id):
                    ?>
                    <a data-toggle="tooltip" data-original-title="标签：<?=$row->tag_name?>" href="<?=site_url('tag/'.$row->tag_id)?>">
                        <i class="icon-tag"></i>
                        <?=$row->tag_name?>
                    </a>
                    <?php 
                                endif;
                            endforeach;
                        endif;
                    endforeach;
                    ?>   
                </div>
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
                <?=$item->post_content?>
            </div>
            <div class="entry-misc clearfix">
                <div class="pull-left ep clearfix">
                    <a class="like" href="javascript:;" data-toggle="tooltip" title="喜欢+1"></a>
                    <a class="share" href="javascript:;" data-toggle="tooltip" title="分享到新浪微博"></a>
                    <a class="comment" href="javascript:;" data-toggle="tooltip" title="点击发表评论"></a>
                </div>
                <div class="pull-right lb">
                    <a href="<?=$item->link?>" class="arival-link">直达链接<i class="icon-chevron-right"></i></a>
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
                <div class="comment-list"></div>
                <i class="comment-arr"></i>
            </div>
        </div>
        
        <?php endforeach; ?>  
    </div>
    <div class="span4 bg-rx">
        <ul class="nav nav-list bs-docs-sidenav">
            <li>
                <h2>分类 Categroy</h2>
            </li>
            <li>
                <a href="">
                    <i class="icon-chevron-right"></i>
                    宠物玩具
                </a>
            </li>
            <li>
                <a href="">
                    <i class="icon-chevron-right"></i>
                    医药
                </a>
            </li>
            <li>
                <a href="">
                    <i class="icon-chevron-right"></i>
                    保健品
                </a>
            </li>
            <li>
                <a href="">
                    <i class="icon-chevron-right"></i>
                    母婴
                </a>
            </li>
        </ul>
    </div>
</div>