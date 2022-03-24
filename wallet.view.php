<?php
session_start();
if (!isset($_SESSION['type']) && $_SESSION['type']==1 ) {
    header('Location: login.php');
    exit;
}

require_once './class/wallet.php';
require_once './class/walletOperation.php';
require_once './class/user.php';

if(isset($_POST['added'])){
    $operation=new WalletOperation($_POST['user_id'],$_POST['wallet_id'],'add',$_POST['add_amount']);
}

if(isset($_GET['id'])){

    $id = (int)$_GET['id'];
    if(is_int($id)){
        
        $wallet=Wallet::getWallet($id);

        $user = User::getUser($wallet['id']);  
    }

}
require_once './include/Dashboardheader.php';
?>
<div class="border rounded">
<div class="row bg-white">
    <div class="col-md-6 row bg-light mx-auto my-3 p-3">
    <h5 class="text-capitalize">
            user name : <?=$user['name'] ?>
        </h5>
        <h5 class="">
            <span class="text-capitalize">
            user email : 
            </span>
        <?=$user['email'] ?>

        </h5>
        <p class="text-capitalize">
        wallet : 
        <?php
        if($wallet['balance'] < 0){?>
            <strong>he is indebted <small>  <?= abs($wallet['balance'])?>$ </small> </strong>
        <?php }else{ ?>
            <strong> <?= $wallet['balance']?>$  </strong>

    <?php } ?>
            
        </p>
        <form action="" method="post" class="cart-items">
        <input data-id="" id="test" type="text" value = "" class="form-control w-25 d-inline" name='add_amount'>
        <input type="hidden" id="test" type="text" value = "<?=$user['id'] ?>" class="form-control w-25 d-inline" name='user_id'>
        <input type="hidden" id="test" type="text" value = "<?= $wallet['id']?>" class="form-control w-25 d-inline" name='wallet_id'>
        <button type="submit"  style="height: fit-content;" class="btn btn-primary mx-2" name="added">add in wallet</button>
        </form>
        <a style="height: fit-content;" class="btn btn-primary my-5 w-25 mx-auto" href="/cart/dashbord.php">dashbord </a>
    </div>
</div>
</div>


