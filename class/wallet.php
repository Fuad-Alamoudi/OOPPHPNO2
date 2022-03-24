<?php
require_once './config.php';
require_once APP_PATH ."/db/connected.php";
class Wallet{
    private static  $db;
    private $blance;
    private $user_id;
    public function __construct($user_id,$blance,$typ,$ID=null)
    {
        $db = new connectedDb();
       self::$db=$db->concted();
        $this->blance=$blance;
        $this->user_id=$user_id;
        if($ID == null){
            $query  = 'INSERT INTO wallets (user_id, balance) '
            . 'VALUES ("' . $user_id . '", '.$blance .')';
        }else{
            $wallte=$this->getWallet($ID);
            $amount=$wallte['balance'];
            if($typ == 1){
                $newblance=(float)$amount + (float)$blance;
            }else{
                $newblance=(float)$amount - (float)$blance;
            }
            $query  = 'update wallets set user_id="' . $user_id . '", balance='.$newblance .' where id='.$ID;
        }
        self::$db->query($query);
    }
    public static function getWallet($ID){
        $db = new connectedDb();
        self::$db=$db->concted();
        $q="select * from wallets where id=$ID";
        $walt=mysqli_fetch_assoc(self::$db->query($q));
        return $walt;
    }
    public static function getUserWalletId($ID){
        $db = new connectedDb();
        self::$db=$db->concted();
        $q="select id,balance from wallets where user_id=$ID";
        $walt=mysqli_fetch_assoc(self::$db->query($q));
        return $walt;
    }

}
