<form method="post">
	<table class="table table-sm form-table">
		<input type="hidden" name="id" value="<?php echo $rowUser['id']; ?>"><br>
		<tr>
			<td>Логин</td>
			<td><input type="text" name="login" value="<?php echo $rowUser['login']; ?>"><br></td>
		</tr>
		<tr>
			<td>Имя </td>
			<td><input type="text" name="name" value="<?php echo $rowUser['name']; ?>"><br></td>
		</tr>
		<tr>
			<td>Фамилия</td>
			<td><input type="text" name="surname" value="<?php echo $rowUser['surname']; ?>"><br></td>
		</tr>
		<tr>
			<td>Пол</td>
			<td><select name="gender">
				<?php if ($rowUser['gender'] == 1): ?>
				  	<option value="1" selected>Женский</option>
				<?php else: ?>
				 	<option value="1">Женский</option>
				<?php endif; ?>
				<?php if ($rowUser['gender'] == 0): ?>
				  	<option value="0" selected>Мужской</option>
				<?php else: ?>
				 	<option value="0">Мужской</option>
				<?php endif; ?>
			</select><br></td>
		</tr>

		<tr>
			<td>Дата рождения</td>
			<td><input type="date" max="<?php echo date("Y-m-d H:i:s"); ?>" name="birthDate" value="<?php echo $rowUser['birth_date']; ?>"><br></td>
		</tr>

		<tr>
			<td>Права доступа</td>
			<td><select name="roleId">
				<?php if ($rowUser['role_id'] == 1): ?>
				  	<option value="1" selected>Администратор</option>
				<?php else: ?>
				 	<option value="1">Администратор</option>
				<?php endif; ?>
				<?php if ($rowUser['role_id'] == 2): ?>
				  	<option value="2" selected>Менеджер</option>
				<?php else: ?>
				 	<option value="2">Менеджер</option>
				<?php endif; ?>
				<?php if ($rowUser['role_id'] == 3): ?>
				  	<option value="3" selected>Гость</option>
				<?php else: ?>
				 	<option value="3">Гость</option>
				<?php endif; ?>
			</select><br></td>
		</tr>

		<tr>
			<td>Статус</td>
			<td><select name="status">
				<?php if ($rowUser['status'] == 1): ?>
				  	<option value="1" selected>Активировированный пользователь</option>
				<?php else: ?>
				 	<option value="1">Активировать</option>
				<?php endif; ?>
				<?php if ($rowUser['status'] == 0): ?>
				  	<option value="0" selected>Неактивированный пользователь</option>
				<?php else: ?>
				 	<option value="0">Деактивировать</option>
				<?php endif; ?>
			</select><br></td>
		</tr>

		<tr>
			<td></td>
			<td><input type="submit" name="editUser" value="Сохранить"></td>
		</tr>
	</table>
</form>

<?php if (isset($message)): ?>
	<b><?php echo $message; ?></b>
<?php endif; ?>
			