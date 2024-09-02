<section id="hero" class="hero section dark-background">
    <div class='container'>
    <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-title"><h2 class="text-center text-primary">New Category</h2></div>
                    <div class="card-body">
                        <form action="./Ajax/categorynew_ajax.php" method="post" enctype="multipart/form-data">
                            <div class="form-group my-2">
                                <label for="categoryname">Category Name</label>
                                <input type="text" class="form-control" id="categoryname" name="categoryname" required>
                            </div>
                            <div class="form-group my-2">
                                <label for="image">Category Image</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                            <div class="form-group my-2">
                                <label for="amount">Category Amount</label>
                                <input type="text" class="form-control" id="amount" name="amount" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block category_submit">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<script>
    $(document).ready(function(){
      $('a.pagename').click(function(){
        $('.login-form').submit();
      });
      $('.category_submit').click(function(e){
        e.preventDefault();
        const numberRegex =  /^\d+$/;
        var checkimage= false;
        $('p.text-danger').remove();
        if($('#categoryname').val() ==''){
            $('#categoryname').after('<p class="text-danger">Category name is a required field.</p>');
        }
        if($('#amount').val() ==''){
            $('#amount').after('<p class="text-danger">Amount is a required field.</p>');
        }else if(!numberRegex.test($('#amount').val())){
            $('#amount').after('<p class="text-danger">Enter amount 0 to 9.</p>');
        }
        if($('#image').val() ==''){
            $('#image').after('<p class="text-danger">Image is a required field.</p>');
            checkimage= true;
        }else{
            var file = $('#image').val();
            var fileExtension = file.split('.').pop().toLowerCase();
            if (fileExtension === 'png' || fileExtension === 'jpg' || fileExtension === 'jpeg') {
                checkimage= false;
            } else {
                $('#image').after('<p class="text-danger">Invalid file type. Please upload a PNG or JPG image.</p>');
                $(this).val('');
                checkimage= true;
            }
        }
        console.log(checkimage);
        if($('#categoryname').val() !='' && $('#amount').val() !='' && $('#image').val() !='' && numberRegex.test($('#amount').val()) && checkimage== false){
            $(this).parent('form').submit();
        }
      });
    });
  </script>