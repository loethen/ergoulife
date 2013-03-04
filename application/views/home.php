<!-- Main hero unit for a primary marketing message or call to action -->
<div class="da-thumbs-bg">
    <ul id="da-thumbs" class="da-thumbs clearfix">
        <?php foreach($brand as $row): ?>
        <li>
            <a href="#" data-toggle="popover" data-trigger="hover" data-title="<?=$row->cnname?>" data-content="<?php echo $row->description.'----[产地] '.$row->field?>" data-placement="bottom" data-delay="{ show: 500, hide: 100 }">
                <img src="<?=base_url().'/uploads/'.$row->img?>" />
                <div><span><?=$row->cnname?></span></div>
            </a>
        </li>
        <?php endforeach; ?>    
    </ul>
</div>

<!-- Example row of columns -->
<div class="row">
    <div class="span4">
        <h2>Heading</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn" href="#">View details &raquo;</a></p>
    </div>
    <div class="span4">
        <h2>Heading</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn" href="#">View details &raquo;</a></p>
   </div>
    <div class="span4">
        <h2>Heading</h2>
        <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
        <p><a class="btn" href="#">View details &raquo;</a></p>
    </div>
</div>

<hr>