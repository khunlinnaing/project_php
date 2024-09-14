<?php
require_once('./Ajax/categorylist_ajax.php');
?>
<section id="hero" class="hero section dark-background">
    <div class="container">
        <?php
            $data = $categorylist['data'];
            for ($i=0; $i < count($data); $i++) {
                
                // echo $role_name;
                if($_POST['categoryid'] == $data[$i]['id']){
                    echo '<h3 class="text-center text-white">'.$data[$i]['name'].' Detail</h3>';
                    echo '<img src="'.$data[$i]['image'].'" style=" width: 100px; height: 100px;" id="categoryimage">';
                    echo '
                    <form action="./Ajax/categoryupdate_ajax.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="categoryid" value="'.$data[$i]['id'].'">
                            <div class="form-group my-2">
                                <label for="categoryname">Category Name</label>
                                <input type="text" class="form-control" id="categoryname" name="categoryname" value="'.$data[$i]['name'].'">
                            </div>
                            <div class="form-group my-2">
                                <label for="image">Category Image</label>
                                <input type="hidden" name="oldimage" value="'.$data[$i]['image'].'" id="oldimage">
                                <input type="file" class="form-control" id="image" name="image" >
                            </div>
                            <div class="form-group my-2">
                                <label for="amount">Category Amount</label>
                                <input type="text" class="form-control" id="amount" name="amount" value="'.$data[$i]['amount'].'">
                            </div>
                            <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <button type="submit" class="form-control btn btn-primary btn-block updatecategory_submit">Update</button>
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
      $('#image').change(function(event){
        $('#oldimage').val($(this).val())
        var file = event.target.files[0]; // Get the file from input
        if (file) {
            var reader = new FileReader(); // Create a FileReader object
            reader.onload = function(e) {
                $('#categoryimage').attr('src', e.target.result)
            }
            reader.readAsDataURL(file); // Read the file as a data URL
        }
        
      });
      $('.updatecategory_submit').click(function(e){
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
        if($('#oldimage').val() ==''){
            $('#oldimage').after('<p class="text-danger">Image is a required field.</p>');
            checkimage= true;
        }else{
            if($('#oldimage').val()){
                var file = $('#image').val();
                var fileExtension = file.split('.').pop().toLowerCase();
                if(file){
                    if (fileExtension === 'png' || fileExtension === 'jpg' || fileExtension === 'jpeg') {
                        checkimage= false;
                    } else {
                        $('#oldimage').val('')
                        $('#image').after('<p class="text-danger">Invalid file type. Please upload a PNG or JPG image.</p>');
                        $(this).val('');
                        checkimage= true;
                    }
                }
            }
        }
        if($('#categoryname').val() !='' && $('#amount').val() !='' && $('#oldimage').val() !='' && numberRegex.test($('#amount').val()) && checkimage== false){
            $(this).parent('div').parent('div').parent('form').submit();
        }else{
            console.log('error')
        }
      });
    });
  </script>