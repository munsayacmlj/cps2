<!-- <nav class="navbar navbar-expand-lg navbar-light bg-dark bg-custom"> -->
<div class="sticky-wrapper bg-dark bg-custom">
  
  <div class="container">
    <div class="row">
            <!-- <div class="col-md-auto d-none d-sm-none d-md-none d-lg-block">
                <div class="logo">
                  <a href="index.php"><img src="assets/images/gitgud.jpg"></a>
                </div>
            </div> -->
           <!--  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
            </button> -->
            <div class="col-lg-8 ml-lg-auto">

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
                            <a class="nav-link" href="index.php?search_all=true">All Items</a>
                          </li>

                    <?php endif; ?>

                    <li class="nav-item">
                      <a class="nav-link" href="index.php?new=true">New Arrivals</a>
                    </li>                    
                    <li class="nav-item dropdown">
                          <a class="nav-link" href="index.php?men=true" id="navbarDropdown">Men</a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="index.php?men=true&top=true">Top</a>
                              <a class="dropdown-item" href="index.php?men=true&bag=true">Bag</a>
                              <a class="dropdown-item" href="index.php?men=true&shoe=true">Shoes</a>
                          </div>
                    </li>
                    

                    <li class="nav-item dropdown">
                          <a class="nav-link" href="index.php?women=true" id="navbarDropdown">Women</a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="index.php?women=true&top=true">Top</a>
                              <a class="dropdown-item" href="index.php?women=true&bag=true">Bag</a>
                              <a class="dropdown-item" href="index.php?women=true&shoe=true">Shoes</a>
                          </div>
                    </li>
                    <li class="nav-item dropdown">
                          <a class="nav-link" href="#" id="navbarDropdown">Brands</a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <?php 
                                require "connection.php";
                                $sql = "SELECT * FROM brands";
                                $result = mysqli_query($connection, $sql);
                                while ($row = mysqli_fetch_assoc($result)) : 
                                   extract($row); 
                              ?>
                                  <a class="dropdown-item" href="index.php?brand=true&<?php echo strtolower(str_replace(' ','_', $brand_name)); ?>=true">
                                    <?php echo $brand_name; ?>
                                  </a>
                              <?php  endwhile; ?>
                               
                             <!--  <a class="dropdown-item" href="index.php?allen_edmonds=true&brand=true">Allen Edmonds</a>
                              <a class="dropdown-item" href="index.php?balenciaga=true&brand=true">Balenciaga</a>
                              <a class="dropdown-item" href="index.php?barba_napoli=true&brand=true">Barba Napoli</a>
                              <a class="dropdown-item" href="index.php?berluti=true&brand=true">Berluti</a>
                              <a class="dropdown-item" href="index.php?brioni=true&brand=true">Brioni</a>
                              <a class="dropdown-item" href="index.php?christian_louboutin=true&brand=true">Christian Louboutin</a>
                              <a class="dropdown-item" href="index.php?gucci=true&brand=true">Gucci</a>
                              <a class="dropdown-item" href="index.php?jimmy_choo=true&brand=true">Jimmy Choo</a>
                              <a class="dropdown-item" href="index.php?kate_spade=true&brand=true">Kate Spade</a>
                              <a class="dropdown-item" href="index.php?manolo_blahnik=true&brand=true">Manolo Blhanik</a>
                              <a class="dropdown-item" href="index.php?ralph_lauren=true&brand=true">Ralph Lauren</a>
                              <a class="dropdown-item" href="index.php?saint_laurent=true&brand=true">Saint Laurent</a>
                              <a class="dropdown-item" href="index.php?salvatore_ferragamo=true&brand=true">Salvatore Ferragamo</a>
                              <a class="dropdown-item" href="index.php?stuart_weitzman=true&brand=true">Stuart Weitzman</a>
                              <a class="dropdown-item" href="index.php?versace=true&brand=true">Versace</a> -->
                          </div>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Story</a>
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
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </form>
            </div>
    </div>
      
    </div>
</div> <!-- /.sticky-wrapper -->
<!-- </nav> -->
