<?php
class TableClass
{
    protected $DBConn;
    private   $table;
    
    function __construct($table)
    {
        try {
            $this->DBConn = new PDO("mysql:host=host; dbname=databasename;", 'username', 'password');
            $this->DBConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            $e->getMessage();
        }

        $this->table = $table;
    }

    public function all() 
    {
        $query  = $this->DBConn->prepare("SELECT * FROM " . $this->table);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function find($id)
    {
        $query  = $this->DBConn->prepare("SELECT * FROM " . $this->table . " WHERE id=:id");
        $query->execute(array('id'=> $id));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function create($array)
    {
        $fields = implode(',' , array_keys($array));
        $values = implode("' ,'" , array_values($array));
        $values = rtrim($values, ",'");

        $query  = $this->DBConn->prepare('INSERT INTO ' . $this->table . '(' . $fields .  ") VALUES('" .  $values . "')" );
        $result = $query->execute();
        return $result;
    }

    public function update($id, $array)
    {
        $toBeUpdate = "";
        foreach ($array as $key => $value) {
            $toBeUpdate = $toBeUpdate . $key . "='" . $value . "',";
        }
        $toBeUpdate = rtrim($toBeUpdate, ',');
        $query  = $this->DBConn->prepare('UPDATE ' . $this->table . ' SET ' . $toBeUpdate . ' WHERE id=:id');
        $result = $query->execute(array('id' => $id));
        return $result;
    }

    public function delete($id)
    {
        $query  = $this->DBConn->prepare('DELETE FROM ' . $this->table . ' WHERE id=:id');
        $result = $query->execute(array('id' => $id));
        return $result;
    }
}