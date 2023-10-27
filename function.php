
<?php
class Connection{
    public $host = 'localhost';
    public $user = 'root';
    public $password = '';
    public $db_name = 'oop';
    public $conn;

    public function __construct(){
        $this -> conn = mysqli_connect($this ->host, $this ->user, $this ->password,$this->db_name);
    }
}

class Register extends Connection{
    public function registration($name, $email, $passwordHash){

        //querying data
        $duplicate = mysqli_query($this -> conn,'SELECT* FROM users WHERE username = '$username' OR email= '$email');

}
?>