# PHP-MySQL-Docker setup

## How to use?

- Clone the repo `git@github.com:aslamdoctor/docker-php-mysql.git`
- Update `.env` file for project credentials
- Run `docker compose up -d`
- Add `index.php` file in your `src` directory (if not exists) and add below source code for testing purpose.

```php
<?php
// a helper function to lookup "env_FILE", "env", then fallback
if ( ! function_exists( 'getenv_docker' ) ) {
	function getenv_docker( $env, $default ) {
		if ( $fileEnv = getenv( $env . '_FILE' ) ) {
				return rtrim( file_get_contents( $fileEnv ), "\r\n" );
		} elseif ( ( $val = getenv( $env ) ) !== false ) {
				return $val;
		} else {
				return $default;
		}
	}
}

echo getenv_docker( 'MYSQL_ROOT_PASSWORD', 'test' );

// Test DB Connection
$con = new mysqli( 'mysql_db', 'root', 'root' );

if ( $con ) {
	echo 'Connected to db';
}

// Check PHP Info
phpinfo();
```

- Run `http://localhost:9000/` for frontend and check if environment variable values are coming properly and also check the phpinfo is correct.
- Run `http://localhost:9001/` for phpMyAdmin
- Note: While connecting DB, make sure to use mysql hostname will always be same as container name which is `mysql_db`

## Some important commands

- To backup database from Docker container

  `docker exec CONTAINER_ID mysqldump -u database -pdatabase database --no-tablespaces > ./database.sql`

- To restored database to Docker container

  `docker exec CONTAINER_ID mysql -u database -pdatabase -e "CREATE DATABASE IF NOT EXISTS database"`

  `cat database.sql | docker exec -i CONTAINER_ID /usr/bin/mysql -u database --password=database database`

- To log into Docker container shell

  `docker exec -ti CONTAINER_ID sh`

## Apply proper file/folder permissions to modify the project files

1. Create docker group if not exists. First check if `docker` group exists by typing command `groups`

   `sudo usermod -aG docker $USER`

2. Add write permission to the project volume/folder (if required)

   `sudo chmod 775 -R src/`

## Notes

For best performance on Windows, run your source directory from WSL2 (Win Pro license might be required).
