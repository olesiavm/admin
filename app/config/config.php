<?php

$config = [
	'db' => [
		'dsn' => 'mysql:host=localhost;dbname=cabinet',
		'username' => 'root',
		'password' => ''
	],
	'router' => [
		'/' => [
			'controller' => 'IndexController',
			'action' => 'indexAction'
		],

		'/authentication' => [
			'controller' => 'AuthenticationController',
			'action' => 'loginAction'
		],
		'/logout' => [
			'controller' => 'AuthenticationController',
			'action' => 'logoutAction'
		],
		'/show-users' => [
			'controller' => 'UserController',
			'action' => 'showUsersAction'
		],
		'/show-user' => [
			'controller' => 'UserController',
			'action' => 'showUserAction'
		],
		'/edit-user' => [
			'controller' => 'UserController',
			'action' => 'editUserAction'
		],
		'/edit-user-status' => [
			'controller' => 'UserController',
			'action' => 'editStatusOfUserAction'
		],
		'/delete-user' => [
			'controller' => 'UserController',
			'action' => 'deleteUserAction'
		]
	],
	'path_to_views' => '/app/adminApp/view/'
];

return $config;