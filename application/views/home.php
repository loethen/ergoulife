<div class="row-fluid">
    <div class="span8 bg-white">
        <?php foreach ($items as $item): ?>
        <div class="item">
            <h3><a href="<?=site_url('subject/'.$item->id)?>"><?=$item->post_title?></a></h3>
            <div class="item-content">
                <?=$item->post_content?>
            </div>
            <div class="entry">
                <span class="entry-date"><?=$item->post_date?></span>
            </div>
        </div>
        <?php endforeach; ?>  
    </div>
    <div class="span4">
        
    </div>
</div>