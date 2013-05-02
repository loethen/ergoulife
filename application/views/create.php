<div class="row-fluid">
	<div class="span8">
		<div class="item">
			<div class="bg-guide">
				<h1>添加一件商品</h1>
				<ul class="breadguid clearfix">
					<li class="current">
						商品来源
						<span class="badge badge-warning">1</span>
					</li>
					<li class="guid-step2">
						添加商品
						<span class="badge">
							<hr>
							2
						</span>
					</li>
					<li class="guid-step3">
						添加完成
						<span class="badge">
							<hr>
							3
						</span>
					</li>
				</ul>		
			</div>
			<div class="guid-wrap">
				<div class="choose">
					<a href="javascript:;" id="taobao" class="btn btn-xlarge btn-info">来自淘宝</a>
					<a href="javascript:;" id="othersite" class="btn btn-xlarge btn-info">其他网站</a>	
				</div>
				<div class="tb">
					<form method="POST" id="tb-form" action="<?=site_url('taobao/tbnew')?>">
					<!--[if lt IE 9]>
					<span class="help-block text-left">粘贴商品链接,支持淘宝网和天猫</span>
					<![endif]-->
					<div class="input-append btn-margin10">
						<input class="span10" name="url" id="p-link" autocomplete='off' placeholder="粘贴商品链接,支持淘宝网和天猫" type="text">
					  	<a class="btn" id="loaditem">载入商品</a>
					</div>
					<input type="hidden" name="itemimgs" id="itemimgs">
					<script id="tb-tmpl" type='text/x-jquery-tmpl'>
						<p class="text-success">商品详情.</p>
						<div class="form-inline">
							<input type="text" name="title" class='span10' value='${item.title}'>
							<span class="help-inline">标题可修改</span>
						</div>
						<p class="shopname">店铺：${item.nick} <span class='text-error'>¥${item.price}</span></p>
						<input type="hidden" name="price" value="${item.price}">
						<input type="hidden" name="shopname" value="${item.nick}">
						<input type="hidden" name="num_iid" value="${item.num_iid}">
						<div class="span6">
							<a class="thumbnail" href="#">
								<img class="thumb-big" src="${firstElem(item.item_imgs.item_img)}" alt="">
							</a>
						</div>
						<div class="clear"></div>
						<div class="thumb-min clearfix">
							{{each item.item_imgs.item_img}}
							<a href="${addSize($value.url,310)}" class="thumbnail w40">
								<img src="${addSize($value.url,40)}" alt="">
							</a>
							{{/each}}
						</div>

						<div class="clear"></div>
						<div id="tb-recommend" class="text-left well clearfix">
							<p class="text-warning">推荐理由(必填)</p>
							<textarea name="description" class="span12" id="des" rows="2"></textarea>
							<div class="clear"></div>
							<p class="text-error pull-left" id="des-tip">推荐理由必须填写</p>
							<button type="submit" class="tb-submit btn btn-primary btn-large pull-right">立即添加</button>
						</div>
					</script>
					<script>
						function firstElem(arr){
							return addSize(arr[0].url,'310')
						}
						function addSize(str,size){
							str = str+'_'+size+'x'+size+'.jpg'
							return str
						}
						function arrToStr(arr){
							return arr.join();
						}
					</script>
					<div id="tb-container" class="loe-unit clearfix"></div>
					</form>
				</div>
				<div class="other">
					<form action="/entity/taobao/info" method="post" id="new-entity-form" enable="false">
						<label>其他商品</label>
						<br>
						
					</form>	
				</div>
			</div>
		</div>
	</div>
	<div class="span4">
        <div class="Ym">
            <h3 class="tx hp">
                <span>猫草种子</span>
            </h3>
        </div>
        <p>
        	成功添加一件商品可以获得一粒 “猫草种子”。你以后可以用来兑换一些我们提供的礼物。
        	或者，你可以把它埋在土里，浇水，施肥，过几天，就能长成猫草啦。
        </p>
	</div>
</div>