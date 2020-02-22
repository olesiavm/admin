<div class="btn-group">
	<a class="btn rounded theme-button" href="/">Главная</a>
	<?php if (!isset($_SESSION['auth'])): ?>
		<a class="btn rounded theme-button" href="/authentication">Войти</a>
	<?php else: ?>
		<a class="btn rounded theme-button" href="/logout">Выход</a>
	<?php endif; ?>
	<?php if (isset($_SESSION['auth']) && ($_SESSION['roleId'] == 1)): ?>
		<a class="btn rounded theme-button" href="/show-users">Кабинет администратора</a>
	<?php endif; ?>
</div>
	