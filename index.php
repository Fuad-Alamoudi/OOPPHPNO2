<?php

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}else if ($_SESSION['type']==1) {
    header('Location: dashbord.php');
    exit;
}

require_once ('./db/connected.php');

// session_unset();

// create instance of Createdb class
$db = new connectedDb();

if (isset($_POST['add'])){
    $count=0;
    /// print_r($_POST['product_id']);
    if(isset($_SESSION['cart'])){


        if(in_array($_POST['product_id'], array_keys($_SESSION["cart"]))){
            $_SESSION['cart'][$_POST['product_id']]+=1;
            $_SESSION['cart']['count']+=1;
        }else{
            $_SESSION['cart'][$_POST['product_id']]=1;
            $_SESSION['cart']['count']++;
        }

    }else{

        $item_array = array($_POST['product_id']=>1);

        // Create new session variable
        $_SESSION['cart']=$item_array;
        $_SESSION['cart']['count']=1;
    }
}


?>


<?php require_once ('./include/head.php'); ?>

<?php require_once ('./include/header.php'); ?>

<div class="container">
        <div class="row text-center py-5">
            <?php
                $result = $db->getAll("Producttb");

                if(isset($result))

                while ($row = mysqli_fetch_assoc($result)){?>

                    <div class="col-md-3 col-sm-6 my-3 my-md-0">
                    <form action="index.php" method="post">
                        <div class="card shadow">
                            <div>
                            <img src="./upload/<?=$row['product_image']?>" alt="Image1" class="img-fluid">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?=$row['product_name']?></h5>
                                <h6>
                                    <?php
                                    for($i=0;$i < 4;$i++){
                                        if($i < $row['commeit']){?>
                                            <i class="fas fa-star"></i>
                                        <?php
                                        }else {?>
                                            <i class="far fa-star"></i>
                                        <?php }
                                        ?>

                                    <?php
                                    }
                                    ?>
                                </h6>
                                <p class="card-text">
                                <?=$row['description']?>
                                </p>
                                <h5>
                                    <span class="price">$<?=$row['product_price']?></span>
                                </h5>
                                <button type="submit" class="btn btn-warning my-3" name="add">Add to Cart <i class="fas fa-shopping-cart"></i></button>
                                 <input type='hidden' name='product_id' value='<?=$row['id']?>'>
                            </div>
                        </div>
                    </form>
                </div>
                <?php                
                }
            ?>
        </div>
</div>





<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
