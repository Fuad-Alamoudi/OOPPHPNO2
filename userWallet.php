<?php 
session_start();
require_once ('./include/head.php');
require_once('./class/wallet.php');
$wallet=Wallet::getWallet($_SESSION['user_id']);
?>
<div class="card container m-5 p-3">
  <div class="card-header">
    wallat
  </div>
  <div class="card-body">
    <h5 class="card-title">your wallet</h5>
    <p class="card-text">
        <?php
        if($wallet['balance'] > 0){?>
            <p class=""> you have  <?= $wallet['balance']?> </p>
        <?php }else{?>
            <p class="">  you are indebted  <?=' '. abs($wallet['balance'])?> </p>
            <?php
        }
        ?>
        </p>
    <a href="/cart/index.php" class="btn btn-primary">Go main page</a>
  </div>
</div>