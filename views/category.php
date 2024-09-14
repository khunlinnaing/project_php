<?php
if(!empty($_SESSION['access_token'])){
    if($_SESSION['role'] == 2){
require_once('./Ajax/categorylist_ajax.php');
?>
<section id="hero" class="hero section dark-background">
    <div class='container'>
        <form action='' method='POST'>
            <input type="hidden" name="page" value='categorynew'>
            <button type='submit' class='btn btn-success border-rounded'>Add Category</button>
        </form>
        <h3 class="text-center text-white">Category Lists</h3>
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <th>No</th>
                <th>Category Name</th>
                <th>Category Image</th>
                <th>Category Amount</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php 
                    $data = $categorylist['data'];
                    $role_name='';
                    $count=0;
                    for ($i=0; $i < count($data); $i++) { 
                        if($categorylist['currentPage'] > 1){
                            $count = ($categorylist['currentPage']*10)+($i+1);
                        }else{
                            $count = $i+1;
                        }
                        echo "
                            <tr>
                                <td>" . $count. "</td>
                                <td>" . ($data[$i]['name']) . "</td>
                                <td> <img src='" . ($data[$i]['image']) . "' style='width: 60px; height: 60px;'></td>
                                <td> " . ($data[$i]['amount']) . "</td>
                                <td>
                                    <div class='row'>
                                    <div class='col-lg-6 col-md-6'>
                                        <form method='POST' action=''>
                                            <input type='hidden' name='page' value='categorydetail'>
                                            <input type='hidden' name='categoryid' value='".$data[$i]['id']."'>
                                            <button class='btn btn-success form-control'><i class='fa-solid fa-pen-to-square'></i>Edit</button>
                                        </form>
                                        </div>
                                        <div class='col-lg-6 col-md-6'>
                                            <form method='POST' action=''>
                                                <input type='hidden' name='page' value='categorydelete'>
                                                <input type='hidden' name='categoryid' value='".$data[$i]['id']."'>
                                                <button class='btn btn-danger form-control deletecategory'><i class='fa-solid fa-trash'></i>Delete</button>
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
                <li class="page-item <?php echo $categorylist['currentPage'] <= 1 ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $categorylist['currentPage']-1 ?>" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <?php
                    for ($k = 1; $k <= $categorylist['totalPages']; $k++) {
                        if($categorylist['currentPage'] == $k){
                            echo "<li class='page-item active'><a class='page-link' href='?page=$k'>$k</a> </li>";
                        }
                        else if($k > 1 || $k <= ($k+1)){
                            echo "<li class='page-item'>.</li>";
                        }else if($k == $categorylist['totalPages']){
                            echo "<li class='page-item'><a class='page-link' href='?page=$k'>$k</a> </li>";
                        }
                    }
                    ?>
                <li class="page-item <?php echo $categorylist['currentPage'] == $categorylist['totalPages'] ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $categorylist['currentPage']+1 ?>">Next</a>
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
    $('.deletecategory').click(function(){
        confirm('Are you sure to delete!')
    })
});
</script>