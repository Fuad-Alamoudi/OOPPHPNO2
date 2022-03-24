<?php

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
require_once ("./db/connected.php");

$db = new connectedDb();

if (isset($_POST['remove'])){
  if ($_GET['action'] == 'remove'){
      foreach ($_SESSION['cart'] as $key => $value){
          if( $key == $_GET['id']){
            $_SESSION['cart']['count']-=$_SESSION['cart'][$key];
              unset($_SESSION['cart'][$key]);
          }
      }
  }
}
if(isset($_GET['actionmin'])){
    if($_SESSION['cart'][$_GET['id']]>1){
        $_SESSION['cart'][$_GET['id']]--;
        $_SESSION['cart']['count']-=1;

    }
 
}
if(isset($_GET['actionadd'])){
        $_SESSION['cart'][$_GET['id']]++; 
        $_SESSION['cart']['count']+=1;
  
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="./public/css/style.css">
</head>
<body class="bg-light">

<?php
    require_once ('./include/header.php');
?>

<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart">
                <h6>My Cart</h6>
                <hr>
                <?php
                  if(isset($_GET['q']) && isset($_GET['id'])){
                    $_SESSION['cart'][$_GET['id']]=$_GET['q'];
                }
                $total = 0;
                    if (isset($_SESSION['cart'])){
                        $product_id = array_keys($_SESSION['cart']);

                        $result = $db->getAll("Producttb");
                        while ($row = mysqli_fetch_assoc($result)){
                            foreach ($product_id as $id){
                                if ($row['id'] == $id){?>
                                    <!-- echo " -->
                                    <div class="border rounded">
                                        <div class="row bg-white">
                                            <div class="col-md-3 pl-0">
                                                <img src="./upload/<?=$row['product_image']?>" alt="Image1" class="img-fluid">
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="pt-2"><?=$row['product_name']?></h5>
                                                <h5 class="pt-2"> $ <?=$row['product_price']?> </h5>
                                                <form action="cart.php?action=remove&id=<?=$row['id']?>" method="post" class="cart-items">
                                                <button type="submit"  style="height: fit-content;" class="btn btn-danger mx-2" name="remove">Remove</button>
                                                </form>
                                            </div>
                                            <div class="col-md-3 py-5">
                                                <div class="row">
                                                <form action="cart.php?actionmin=add&id=<?=$row['id']?>" method="post" class="cart-items">
                                                <button  type="submit"  class="btn bg-light border rounded-circle"><i class="fas fa-minus"></i></button>
                                                </form>
                                                    <input data-id="$<?=$row['id']?>" id="test" type="text" value = "<?=$_SESSION["cart"][$id]?>" class="form-control w-25 d-inline">
                                                
                                                    <form action="cart.php?actionadd=mines&id=<?=$row['id']?>" method="post" class="cart-items">
                                                    <button type="submit" class="btn bg-light border rounded-circle"><i class="fas fa-plus"></i></button>
                                                    </form>
                                                
                
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $total = $total + (int)$row['product_price'] * ($_SESSION['cart'][$id]);
                                }
                            }
                        }
                    }else{?>
                        <h5>Cart is Empty</h5>;
                        <?php
                    }
                ?>

            </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">

            <div class="pt-4">
                <h6>PRICE DETAILS</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
                            if (isset($_SESSION['cart'])){
                                $count  = count($_SESSION['cart']);
                                echo "<h6>Price ($count items)</h6>";
                            }else{
                                echo "<h6>Price (0 items)</h6>";
                            }
                        ?>
                        <h6>Delivery Charges</h6>
                        <hr>
                        <h6>Amount Payable</h6>
                    </div>
                    <div class="col-md-6">
                        <h6>$<?php echo $total; ?></h6>
                        <h6 class="text-success">FREE</h6>
                        <hr>
                        <h6>$<?php
                            echo $total;
                            ?></h6>
                        <form action="buy.php" method="post">
                        <input value="<?= $total?>" name="add_amount" type="hidden">
                        <input value="<?= $_SESSION['user_id']?>" name='user_id' type="hidden">
                        <button type="submit" class="btn btn-warning my-3" name="buy"> buy <i class="fas fa-shopping-cart"></i></button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>


            var e = document.getElementById('test');
            e.addEventListener('click',()=>{})
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
