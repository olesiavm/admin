<div class="id-parent">
    <div class="id-child">
    <table class="table table-striped table-bordered">
  	<thead>
	    <tr>
	    	<th>id</th>
		    <th>логин</th>
		    <th>хэш</th>
		    <th>имя</th>
		    <th>фамилия</th>
		    <th>пол</th>
		    <th>дата рождения</th>
			<th>права доступа</th>
	      	<th>статус</th>
	    </tr>
  	</thead>
  	<tbody>
		<tr>
			<td><?php echo	$user['id']; ?></td>
		    <td><?php echo  $user['login']; ?></td>
			<td><?php echo	$user['hash']; ?></td>
			<td><?php echo	$user['name']; ?></td>
			<td><?php echo	$user['surname']; ?></td>
			<td><?php echo	$user['gender']; ?></td>
			<td><?php echo	$user['birth_date']; ?></td>
			<td><?php echo	$user['role_id']; ?></td>
			<td><?php echo	$user['status']; ?></td>
			<td><a href="/edit-user-status/<?php echo $user['id']; ?>">Изменить статус</a>
			</td>
			<td><a href="/edit-user/<?php echo $user['id']; ?>">Изменить пользователя</a></td>
			<td><a href="/delete-user/<?php echo $user['id']; ?>">Удалить пользователя</a></td>
		</tr>
	</tbody>
</table>
</div>
</div>


