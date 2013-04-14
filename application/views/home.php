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
        <div class="item bg-white">
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
                    <a class="like" href="javascipt:;" data-toggle="tooltip" title="喜欢+1"></a>
                    <a class="share" href="javascipt:;" data-toggle="tooltip" title="分享到新浪微博"></a>
                </div>
                <div class="pull-right lb">
                    <a href="<?=$item->link?>" class="arival-link">直达链接<i class="icon-chevron-right"></i></a>
                </div>
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