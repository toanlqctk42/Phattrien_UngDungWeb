<?php
class Employee{
    private $Conn;
    public $Id;
    public $Name;
    public $Surname;
    public $Email;
    public $Phone;
    public $depart_ID;

    public function __construct($connection)
    {
        $this-> Conn = $connection;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM employees";
        $cmd = $this->Conn->prepare($sql);
        $cmd->execute();
        $result = $cmd->fetchAll();
        $this->Conn = null;
        return $result;
    }

    public function getbyId($id)
    {
        $sql = "SELECT * FROM employees WHERE id = :id";
        $cmd = $this->Conn->prepare($sql);
        $cmd->execute(array("id"=>$id));
        $result = $cmd->fetchObject();
        $this->Conn= null;
        return $result;
    }

    public function InsertEMP($name, $surname, $email, $phone ,$depart_ID)
    {
        $sql = "CALL `proc_themnhanvienmoi`(:Name,:Surname,:Email,:Phone,:Depart_ID)";
        $cmd = $this->Conn->prepare($sql);
        $result = $cmd->execute(array("Name"=>$name, "Surname"=>$surname,"Email"=>$email,"Phone"=>$phone,"Depart_ID"=>$depart_ID));
        $this->Conn= null;
    }

    public function UpdateEMP($id,$name, $surname, $email, $phone ,$depart_ID)
    {
        $sql = "CALL `proc_suanhanvien`(:id,:Name,:Surname,:Email,:Phone,:Depart_ID)";
        $cmd = $this->Conn->prepare($sql);
        $result = $cmd->execute(array('id'=>$id,'Name'=>$name, 'Surname'=>$surname,'Email'=>$email,'Phone'=>$phone,'Depart_ID'=>$depart_ID));
        $this->Conn= null;
    }

    public function DeleteEMP($id)
    {
        $sql = "CALL `proc_xoanhanvien`(:id)";
        $cmd = $this->Conn->prepare($sql);
        $result = $cmd->execute(array("id"=>$id));
        $this->Conn= null;
    }

}

?>