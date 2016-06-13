<?php 
namespace Elarc\Libs;
use \PDO;
class Database extends PDO {

	public function __construct() 
	{
		$data_source_name = 'mysql:host=localhost;dbname=dbabstract';
		$options = [
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		];

		try 
		{
			parent::__construct($data_source_name, 'root', 'root', $options);
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
}
