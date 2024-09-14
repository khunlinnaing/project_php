<?php
require_once('./Ajax/categorylist_ajax.php');
require_once('./Ajax/productlist_ajax.php');
$product_value=$products['data'];
?>
<section id="hero" class="hero section dark-background">
    <div class="container">
        <?php
            $data = $categorylist['data'];

            for ($i=0; $i < count($data); $i++) {
                if($_POST['categoryid'] == $data[$i]['id']){
                    echo '<h3 class="text-center text-white">'.$data[$i]['name'].' Detail</h3>';
                    echo '<div class="text-center"><img src="'.$data[$i]['image'].'" class="w-50" id="categoryimage"></div>';
                    echo '<h4>Amount:'.$data[$i]['amount'].'</h4>';
                    echo '<h4 class="text-center">Descriptions</h4>';
                    echo '<p>'.$data[$i]['description'].'</p>';
                }
            }
            echo '<h3 class="text-center my-3">Products</h3>';
            echo '<div class="row">';
            for($j=0; $j < count($product_value); $j++){
                if($_POST['categoryid'] == $product_value[$j]['category_id']){
                    echo '
                            <div class="col-lg-3 col-md-3 mr-1 mt-3">
                                <div class="card bg-light">
                                    <div class="card-title"><h3 class="text-center text-black">'.$product_value[$j]['name'].'</h3></div>
                                    <div class="card-body">
                                    <img src="'.$product_value[$j]['image'].'" class="w-100">
                                    <h6 class="text-black">Amount:'.$product_value[$j]['amount'].'</h6>
                                    <h6 class="text-black">Price:'.$product_value[$j]['price'].'</h6>
                                    </div>
                                    <div class="card-footer">
                                    '.($_SESSION['access_token'] !='' ? '<button class="btn btn-primary w-100">Buy</button>' : '<a href="./index.php?page=login" class="btn btn-primary w-100">Buy</a>').'
                                    </div>
                                </div>
                                </div>
                            ';
                }
            }
            echo '</div>'
        ?>
        
    </div>
</section>