<?php
require 'IDB.php';
class Mysql implements IDB
{
    private $db;
    public function connect(string $host = "",string $username = "",string $password = "",string $database = ""): ?static
    {
        $this->db=@mysqli_connect("$host","$username","$password","$database");
        if($this->db ===false){
            die("DB ERROR");
        }else
        {
            return $this;
        }
    }
    function select(string $query):array
    {
        $result=mysqli_query($this->db,$query);
        if($result instanceof mysqli_result && $result->num_rows>0){
            return mysqli_fetch_all($result,MYSQLI_ASSOC);;
        }
        return [];

    }
    function insert(string $table, array $data):bool
    {
        $names= implode("','",array_keys($data));
        $values =implode("','",$data);
        $sql ="INSERT INTO $table ($names) VALUES($values);";
        return mysqli_query($this->db,$sql);
    }
    function update(string $table, int $id, array $data):bool
    {
        $names= array_keys($data);
        $values =$data;
        $sql ="UPDATE SET $names[0] =$values[0] WHERE id=$id;";
        for($i=1;$i<count($names);$i++)
        {
        $sql .="UPDATE SET $names[0] =$values[0] WHERE id=$id;";
        }
        return mysqli_query($this->db,$sql);
    }
    function delete(string $table, int $id):bool{
        $sql="DELETE FROM $table WHERE id =$id;";
        return mysqli_query($this->db,$sql);;
    }
}