<!-- Main hero unit for a primary marketing message or call to action -->
<?php foreach ($cates as $cate): ?>
<div class="da-thumbs-bg">
    <h1><?=$cate->cate_name?></h1>
    <ul id="da-thumbs" class="da-thumbs clearfix">
        <?php $cate_id = $cate->id; 
        foreach($brand as $row): 
            foreach ($row as $roow) :
                if($cate_id == $roow->catid):
        ?>
        <li>
            <a href="<?=site_url('subject/'.$roow->id)?>" data-content="<?=$roow->description?>">
                <img src="<?=base_url().'/uploads/thumb/'.$roow->img?>" />
                <div><span><?=$roow->cnname?></span></div>
            </a>
        </li>
        <?php 
                endif;
            endforeach;
        endforeach; ?>    
    </ul>
</div>
<?php endforeach; ?>