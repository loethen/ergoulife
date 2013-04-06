<div class="accordion" id="allbrand">
<?php foreach ($cates as $cate): ?>
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#allbrand">
        <?=$cate->cate_name?></i>
      </a>
    </div>
    <div class="accordion-body collapse in">
      <div class="accordion-inner">
        <?php $cate_id = $cate->id; 
        foreach($brand as $row): 
            foreach ($row as $roow) :
                if($cate_id == $roow->cateid):
        ?>
        <a href="<?=site_url('subject/'.$roow->id)?>" title="原产地：<?=$roow->area?>"><?=$roow->brandname?></a>
        <?php
                endif;
            endforeach;
        endforeach;
        ?>
      </div>
    </div>
  </div>
<?php endforeach;?>
</div>