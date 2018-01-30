<div class="sticky-wrapper home-nav-bg">
  <div class="container">
    <div class="row">
            <span class="col-md-auto d-none d-sm-none d-md-none d-lg-block logo">
                <span class="logo">
                  <a href="index.php"><img src="assets/images//bg/tesla-logo.png"></a>
                </span>
            </span>
<!--             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
            </button> -->
            <div class="col-md-8 ml-lg-auto">

              <nav class="navbar navbar-expand-lg nav-margin">
                
                <div class="navbar-brand d-lg-none">LOGO</div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse normal-link-texts" id="navbarColor03">
                  <ul class="nav navbar-nav ml-xl-auto">

                    <?php 
                      if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') : ?>
                         
                          <li class="nav-item">
                            <a class="nav-link-index nav-link" href="items.php?search_all=true">All Items</a>
                          </li>

                    <?php endif; ?>

                    <li class="nav-item">
                      <a class="nav-link-index nav-link" href="items.php?new=true&page=1">New Arrivals</a>
                    </li>                    
                    <li class="nav-item dropdown">
                          <a class="nav-link-index nav-link men-items" href="items.php?allmen=true&page=1" id="navbarDropdown">Men</a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="items.php?men=true&mtop=true&page=1">Top</a>
                              <a class="dropdown-item" href="items.php?men=true&mbag=true&page=1">Bag</a>
                              <a class="dropdown-item" href="items.php?men=true&mshoe=true&page=1">Shoes</a>
                          </div>
                    </li>
                    

                    <li class="nav-item dropdown">
                          <a class="nav-link-index nav-link" href="items.php?allwomen=true&page=1" id="navbarDropdown">Women</a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="items.php?women=true&wtop=true&page=1">Top</a>
                              <a class="dropdown-item" href="items.php?women=true&wbag=true&page=1">Bag</a>
                              <a class="dropdown-item" href="items.php?women=true&wshoe=true&page=1">Shoes</a>
                          </div>
                    </li>
                    <li class="nav-item dropdown">
                          <a class="nav-link-index nav-link" href="#" id="navbarDropdown">Brands</a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <?php 
                                require "connection.php";
                                $sql = "SELECT * FROM brands ORDER BY brand_name";
                                $result = mysqli_query($connection, $sql);
                                while ($row = mysqli_fetch_assoc($result)) : 
                                   extract($row); 
                              ?>
                                  <a class="dropdown-item" href="items.php?brand=true&<?php echo strtolower(str_replace(' ','_', $brand_name)); ?>=true">
                                    <?php echo $brand_name; ?>
                                  </a>
                              <?php  endwhile; ?>
                          </div>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link-index nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link-index nav-link" href="#">Story</a>
                    </li>
                    <!-- <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'regular'): ?>
                      <li class="nav-item">
                        <?php if(isset($_SESSION['cart'])): ?>
                          <a class="nav-link cart-icon" href="shopping_bag.php?user=<?php echo $_SESSION['username']; ?>"><img src="assets/icons/shopping-cart.png" alt="">( <?php echo array_sum($_SESSION['cart']); ?> )</a>
                        <?php else: ?>
                          <a class="nav-link cart-icon" href="shopping_bag.php"><img src="assets/icons/shopping-cart.png" alt=""></a>
                        <?php endif;  ?>
                      </li>
                    <?php endif ?> -->
                  </ul>
                </div> <!-- /navbar-collapse -->
              
              </nav>
            </div>

            <div class="col-auto d-none d-sm-none d-md-none d-lg-block pl-0 pl-md-1 pr-0">
                  <!-- <div class="header-button">
                    <a href="#" class="btn btn-sm btn-default">Contact Us <i class="fa fa-envelope-o pl-1"></i></a>
                  </div> -->
                  <form action="search_products.php" method="GET">
                    <div class="input-group header-search">
                      <input type="text" class="form-control" placeholder="Search.." name="search_item">
                      <div class="input-group-btn">
                        <button type="submit" class="btn no-bg-btn"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </form>
            </div>
    </div>
      
    </div>
</div> <!-- /.sticky-wrapper -->
<!-- </nav> -->
