<?php
$pages = ['home', 'login', 'register','logout2','userlist', 'userdetail','userdelete','category','categorynew', 'categorydetail', 'categorydelete', 'categoryuser','product','productnew', 'productdelete','productdetail','usercategory', 'cart'];

$page = isset($_POST['page']) && in_array($_POST['page'], $pages) ? $_POST['page'] : 'home' ;

$page_route = './views/' . $page . '.php';
if ($page === 'login' || $page === 'register') {
    require_once($page_route);
    require_once('./views/layouts/footer.php');
}else if($page == 'logout2'){
    session_start();
    $_SESSION['access_token']='';
    header("Location: ./index.php");
}else {
    require_once('./views/layouts/header.php');
    require_once(file_exists($page_route) ? $page_route : './views/home.php');
    require_once('./views/layouts/footer.php');
}
?>
