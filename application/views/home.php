<!-- Main hero unit for a primary marketing message or call to action -->
<div class="da-thumbs-bg">
    <h1>猫粮品牌</h1>
    <ul id="da-thumbs" class="da-thumbs clearfix">
        <?php foreach($brand as $row): ?>
        <li>
            <a href="<?=site_url('subject/'.$row->id)?>"  data-content="<?php echo $row->description.'----[产地] '.$row->field?>" data-placement="bottom" data-delay="{ show: 500, hide: 100 }">
                <img src="<?=base_url().'/uploads/thumb/'.$row->img?>" />
                <div><span><?=$row->cnname?></span></div>
            </a>
        </li>
        <?php endforeach; ?>    
    </ul>
</div>