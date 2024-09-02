<?php
session_start();
?>
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <h1 class="sitename">Bootslander</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#features">Features</a></li>
          <li><a href="#gallery">Gallery</a></li>
          <li><a href="#team">Team</a></li>
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
          <li><a class='pagename' name='price'>
                  <form action='' method='POST'>
                      <input type='hidden' name='page' value='price'>
                  </form>Pricing</a></li>
          <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li>
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