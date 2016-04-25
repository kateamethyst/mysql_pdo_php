<?php
class EloquentClass
{
	function __construct($table)
	{
		try {
            $this->DBConn = new PDO("mysql:host=localhost; dbname=testdb;", 'sample', 'root');
            $this->DBConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            $e->getMessage();
        }

        $this->table = $table;
	}

	public function select($fields)
	{
		$query = 'SELECT ' . $fields . ' FROM ' . $this->table ;
		return $query;
	}

	public function where($fields)
	{
		$query = ' WHERE ' . $fields ;
		return $query;
	}
	
	public function andWhere($field)
	{
		$query = ' AND ' . $field ;
		return $query;
	}
	
	public function orWhere($field)
	{
		$query = ' OR ' . $field ;
		return $query;
	}

	public function executeQuery($query)
	{
		$stmt = $this->DBConn->prepare($query); 
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
}