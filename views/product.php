<?php
if(!empty($_SESSION['access_token'])){
    if($_SESSION['role'] == 2){
    require_once('./Ajax/product_ajax.php');
    require_once('./Ajax/category_ajax.php');
    $data = $result['data'];
?>
<section id="hero" class="hero section dark-background">
    <div class="container">
        <form action='' method='POST'>
            <input type="hidden" name="page" value='productnew'>
            <button type='submit' class='btn btn-success border-rounded'>Add Product</button>
        </form>
        <h3 class="text-center text-white">Category Lists</h3>
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <th>No</th>
                <th>Category Name</th>
                <th>Products Name</th>
                <th>Products Image</th>
                <th>Products Amount</th>
                <th>Products Price</th>
                <th>Action</th>
            </thead>
            <tbody>
            <?php 
                    $list=$productlist['data'];
                    $category_name='';
                    $count=0;
                    for ($i=0; $i < count($list); $i++) { 
                        if($productlist['currentPage'] > 1){
                            $count = ($productlist['currentPage']*10)+($i+1);
                        }else{
                            $count = $i+1;
                        }
                        if(isset($data)){
                            for($j=0; $j < count($data); $j++){
                                if($list[$i]['category_id'] == $data[$j]['id']){
                                    $category_name=$data[$j]['name'];
                                }
                            }
                        }
                        echo "
                            <tr>
                                <td>" . $count. "</td>
                                <td>" . ($category_name) . "</td>
                                <td>" . ($list[$i]['name']) . "</td>
                                <td> <img src='" . ($list[$i]['image']) . "' style='width: 60px; height: 60px;'></td>
                                <td> " . ($list[$i]['price']) . "</td>
                                <td> " . ($list[$i]['amount']) . "</td>
                                <td>
                                    <div class='row'>
                                    <div class='col-lg-6 col-md-6'>
                                        <form method='POST' action=''>
                                            <input type='hidden' name='page' value='productdetail'>
                                            <input type='hidden' name='productid' value='".$list[$i]['id']."'>
                                            <button class='btn btn-success form-control'><i class='fa-solid fa-pen-to-square'></i>Edit</button>
                                        </form>
                                        </div>
                                        <div class='col-lg-6 col-md-6'>
                                            <form method='POST' action=''>
                                                <input type='hidden' name='page' value='productdelete'>
                                                <input type='hidden' name='productid' value='".$list[$i]['id']."'>
                                                <button class='btn btn-danger form-control deleteproduct'><i class='fa-solid fa-trash'></i>Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li class="page-item <?php echo $productlist['currentPage'] <= 1 ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $productlist['currentPage']-1 ?>" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <?php
                    for ($k = 1; $k <= $productlist['totalPages']; $k++) {
                        if($productlist['currentPage'] == $k){
                            echo "<li class='page-item active'><a class='page-link' href='?page=$k'>$k</a> </li>";
                        }
                        else if($k > 1 || $k <= ($k+1)){
                            echo "<li class='page-item'>.</li>";
                        }else if($k == $productlist['totalPages']){
                            echo "<li class='page-item'><a class='page-link' href='?page=$k'>$k</a> </li>";
                        }
                    }
                    ?>
                <li class="page-item <?php echo $productlist['currentPage'] == $productlist['totalPages'] ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $productlist['currentPage']+1 ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</section>
<?php }else{
    header("Location: ./index.php");
}}else{
    header("Location: ./index.php?page=login");
} ?>
<script>
$(document).ready(function(){
    $('.deleteproduct').click(function(){
        confirm('Are you sure to delete!')
    })
});
</script>