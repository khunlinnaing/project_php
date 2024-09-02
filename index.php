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
// require_once('./views/layouts/header.php');
    $pages = ['home', 'products', 'login', 'register', 'userlist'];
    $page = isset($_GET['page']) && in_array($_GET['page'], $pages) ? $_GET['page'] : '' ;
    
    if ($page === 'login' || $page === 'register') {
        $page_route = './views/' . $page . '.php';
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