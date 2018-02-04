<div class="sticky-wrapper bg-custom">
  <div class="container">
    <div class="row">
            <span class="col-md-auto d-none d-sm-none d-md-none d-lg-block logo">
                <span class="logo pt-4">
                  <a href="index.php"><span class="logo-home">MLJM</span></a>
                </span>
            </span>
            <div class="col-md-8 col-sm-12 ml-lg-auto">

              <nav class="navbar navbar-expand-lg nav-margin">
                
                <div class="navbar-brand d-lg-none">MLJM</div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse normal-link-texts" id="navbarColor03">
                  <ul class="nav navbar-nav ml-xl-auto">

                    <?php 
                      if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') : ?>
                         
                          <li class="nav-item">
                            <a class="nav-link black" href="items.php?page=1&search_all=true">All Items</a>
                          </li>

                    <?php endif; ?>

                    <li class="nav-item">
                      <a class="nav-link black" href="items.php?new=true&page=1">New Arrivals</a>
                    </li>                    
                    <li class="nav-item dropdown">
                          <a class="nav-link black men-items" href="items.php?page=1&allmen=true" id="navbarDropdown">Men</a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="items.php?page=1&mtop=true">Top</a>
                              <a class="dropdown-item" href="items.php?page=1&mbag=true">Bag</a>
                              <a class="dropdown-item" href="items.php?page=1&mshoe=true">Shoes</a>
                          </div>
                    </li>
                    

                    <li class="nav-item dropdown">
                          <a class="nav-link black" href="items.php?page=1&allwomen=true" id="navbarDropdown">Women</a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="items.php?page=1&wtop=true">Top</a>
                              <a class="dropdown-item" href="items.php?page=1&wbag=true">Bag</a>
                              <a class="dropdown-item" href="items.php?page=1&wshoe=true">Shoes</a>
                          </div>
                    </li>
                    <li class="nav-item dropdown">
                          <a class="nav-link black" href="#!" id="navbarDropdown">Brands</a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <?php 
                                require "connection.php";
                                $sql = "SELECT * FROM brands ORDER BY brand_name";
                                $result = mysqli_query($connection, $sql);
                                while ($row = mysqli_fetch_assoc($result)) : 
                                   extract($row); 
                              ?>
                                  <a class="dropdown-item" href="items.php?page=1&<?php echo strtolower(str_replace(' ','_', $brand_name)); ?>=true">
                                    <?php echo $brand_name; ?>
                                  </a>
                              <?php  endwhile; ?>
                          </div>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link black" href="#">Collections</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link black" href="about.php">About</a>
                    </li>
                  </ul>
                </div> <!-- /navbar-collapse -->
              
              </nav>
            </div>

            <div class="col-md-4 d-none d-sm-none d-md-block d-lg-block pl-0 pl-md-1 pr-0">
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
