<?php
require_once './db/connected.php';
require_once 'wallet.php';
class User
{
    private static $db;
    private $email;
    private $name;
    private $password;
    private $wallet;

    public function __construct()
    {
        $db = new connectedDb();
        self::$db = $db->concted();

    }

    public function create($name, $email, $pass)
    {

        // Create new user
        $this->name = $name;
        $this->email = $email;
        $this->password = $pass;
        $query = 'INSERT INTO users (name, email ,password) '
            . 'VALUES ("' . $name . '", "' . $email . '","' . $pass . '")';

        self::$db->query($query);
        $id = mysqli_insert_id(self::$db);
        $this->wallet = new Wallet($id,0,'');
    }
    public function getAll()
    {
        $q = "select * users";
        $users = self::$db->query($q);
    }
    public function update($id, $name, $email, $pass)
    {
        // Update existing user
        if (self::getUser($id)) {
            $sql = 'UPDATE users SET name="' . $name . '",email="' . $email . '" password="' . $pass . '" WHERE id=' . $id;
            $update = self::$db->query($sql);
            return $update;
        } else {
            return false;
        }
    }
    public static function  getUser($id)
    {
        $db = new connectedDb();
        self::$db = $db->concted();
        $intId = (int) $id;
        if (is_int($intId) && !empty($intId)) {
            $q = "select * from users where id= $intId ";
            if ($user = self::$db->query($q)) {
                $user = mysqli_fetch_assoc($user);
                return $user;
            } else {
                return false;
            }
        }
    }
    public function delete($id)
    {
        if (self::getUser($id)) {
            $q = "delete from users where id=$id";
            $del = self::$db->query($q);
            return $del;
        } else {
            return false;
        }
    }
    public static function checkUser($email, $pass)
    {
        $db = new connectedDb();
        self::$db = $db->concted();
        $q = "SELECT * FROM users
									WHERE
                                        email = '$email'
									AND
										Password ='$pass' ";
        if ($user = self::$db->query($q)) {
            $user = mysqli_fetch_assoc($user);
            return $user;
        } else {
            return false;
        }

    }
    public function checkUserAndType($email, $pass){
        $this->checkUser($email, $pass);
    }
}
