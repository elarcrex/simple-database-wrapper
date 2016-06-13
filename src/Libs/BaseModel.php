<?php 
namespace Elarc\Libs;

use \PDO;
class BaseModel {
	protected static $table;

	protected $db;
	
	public function count()
	{
		$stmt = $this->db->query("select count(*) as count from ". static::$table);
		$record = $stmt->fetch(PDO::FETCH_OBJ);
		return $record->count;
	}

	public function find($id=0)
	{
		$stmt = $this->db->prepare("select * from " . static::$table . " where id=:id");
		$stmt->execute([':id' => $id]);
		return $stmt->fetch(PDO::FETCH_OBJ);
	}

	public function findWith($query) 
	{
		$stmt = $this->db->query($query);
		$results = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $results;
	}

	public function all($limit = null, $offset = null, $sort = "ASC")
	{
		$query  = "select * from ".static::$table;
		$query .= " order by id {$sort}";
		$query .= (! is_null($limit)) ? " limit {$limit} " : "";
		$query .= (! is_null($offset)) ? " offset {$offset} " : "";
		$stmt = $this->db->query($query);
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function save()
	{
		return isset($this->id) ? $this->update() : $this->insert();
	}

	protected function insert() {
		$fields = $this->getVars();
		$keys   = join(",", array_keys($fields));
		$values = join(",:", array_keys($fields));
		$query  = "insert into ". static::$table . "($keys) values (:$values)";	
		$stmt   = $this->db->prepare($query);
		$params = $this->bind($fields);
		
		return ($stmt->execute($params)) ? $this->db->lastInsertId() : null;	    
	}

	protected function update()
	{
		$fields = $this->getVars();
		$keys = array_keys($fields);
		$values = array_values($fields);
		$update = [];
		foreach($fields as $key => $value)
		{
			$update[] = $key ."=:".$key; 
		}
		$query = "update " .static::$table . " set " . join(",", $update) . " where id = ". $this->id;
		$stmt = $this->db->prepare($query);
		$params = $this->bind($fields);

		return ($stmt->execute($params)) ? $stmt->rowCount() : null;
	}

	public function delete()
	{
		$stmt = $this->db->query("delete from " .static::$table. " where id=".$this->id." limit 1");
		return ($stmt->rowCount()) ? true : false;
	}

	private function bind($fields)
	{
		$params = [];
		foreach($fields as $key => $value){
			$params[":$key"]=$value;
		}
		return $params;
	}

	private function getVars()
	{
		return array_intersect_key(get_object_vars($this), $this->getDBFields());
	}

	private function getDBFields() 
	{
		$DBfields = [];
		$stmt = $this->db->query("describe " . static::$table);
		$fields = $stmt->fetchAll(PDO::FETCH_OBJ);
		foreach ($fields as $field)
		{
			$DBfields[$field->Field] = $field->Field;
		}
		return $DBfields;
	}
}
