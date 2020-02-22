<?php
class UserController extends Controller {
	/**
	 * @var object
	 */
	public $model;

	/**
	 * @param Application
	 * @throws Exception
	 * @return void
	 */
	public function __construct($application) 
	{
		parent::__construct($application);
		try {
			if ((int)$_SESSION['roleId'] !== 1) {
				throw new Exception("You do not have access");
			} 
			$this->model = new User();
		} catch (Exception $e) {
			$this->render('error', [
				'error' => $e->getMessage() 
			]);	
		}
	}

	/**
	 * Show users
	 *
	 * @throws Exception
	 * @return void
	 */
	public function showUsersAction() 
	{ 
		$dbConnection = $this->container->get('dbConnection');
		try {
			$this->model->checkPageNumber();
			$arr = $this->model->showUsers($dbConnection);
			$users = $arr['users'];
			$total = $arr['total'];
			$page = $arr['page'];
		} catch (Exception $e) {
			$this->render('error', [
				'error' => $e->getMessage() 
			]);		
		}
		
		$this->render('user:showUsers', [
			'users' => $users, 
			'total' => $total, 
			'page' => $page
		]);
	}


	/**
	 * Show user
	 *
	 * @return void
	 */
	public function showUserAction() 
	{ 
		$dbConnection = $this->container->get('dbConnection');
		try {
			$this->model->checkExistenceIdAndUser($dbConnection);
			$user = $this->model->showUser($dbConnection)['user'];
		} catch(Exception $e) {
			$this->render('error', [
				'error' => $e->getMessage() 
			]);		
		}
		
		$this->render('user:showUser', [
			'user' => $user
		]);
	}


	/**
	 * Edit status of user
	 *
	 * @return void
	 */
	public function editStatusOfUserAction() 
	{ 
		$dbConnection = $this->container->get('dbConnection');
		try {
			$userId = $this->model->checkExistenceIdAndUser($dbConnection);
			$this->model->editStatusOfUser($dbConnection);
		} catch (Exception $e) {
			$this->render('error', [
				'error' => $e->getMessage() 
			]);
		}
		header("Location: /show-user/" . $userId);
	}


	/**
	 * Edit user
	 *
	 * @return void
	 */
	public function editUserAction() 
	{
		$dbConnection = $this->container->get('dbConnection');
		try {
			$this->model->checkExistenceIdAndUser($dbConnection);
			$arr = $this->model->editUser($dbConnection);
			$user = $arr['user'];
			$message = $arr['message'];
		} catch (Exception $e) {
			$this->render('error', [
				'error' => $e->getMessage() 
			]);
		}
		
		$this->render('user:editUser', [
			'rowUser' => $user, 
			'message' => $message, 
		]);
	}


	/**
	 * Delete user
	 *
	 * @return void
	 */
	public function deleteUserAction() 
	{ 
		$dbConnection = $this->container->get('dbConnection');
		try {
			$userId = $this->model->checkExistenceIdAndUser($dbConnection);
			$this->model->deleteUser($dbConnection);
		} catch (Exception $e) {
			$this->render('error', [
				'error' => $e->getMessage() 
			]);
		}
		header("Location: /show-user/" . $userId);
	}

}


		