<?php
session_start();
require_once './class/wallet.php';
require_once './class/walletOperation.php';
require_once ('./include/head.php');

if (isset($_POST['buy'])) {
    $Wallet = Wallet::getUserWalletId($_POST['user_id']);
    $Wallet_balance = (float) $Wallet['balance'];
    $Wallet_id = (int) $Wallet['id'];
    $New_Wallet_balance =  $Wallet_balance - $_POST['add_amount'];

    $operation = new WalletOperation($_POST['user_id'], $Wallet_id, 'buy', $_POST['add_amount'], 0);

    unset($_SESSION['cart']);

    if ($New_Wallet_balance > 0) {?>
        <p class="text-center my-5 p-5"> the transaction was completed sucessfully you have  <?= $New_Wallet_balance?> </p>
<?php
    }else {
?>
        <p class="text-center my-5 p-5"> the transaction was completed sucessfully you are indebted  <?=' '. abs($New_Wallet_balance)?> </p>
    <?php } ?>
    <a style="height: fit-content;" class="btn btn-primary my-5 w-25 mx-auto d-block" href="index.php">
        main page </a>
<?php } ?>