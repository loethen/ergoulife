<?php if($this->session->userdata('admin')==true) : ?>
<div class='cate-table'>
<table class="table table-hover">
	<thead>
		<tr>
			<th>id</th>
			<th>分类名称</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($res as $row): ?>
		<tr>
			<td><?=$row->id?></td>

			<td><?=$row->cate_name?></td>
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