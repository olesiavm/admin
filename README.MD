System requirements:
linux
php 7.2
mysql Server 5.7.25-0ubuntu0.18.04.2
apache 2.4.29(ubuntu)

1. Put the test task in local server
2. Put the virtual host configuration file "admin.conf" (from /admin/app/migration/admin.conf) to directory "/etc/apache2/sites-available"
3. Add "127.0.0.1  admin" in host file (in"/etc/hosts")
4. Activate host and restart apache
5. Go http://localhost/phpmyadmin/ in browser
6. Create new user of database with login and password (from /admin/app/config/config.php). Example: 
create user 'olia'@localhost identified by '123456';
7. Add rights to user
grant all on *.* to 'olia'@localhost;
8. Create database "cabinet" and add dump of database (from /admin/migration/cabinet.sql)
9. Go to http://admin/ in browser 

User login - "user1" (with rights of admin)
Password -  "123456"

Class UserController
	Show users
	Show user
	Edit status of user
	Edit user
	Delete user

Class AuthenticationController
	Authentication from form
	Authentication with cookies
	Exit from user profile


