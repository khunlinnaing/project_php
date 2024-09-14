<?php
session_start();
?>
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <h1 class="sitename">OnlineSale</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a class='pagename' name=''>
              <form action='' method='POST'>
                  <input type='hidden' name='page' value=''>
              </form>Home</a></li>
          <li><a class='pagename' name=''>
              <form action='./index.php#about' method='POST'>
                  <input type='hidden' name='page' value=''>
              </form>About</a></li>
          <li><a href="#features">Features</a></li>
          <li><a href="#gallery">Activity</a></li>
          <li><a href="#team">Team</a></li>
          <?php if(!empty($_SESSION['access_token'])) {
            if($_SESSION['role'] == 2){?>
          <li>
            <a class='pagename' name='userlist'>
              <form action='' method='POST'>
                  <input type='hidden' name='page' value='userlist'>
              </form>
              Users
            </a>
          </li>
          <li>
            <a class='pagename' name='category'>
              <form action='' method='POST'>
                  <input type='hidden' name='page' value='category'>
              </form>
              Category
            </a>
          </li>
          
          <li>
            <a class='pagename' name='product'>
              <form action='' method='POST'>
                  <input type='hidden' name='page' value='product'>
              </form>
              Products
            </a>
          </li>
          <li>
              <a href="Admin/index.php">Admin Dashboard</a>
            </li>
          <?php }else{ ?>
            <li><a href="./index.php#usercategory">Category</a></li>
            <li><a href="./index.php#userproduct">Product</a></li>
          <?php }} ?>
          <li><a href="#contact">Contact</a></li>
          <?php if(empty($_SESSION['access_token'])) {?>
          <li><a class='pagename' name='login'>
            <form action='' method='POST'>
                <input type='hidden' name='page' value='login'>
            </form>
            Login</a>
          </li>
          <li><a class='pagename' name='register'>
          <form action='' method='POST'>
                <input type='hidden' name='page' value='register'>
            </form>Register</a></li>
            <?php }else{?>
              
              <li>
                <a class='pagename' name='cart'>
                  <form action='' method='POST'>
                      <input type='hidden' name='page' value='cart'>
                  </form>
                  <i class="fa-solid fa-cart-shopping" style="font-size: 20px;"></i>
                </a>
              </li>
              <li><a><?php echo isset($_SESSION['loginuseraccount']) ? '<i class="fa-solid fa-address-book"></i>'.$_SESSION['loginuseraccount'] : ''; ?></a></li>
              <li>
                <a class='pagename' name='logout2'>
                  <form action='' method='POST'>
                      <input type='hidden' name='page' value='logout2'>
                  </form>
                  Logout
                </a>
              </li>
            <?php } ?>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>
  
  <script>
    $(document).ready(function(){
      $('a.pagename').click(function(){
        $(this).children('form').submit();
      });
    });
  </script>