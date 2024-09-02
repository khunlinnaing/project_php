<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-title"><h2 class="text-center">Create an Account</h2></div>
                    <?php
                        if(isset($_GET['message'])){
                            echo '<div class="alert alert-danger" role="alert">
                                '.$_GET['message'].'
                                </div>';
                        }
                    ?>
                    <div class="card-body">
                        <form action="./Ajax/Auth/register_ajax.php" method="post" >
                            <div class="form-group my-2">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group my-2">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group my-2">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group my-2">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block register_submit">Register</button>
                        </form>
                        <div class="mt-3">
                            <p>Already have an account? <a class='pagename'>Login here</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="./index.php" method="POST" class='login-form'>
    <input type="hidden" name="page" value="login">
</form>
<script>
    $(document).ready(function(){
      $('a.pagename').click(function(){
        $('.login-form').submit();
      });
      $('.register_submit').click(function(e){
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
        if($('#password').val() ==''){
            $('#password').after('<p class="text-danger">Password is a required field.</p>');
        }
        if($('#confirm_password').val() ==''){
            $('#confirm_password').after('<p class="text-danger">Confirm is a required field.</p>');
        }
        if($('#confirm_password').val() != $('#password').val()){
            $('#confirm_password').after('<p class="text-danger">Confirm is a required field.</p>');
        }
        if($('#username').val() !='' && $('#email').val() !='' && $('#password').val() !='' && $('#confirm_password').val() !='' && $('#confirm_password').val() == $('#password').val() && emailRegex.test($('#email').val())){
            $(this).parent('form').submit();
        }
      });
    });
  </script>