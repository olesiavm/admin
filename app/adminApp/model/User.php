<?php
class User {

	/**
	 * Show users
	 *
	 * @param Connection
	 * @return array
	 */
	public function showUsers($dbConnection) 
	{
		//Pagination
		$countInPage = 3; 
		$page = intval($this->getPageId());
		$queryUser = $dbConnection->query("SELECT id FROM users");
		$countAll = $queryUser->rowCount();
		$total = ceil($countAll / $countInPage); 
		$start = $page * $countInPage - $countInPage;  
		//Get Users
		$sql = "SELECT * FROM users LIMIT :start, :countInPage";
		$prep = $dbConnection->prepare($sql); 
		$prep->bindValue(':start', $start, PDO::PARAM_INT);
		$prep->bindValue(':countInPage', $countInPage, PDO::PARAM_INT);
		$prep->execute();
		$users = $prep->fetchAll();

		return [
			'users' => $users, 
			'total' => $total,
			'page' => $page
		];
	}


	/**
	 * Show user
	 *
	 * @param Connection
	 * @return array 
	 */
	public function showUser($dbConnection) 
	{
		$userId = $this->getId(); 	
		$user = $this->getUser($dbConnection, $userId);
		return ["user" => $user];
	}


	/**
	 * Edit status of user
	 *
	 * @param Connection
	 * @return void 
	 */
	public function editStatusOfUser($dbConnection) 
	{
		$userId = $this->getId(); 
		$user = $this->getUser($dbConnection, $userId);
		$status = $user['status'];
		if ($status == 0) {
			$status = 1;
		} else {
			$status = 0;
		}

		$sql = "UPDATE users SET status = :status WHERE id = :userId";
		$prep = $dbConnection->prepare($sql);
		$prep->bindValue(':userId', $userId, PDO::PARAM_INT);
		$prep->bindValue(':status', $status, PDO::PARAM_INT);
		$result = $prep->execute(); 
	}


	/**
	 * Edit user
	 *
	 * @param Connection
	 * @return array
	 */
	public function editUser($dbConnection) 
	{
		$userId = $this->getId(); 
		$user = $this->getUser($dbConnection, $userId);

		if (isset($_POST['editUser'])) {
			if ($_POST['birthDate'] > date("Y-m-d H:i:s")) {
				$message = "Не верно указана дата";
				return ['user' => $user, 'message' => $message];
			}

			$loginError = HelperCheckForm::checkField($_POST['login']);
			$nameError = HelperCheckForm::checkField($_POST['name']);
			$surnameError = HelperCheckForm::checkField($_POST['surname']);

			if ($loginError !== null || $nameError !== null || $surnameError !== null) { 
				$message = "Не верно введены данные";
				return ['user' => $user, 'message' => $message];
			}

			$sql = "UPDATE users SET login=:login, name=:name, surname=:surname, gender=:gender, birth_date=:birth_date, role_id=:role_id, status=:status WHERE id = :userId";
			$prep = $dbConnection->prepare($sql);
			$prep->bindValue(':userId', $userId, PDO::PARAM_INT);
			$prep->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
			$prep->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
			$prep->bindValue(':surname', $_POST['surname'], PDO::PARAM_STR);
			$prep->bindValue(':gender', $_POST['gender'], PDO::PARAM_STR);
			$prep->bindValue(':birth_date', $_POST['birthDate'], PDO::PARAM_STR);
			$prep->bindValue(':role_id', $_POST['roleId'], PDO::PARAM_INT);
			$prep->bindValue(':status', $_POST['status'], PDO::PARAM_INT);
			$result = $prep->execute();
			$_SESSION['role_id'] = $_POST['roleId'];
			$user = $this->getUser($dbConnection, $userId);
			$message = "Пользователь изменен";
			return ['user' => $user, 'message' => $message];
		}
		return ['user' => $user, 'message' => ''];
	}


	/**
	 *  Delete user
	 *
	 * @param Connection
	 * @return void
	 */
	public function deleteUser($dbConnection) 
	{
		$userId = $this->getId();
		$sql = 'DELETE FROM users WHERE id = :userId';
		$prep = $dbConnection->prepare($sql);
		$prep->bindValue(':userId', $userId, PDO::PARAM_INT);
		$result = $prep->execute(); 
	}


	/**
	 *  Check existence of id from url and existence of user with this id in database
	 *
	 * @param Connection
	 * @throws Exception
	 * @return void
	 */
	public function checkExistenceIdAndUser($dbConnection) 
	{
		$userId = $this->getId(); 
		$user = $this->getUser($dbConnection, $userId);
		if ($userId == null || $user == null) {
			throw new Exception("User does not exist");
		}
		return $userId;
	}

	/**
	 *  Check existence of page numer from url 
	 *
	 * @param Connection
	 * @throws Exception
	 * @return void
	 */
	public function checkPageNumber() 
	{
		$pageNum = $this->getPageId();
		if ($pageNum == null) {
			throw new Exception("Page number does not exist");
			
		}
	}

	/**
	 *  Get number of page
	 *
	 * @return mixed 
	 */		
	public function getPageId() 
	{
		if (isset($_GET['page']) && !empty($_GET['page'])) {
			$id = intval($_GET['page']);
			if (gettype($id) !== "integer") {
				 $id = 1;
			} 
		} else {
			$id = 1;
		}	
		return $id;
	}

	/**
	 *  Get id of user
	 *
	 * @throws Exception
	 * @return mixed 
	 */	
	public function getId() 
	{
		$routes = explode('/', $_SERVER['REQUEST_URI']);	
		if (empty($routes[2])) {
			throw new Exception("User not exist");
		}
		$id = intval($routes[2]);
		if (gettype($id) !== "integer") {
			throw new Exception("User not exist");
		} 
		return $id;
	}

	/**
	 *  Get user
	 *
	 * @param Connection
	 * @param ineger $userId
	 * @return array  
	 */
	public function getUser($dbConnection, $userId) 
	{
		$sql = "SELECT * FROM users WHERE id = :userId ORDER BY id ASC";
		$prep = $dbConnection->prepare($sql);
		$prep->bindValue(':userId', $userId, PDO::PARAM_INT);
		$prep->execute(); 
		$user = $prep->fetch(PDO::FETCH_ASSOC);
		return $user;
	}
}




