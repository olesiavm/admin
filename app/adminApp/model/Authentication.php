<?php
class Authentication {

	/**
	 * Authentication of user
	 * 
	 * @param Connection
	 * @throws Exception
	 * @return void
	 */
	public function auth($dbConnection) 
	{
		try {
			if (empty($_POST['password']) || empty($_POST['login'])) {
				throw new Exception('Запоните все поля!');
			}
			
			$resultLogin = HelperCheckForm::checkField($_POST['login']);
			$resultPassw = HelperCheckForm::checkField($_POST['password']);
			
			if (isset($resultLogin)) {
				throw new Exception($resultLogin);
			}
			if (isset($resultPassw)) {
				throw new Exception($resultPassw);
			}

			$sql = "SELECT * FROM users WHERE login = :login"; 
			$prep = $dbConnection->prepare($sql);
			$prep->bindParam(':login', $_POST['login'], PDO::PARAM_STR);
			$prep->execute();
			$rowUser = $prep->fetch(PDO::FETCH_ASSOC);	

			if (!isset($rowUser['login'])) {
				throw new Exception('Пользователь с таким логином не зарегистрирован!');
			}

			if (password_verify($_POST['password'], $rowUser['password']) == false || password_verify($_POST['password'], $rowUser['password']) == 0) {
				throw new Exception('Не верно введен логин или пароль!');
			}

			// Write to the session information about authentication
			$_SESSION['auth'] = true; 
			$_SESSION['userId'] = $rowUser['id']; 
			$_SESSION['login'] = $rowUser['login']; 
			$_SESSION['roleId'] = $rowUser['role_id'];

			if (isset($_POST['remember'])) {
				$this->setUserCookie($dbConnection, $rowUser);
			}
			$login = $rowUser['login']; 
			$result = array(
				'status' => true,
				'msg' => "Hello, $login"
			); 
		}
		catch (Exception $ex) {
			$result = array(
				'status' => false,
				'error' => $ex->getMessage()
			); 
		}
		echo json_encode($result);	
	}

	
	/**
	 * Save cookies in browser and in db if checkbox 'Remember' is clicked
	 * 
	 * @param Connection
	 * @param array $rowUser
	 * @return void
	 */ 
	public function setUserCookie($dbConnection, $rowUser) 
	{							
		$hash = $this->generateString(12);
		setcookie('login', $rowUser['login'], time()+60*60*24*30, $path ='/'); 
		setcookie('hash', $hash, time()+60*60*24*30, $path ='/'); 

		$sql = 'UPDATE users SET hash=:hash WHERE id=:id';
		$prep = $dbConnection->prepare($sql);
		$prep->bindValue(':hash', $hash, PDO::PARAM_STR);
		$prep->bindValue(':id', $rowUser['id'], PDO::PARAM_STR);
		$prep->execute(); 
	}

	/**
	 * @param integer $countOfChar
	 * @return string
	 */ 
	public function generateString($countOfChar) 
	{
		$string = '';
		for ($i = 0; $i < $countOfChar; $i++) { 
			$string .= substr('abdefhiknrstyzABDEFGHKNQRSTYZ23456789', rand(1, 37) - 1, 1); 
		}
		return $string;
	}


	/**
	 * Authentication of user with cookies from browser (if cookies exist)
	 * @param Connection
	 * @return void
	 */ 
	public function authWithCookie($dbConnection) 
	{
		if (isset($_SESSION['auth'])) {
			return false;
		} 
		if (!empty($_COOKIE['hash']) && !empty($_COOKIE['login'])) {
			$login = $_COOKIE['login']; 
			$hash = $_COOKIE['hash'];

			$sql = 'SELECT * FROM users WHERE login=:login AND hash=:hash';
			$prep = $dbConnection->prepare($sql);
			$prep->bindParam(':login', $login, PDO::PARAM_STR);
			$prep->bindParam(':hash', $hash, PDO::PARAM_STR);
			$prep->execute();
			$rowUser = $prep->fetch(PDO::FETCH_ASSOC); 

			if (!empty($rowUser)) {
				$_SESSION['auth'] = true; 
				$_SESSION['login'] = $rowUser['login']; 
				$_SESSION['userId'] = (int)$rowUser['id']; 
				$_SESSION['roleId'] = (int)$rowUser['role_id'];
			}  
		}
	}
	

	/**
	 * Exit from user profile 
	 * @param Connection
	 * @return void
	 */ 
	public function logout($dbConnection) 
	{
		if (isset($_SESSION['auth'])) {
			// destroy of the session
			session_destroy();
		    //Delete the cookies
			setcookie('login', '', time()-60*60*24*30, $path ='/'); 
			setcookie('hash', '', time()-60*60*24*30, $path ='/'); 
			//Delete cookie from Db
			$sql = 'UPDATE users SET hash=:hash WHERE id=:id';
			$prep = $dbConnection->prepare($sql);
			$prep->bindValue(':hash', NULL, PDO::PARAM_STR);
			$prep->bindValue(':id', $_SESSION['userId'], PDO::PARAM_STR);
			$prep->execute(); 
			header("Location: /"); 
		}
	}
		
}


