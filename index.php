<link href="./static/css/bootstrap.min.css" rel="stylesheet">
<link href='./static/fontawesome/css/all.min.css' rel='stylesheet'>
<link href="./static/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="./static/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="./static/vendor/aos/aos.css" rel="stylesheet">
<link href="./static/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
<link href="./static/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
<link href="./static/css/main.css" rel="stylesheet">
<script src="./static/js/bootstrap.min.js"></script>
<script src="./static/js/jquery.min.js"></script>
<?php
    $pages = ['home', 'products', 'login', 'register', 'userlist'];
    $page = isset($_GET['page']) && in_array($_GET['page'], $pages) ? $_GET['page'] : '' ;
    if ($page === 'login' || $page === 'register') {
        $page_route = './views/' . $page . '.php';
        require_once($page_route);
        require_once('./views/layouts/footer.php');
    }else if($page !== 'login' && $page !== 'register' && $page !=''){
        $page_route = './views/' . $page . '.php';
        require_once('./views/layouts/header.php');
        require_once($page_route);
        require_once('./views/layouts/footer.php');
    }else{
        require_once('./route.php');
    }
?>
<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<!-- <div id="preloader"></div> -->
<!-- Vendor JS Files -->
<script src="./static/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="./static/vendor/php-email-form/validate.js"></script>
<script src="./static/vendor/aos/aos.js"></script>
<script src="./static/vendor/glightbox/js/glightbox.min.js"></script>
<script src="./static/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="./static/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Main JS File -->
<script src="./static/js/main.js"></script>
<script>
  $(document).ready(function(){
    getcart()
    $('button.productbuy').click(function(){
      var productid = $(this).siblings('input.productid').val();
      var productprice = $(this).siblings('input.productprice').val();
      var userid = <?php echo $_SESSION['userid']; ?>;
      var data={"userid": userid, "productid": productid, "price": productprice};
      $.ajax({
          method: 'POST',
          url: './Ajax/buyproduct_ajax.php', 
          data: JSON.stringify(data),
          contentType: 'application/json',
          success: function(response) {
            // $('i.fa-cart-shopping').siblings('sup').remove();
            var data = JSON.parse(response);
              if(data.status=='success'){
                getcart()
              }else{

              }
          },
          error: function(xhr, status, error) {
              console.error("Error:", error);
          }
      });
    });
    function getcart(){
      $('i.fa-cart-shopping').siblings('sup').remove();
      var userid = <?php echo $_SESSION['userid']; ?>;
      var data={"userid": userid};
      $.ajax({
            method: 'POST',
            url: './Ajax/buyproductlist_ajax.php', 
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function(response) {
              var data = JSON.parse(response);
              console.log(data);
                if(data.status == 'success'){
                  if((data.data)[0].totalproduct > 0){
                    $('i.fa-cart-shopping').after(`<sup style="font-size: 10px;border: 10px solid red;border-radius: 45%;">${(data.data)[0].totalproduct}</sup>`)
                  }
                }else{
                  $('i.fa-cart-shopping').siblings('sup').remove();
                }
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    }
  });
</script>