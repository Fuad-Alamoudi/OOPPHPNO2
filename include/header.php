<header id="header">
    <nav class="navbar navbar-expand-lg ">
        <a href="index.php" class="navbar-brand">
            <h3 class="px-5">
                <i class="fas fa-shopping-basket"></i> Cart
            </h3>
        </a>
        <button class="navbar-toggler"
            type="button"
                data-toggle="collapse"
                data-target = "#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup"
                aria-expanded="false"
                aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="mr-auto"></div>
            <div class="navbar-nav">
                <a href="cart.php" class="nav-item nav-link active">
                    <h5 class="px-5 cart">
                        <i class="fas fa-shopping-cart"></i> Cart
                        <?php
                        if (isset($_SESSION['cart']['count'])){
                            $count = $_SESSION['cart']['count'];
                            echo "<span id=\"cart_count\" class=\"text-warning bg-light\">$count</span>";
                        }else{
                            echo "<span id=\"cart_count\" class=\"text-warning bg-light\">0</span>";
                        }

                        ?>
                    </h5>
                </a>
            </div>
            <div class="navbar-nav">
                <a href="logout.php" class="nav-item nav-link active">
                    <h5 class="px-5 cart">
                     logout
                    </h5>
                </a>
            </div>
            <div class="navbar-nav">
                <a href="/cart/userWallet.php" class="nav-item nav-link active">
                    <h5 class="px-5 cart">
                        <i class="fas fa-wallet"></i>
                    </h5>
                </a>
            </div>
        </div>

    </nav>
</header>






