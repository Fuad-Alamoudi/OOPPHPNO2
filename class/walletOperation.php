<?php
require_once './db/connected.php';
require_once 'wallet.php';
$db = new connectedDb();
class WalletOperation{
    private $amount;
    private $user_id;
    private $wallet_id;
    private $name;
    private static $db ;

    public function __construct($user_id,$wallet_id,$name,$amount,$typ=1)
    {
        $db = new connectedDb();
        self::$db=$db->concted();
        $this->wallet_id=$wallet_id;
        $this->user_id=$user_id;
        $this->name=$name;
        $query  = 'INSERT INTO wallet_opration (name , wallet_id , user_id ,amount) '
						. 'VALUES ("' . $name . '", "' . $wallet_id . '","' . $user_id . '","' . $amount . '")';
            self::$db->query($query);
            $wallet=new Wallet($user_id, $amount,$typ,$wallet_id);
    }
}