<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-title"><h2 class="text-center">Login</h2></div>
                    <?php
                        if(isset($_GET['message'])){
                            echo '<div class="alert alert-danger" role="alert">
                                '.$_GET['message'].'
                                </div>';
                        }
                    ?>
                    <div class="card-body">
                        <form action="./Ajax/Auth/login_ajax.php" method="post">
                            <div class="form-group my-3">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                            </div>
                            <div class="form-group my-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block login_submit">Login</button>
                            
                        </form>
                        <a class="pagename" name="register">
                            I don't have account.
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<form action="./index.php" method="POST" class='register-form'>
    <input type="hidden" name="page" value="register">
</form>
<script>
    $(document).ready(function(){
      $('a.pagename').click(function(){
        $('.register-form').submit();
      });
      $('.login_submit').click(function(e){
        e.preventDefault();
        $('p').remove();
        if($('#username').val() ==''){
            $('#username').after('<p class="text-danger">Username is a required field.</p>');
        }
        if($('#password').val() ==''){
            $('#password').after('<p class="text-danger">Password is a required field.</p>');
        }
        if($('#password').val() !='' && $('#username').val() !=''){
            $(this).parent('form').submit();
        }
      });
    });
  </script>