<table class="table table-striped table-bordered">
  	<thead>
	    <tr>
	    	<th>id</th>
		    <th>логин</th>
		    <th>права доступа</th>
	      	<th>статус</th>
	      	<th></th>
	    </tr>
  	</thead>
  	<tbody>
		<?php foreach ($users as $rowUser): ?>
			<tr>
				<td><?php echo $rowUser['id']; ?></td>
			    <td><?php echo $rowUser['login']; ?></td>
				<td><?php echo $rowUser['role_id']; ?></td>
				<td><?php echo $rowUser['status']; ?></td>
				<td><a href="/show-user/<?php echo $rowUser['id']; ?>">Перейти</a></td>
			</tr>
		<? endforeach; ?>
	</tbody>
</table>


<div class="btn-group">
	<?php if (isset($page) && $page !== 0): ?>	
		<?php if ($page > 1): ?>
			<?php $backpage2 = '<a class="btn theme-button rounded" href= /show-users?page=1><<Первая страница</a>'; ?>
			<?php echo $backpage2 . " "; ?>
		<?php	endif; ?> 
		<?php  if ($page > 2): ?>
		  	<?php $backpage1 = '<a class="btn theme-button rounded" href= /show-users?page='. ($page - 1) ."><Предыдущая страница</a>"; ?>
		  	<?php echo $backpage1 . " "; ?>
		<?php	endif; ?> 
		<b><a class="btn theme-button" href="#"><?php echo " " . $page. " "; ?></a></b> 
		<?php if ($page < $total): ?>
			<?php $nextpage1 = '<a class="btn theme-button rounded" href= /show-users?page='. ($page + 1) .'>Следующая страница></a>'; ?>
			<?php echo $nextpage1 . " "; ?>
		<?php	endif; ?> 
		<?php if ($page < $total-1): ?>
			<?php $nextpage2 = '<a class="btn theme-button rounded" href= /show-users?page=' .$total. '>Последняя страница>></a>'; ?> 
			<?php echo $nextpage2; ?>
		<?php	endif; ?> 
	<?php	endif; ?>
</div> 