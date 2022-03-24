<?php

session_start();
if (!isset($_SESSION['type']) && $_SESSION['type'] == 1) {
    header('Location: login.php');
    exit;
}

require_once './include/Dashboardheader.php';
require_once './db/connected.php';
$db = new connectedDb();

?>

<div class="container bootstrap snippets bootdey">
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box no-header clearfix">
                <div class="main-box-body clearfix">
                    <div class="table-responsive">
                        <table style="margin-top: 10px;" class="table user-list">
                            <thead>
                                <tr>
                                    <th><span>Name</span></th>
                                    <th class="text-center"><span>email</span></th>
                                    <th><span>accunt</span></th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$result = $db->getAll("users");


if (isset($result)) {
    while ($row = mysqli_fetch_assoc($result)) {?>
                                        <tr>
                                            <td>
                                                <span class="user-subhead"><?=$row['name']?></span>
                                            </td>
                                            <td><?=$row['email']?></td>
                                            <td class="text-center">
                                                <div class="text-center">
                                                    <form method='get' action="wallet.view.php/?id=<?=$row['id']?>">
                                                    <input type="hidden" name="id" value="<?=$row['id']?>">
                                                        <button type="submit" class="btn btn-primary">wallet</button>
                                                    </form>
                                                </div>
                                            </td>

                                            <td style="width: 20%;">
                                                <a href="edit.php/?id=<?=$row['id']?>" class="btn btn-warning">Edit</a>
                                                <a href="/Product/app/productProcess.php?send=del&id=<?=$row['id']?>" class="btn btn-danger">Delet</a>
                                            </td>
                                        </tr>

                                <?php }
}
?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>