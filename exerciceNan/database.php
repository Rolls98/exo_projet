<?php

	

	class database
	{
		private static $host = "localhost";
		private static $password = "";
		private static $username = "root";
		private static $database = "final";
		private static $connexion = NULL;
		


		public static function connexion()
		{
			self::$connexion = new PDO("mysql:host=".self::$host.";dbname=".self::$database,self::$username,self::$password); 
	
			return self::$connexion;
		}
	
		public static function deconnexion()
		{
			self::$connexion = NULL;
		}
	}

	

?>