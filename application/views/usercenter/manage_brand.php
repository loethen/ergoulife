<?php if($this->session->userdata('admin')==true) : ?>
<div class='manage-table'>
<table class="table table-hover">
	<thead>
		<tr>
			<th>品牌名称</th>
			<th>Logo</th>
			<th>产地</th>
			<th>描述</th>
			<th>分类id</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($res as $row): $url = base_url(); ?>
		<tr>
			<td><?=$row->cnname?></td>
			<td><img src="<?=$url.'uploads/thumb/'.$row->img?>"></td>
			<td><?=$row->field?></td>
			<td><?=$row->description?></td>
			<td><?=$row->catid?></td>
			<td>
				<a data-id="<?=$row->id?>" href="#">删</a>
				<a href="#">改</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
</div>
<div class='pagination pagination-right pagination-large'>
<?=$page_output; ?>
</div>
<?php endif; ?>