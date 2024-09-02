<?php
require_once('./Ajax/userlist_ajax.php');
?>
<section id="hero" class="hero section dark-background">
    <div class="container">
        <?php
            $data = $result['data'];
            
            for ($i=0; $i < count($data); $i++) {
                
                // echo $role_name;
                if($_POST['userid'] == $data[$i]['id']){
                    $role = '<option value="">----</option>';
                    for ($j = 0; $j < count($roles); $j++) { 
                        if ($roles[$j]['code'] == $data[$i]['role_id']) {
                            $role .= '<option value="' . $roles[$j]['code'] . '" selected>' . $roles[$j]['name'] . '</option>';
                        } else {
                            $role .= '<option value="' . $roles[$j]['code'] . '">' . $roles[$j]['name'] . '</option>';
                        }
                    }

                    echo '<h3 class="text-center text-white">'.$data[$i]['username'].' Detail</h3>';
                    echo '
                    <form action="./Ajax/userupdate_ajax.php" method="post" >
                        <input type="hidden" name="userid" value="'.$data[$i]['id'].'">
                        <div class="form-group my-2">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="'.$data[$i]['username'].'">
                        </div>
                        <div class="form-group my-2">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required value="'.$data[$i]['email'].'">
                        </div>
                        <div class="form-group my-2">
                            <label for="role">User Role</label>
                            <select class="form-control" id="role" name="role">
                                '.$role.'
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <button type="submit" class="form-control btn btn-primary btn-block updateuser_submit">Update</button>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <a href="./index.php" class="form-control btn btn-danger btn-block">
                                Cancel</a>
                            </div>
                        </div>
                    </form>';
                }
            }
        ?>
        
    </div>
</section>
<script>
    $(document).ready(function(){
      $('.updateuser_submit').click(function(e){
        e.preventDefault();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        $('p.text-danger').remove();
        if($('#username').val() ==''){
            $('#username').after('<p class="text-danger">Username is a required field.</p>');
        }
        if($('#email').val() ==''){
            $('#email').after('<p class="text-danger">Email is a required field.</p>');
        }else if(!emailRegex.test($('#email').val())){
            $('#email').after('<p class="text-danger">Email is invalid format.</p>');
        }
        if($('#role').val() ==''){
            $('#role').after('<p class="text-danger">Role is a required field.</p>');
        }
        if($('#username').val() !='' && $('#email').val() !='' && $('#role').val() !='' && emailRegex.test($('#email').val())){
            console.log('hello world')
            $(this).parent('div').parent('div').parent('form').submit();
        }
      });
    });
  </script>