<?php 
class ResData
{
    private $hostname="localhost";
    private $username= "root";
    private $password= "";
    private $database= "klassy_db";

    private $server= "";
    public function __construct()
    {
        $this->server= new mysqli($this->hostname,$this->username,$this->password,$this->database);
    }
    public function Add_data($table,$array)
    {
        $keys=array_keys($array);
        $values=array_values($array);

        $key=implode("`,`",$keys);
        $value=implode("','",$values);

        $sql="INSERT INTO `{$table}` (`$key`) VALUES ('$value')";
        $result=$this->server->query($sql);
    }

    public function Display_data($table)
    {
        $sql="SELECT * FROM `{$table}`";
        $query=$this->server->query($sql);
        $assoc_array=$query->fetch_all(MYSQLI_ASSOC);
        return $assoc_array;
    }
    public function delete_data($table,$id)
    {
        $sql= "DELETE FROM `{$table}` WHERE `id`=$id";
        $this->server->query($sql);
    }
    public function showsingle_data($table,$id)
    {
        $query= "SELECT * FROM `{$table}` WHERE id=$id";
        $result=$this->server->query($query);
        $assoc=$result->fetch_assoc();
        return $assoc;
    }

    public function update_data($table,$array,$id)
    {
        $pair = [];
        foreach( $array as $key=>$val )
        {
            $pair[]  = "`$key`='$val'";
        }
        $pairs = implode(",",$pair);
        $sql = "UPDATE `{$table}` SET $pairs WHERE `id` = $id";
        $result = $this->server->query($sql);
        if($result)
        {
            return "User Updated successfuly";
        }
    }
}

$object=new ResData();

?>