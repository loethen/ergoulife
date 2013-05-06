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
					<a href="javascript:;" id="taobao" class="btn btn-xlarge btn-warning">淘宝(或天猫)</a>
					<a href="javascript:;" id="othersite" class="btn btn-xlarge btn-info">其他网上商城</a>	
				</div>
				<div class="tb">
					<form method="POST" id="tb-form" action="<?=site_url('taobao/tbnew')?>">
					<div class="input-append span12 btn-margin10">
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
							<textarea name="description" class="span12" id="des" rows="3"></textarea>
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
				<div class="other text-left">
					<form method="POST" id="b2c-form" action="<?=site_url('taobao/b2cnew')?>">
						<input type="hidden" id="bing-imgs" name="itemimgs">
						<div class="form-inline">
							<input type="text" name="url" class='span10' placeholder="粘贴商品链接">
							<span class="help-inline">粘贴商品链接</span>
						</div>
						<div id="b2c-container" class="loe-unit clearfix">
							<p class="text-success">商品详情.</p>
							<div class="form-inline">
								<input type="text" name="title" class='span10' placeholder="粘贴商品标题">
								<span class="help-inline">标题可修改</span>
							</div>
							<div class="form-inline margin15">
								<input type="text" class="input-small" name="shopname" placeholder="来自哪个网站？">
  								<input type="text" class="input-small" name="price" placeholder="价格:">
								<span class="help-inline">如亚马逊，京东，苏宁易购，amazon，dragstore等</span>
							</div>
							<div>
								<a href="#bingModal" role="button" class="btn btn-warning" data-toggle="modal">
									在线选择商品图片
								</a>
							</div>
							<div id="bing-wrap"></div>
						</div>
						<script id="bing-tmpl" type='text/x-jquery-tmpl'>
						<div class="span6">
							<a class="thumbnail" href="#">
								<img class="thumb-big" src="${bingFirst(itemimg)}" alt="">
							</a>
						</div>
						<div class="clear"></div>
						<div class="thumb-min clearfix">
							{{each itemimg}}
							<a href="javascript:;" class="thumbnail w40">
								<img src="${bingSize($value,40)}" alt="">
							</a>
							{{/each}}
						</div>

						<div class="clear"></div>
						<div id="tb-recommend" class="text-left well clearfix">
							<p class="text-warning">推荐理由(必填)</p>
							<textarea name="description" class="span12" id="des" rows="3"></textarea>
							<div class="clear"></div>
							<p class="text-error pull-left" id="des-tip">推荐理由必须填写</p>
							<button type="submit" class="tb-submit btn btn-primary btn-large pull-right">立即添加</button>
						</div>
						</script>
						<script>
						function bingSize(str,size){
							str = str+'&w='+size+'&h='+size
							return str
						}
						function bingFirst(arr){
							return bingSize(arr[0],310)
						}
						</script>
					</form>
					<div id="bingModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h3 id="myModalLabel">在线搜索商品图片</h3>
						</div>
						<div class="modal-body">
							<form class="bing-form-search">
							  	<input name="bingkey" autocomplete='off' id="bingkey" type="text" placeholder="商品关键字" class="input-xlarge search-query">
							  	<button type="submit" class="btn">搜索</button>
							</form>
							<div id="bingRes"></div>
						</div>
						<div class="modal-footer">
							<p class="text-error pull-left" id="imgtip"></p>
							<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
							<button id="chooseOk" class="btn btn-warning">ok,选好了！</button>
						</div>
					</div>	
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
