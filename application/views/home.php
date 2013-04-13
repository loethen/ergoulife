<div class="row-fluid">
    <div class="span8">
        <?php foreach ($items as $item): ?>
        <div class="item bg-white">
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
                    <a href="" class="arival-link">直达链接</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>  
    </div>
    <div class="span4">
        
    </div>
</div>