<?php
if(!empty($_SESSION['access_token'])){
    if($_SESSION['role'] == 2){
        require_once('./Ajax/userlist_ajax.php');
?>

<section id="hero" class="hero section dark-background">
    
    <div class="container">
    <h1 class="text-center text-white">User Lists</h1>
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <th>No</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>User Role</th>
                <th>Action</th>
            </thead>
            <tbody>
            <?php 
                    $data = $result['data'];
                    $role_name='';
                    $count=0;
                    for ($i=0; $i < count($data); $i++) { 
                        for ($j=0; $j < count($roles); $j++) { 
                            if($roles[$j]['code'] == ($data[$i]['role_id'])){
                                $role_name = $roles[$j]['name'];
                            }
                        }
                        if($result['currentPage'] > 1){
                            $count = ($result['currentPage']*10)+($i+1);
                        }else{
                            $count = $i+1;
                        }
                        echo "
                            <tr>
                                <td>" . $count. "</td>
                                <td>" . ($data[$i]['username']) . "</td>
                                <td>" . ($data[$i]['email']) . "</td>
                                <td> " . $role_name . "</td>
                                <td>
                                    <div class='row'>
                                    <div class='col-lg-6 col-md-6'>
                                        <form method='POST' action=''>
                                            <input type='hidden' name='page' value='userdetail'>
                                            <input type='hidden' name='userid' value='".$data[$i]['id']."'>
                                            <button class='btn btn-success form-control'><i class='fa-solid fa-pen-to-square'></i>Edit</button>
                                        </form>
                                        </div>
                                        <div class='col-lg-6 col-md-6'>
                                            <form method='POST' action=''>
                                                <input type='hidden' name='page' value='userdelete'>
                                                <input type='hidden' name='userid' value='".$data[$i]['id']."'>
                                                <button class='btn btn-danger form-control deleteuser'><i class='fa-solid fa-trash'></i>Delete</button>
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
                <li class="page-item <?php echo $result['currentPage'] <= 1 ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $result['currentPage']-1 ?>" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <?php
                    for ($k = 1; $k <= $result['totalPages']; $k++) {
                        if($result['currentPage'] == $k){
                            echo "<li class='page-item active'><a class='page-link' href='?page=$k'>$k</a> </li>";
                        }
                        else if($k > 1 || $k <= ($k+1)){
                            echo "<li class='page-item'>.</li>";
                        }else if($k == $result['totalPages']){
                            echo "<li class='page-item'><a class='page-link' href='?page=$k'>$k</a> </li>";
                        }
                    }
                    ?>
                <li class="page-item <?php echo $result['currentPage'] == $result['totalPages'] ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $result['currentPage']+1 ?>">Next</a>
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
        $('.deleteuser').click(function(){
            confirm('Are you sure to delete!')
        })
    });
    </script>