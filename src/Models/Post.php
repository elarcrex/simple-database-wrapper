<?php 
namespace Elarc\Models;

use Elarc\Libs\Database;
use Elarc\Libs\BaseModel;
class Post extends BaseModel {

	protected static $table = "posts";
	public function __construct(Database $db)
	{
		$this->db = $db;
	}
}

