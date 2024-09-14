<?php
    require_once('./Ajax/category_ajax.php');
    require_once('./Ajax/product_ajax.php');
    $option='<option value="">---</option>';
    $data = $result['data'];
?>
<section id="hero" class="hero section dark-background">
    <div class='container'>
    <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-title"><h2 class="text-center text-primary">Update Product</h2></div>
                    <div class="card-body">
                        <?php
                            $list=$productlist['data'];
                            $category_name='';
                            $count=0;
                            for ($i=0; $i < count($list); $i++) { 
                                if($_POST['productid'] == $list[$i]['id']){
                                    if(isset($data)){
                                        for($j=0; $j < count($data); $j++){
                                            if( $list[$i]['category_id'] == $data[$j]['id']){
                                                $option .='<option value="'.$data[$j]['id'].'" selected>'.$data[$j]['name'].'</option>';
                                            }else{
                                                $option .='<option value="'.$data[$j]['id'].'">'.$data[$j]['name'].'</option>';
                                            }
                                        }
                                    }
                                    echo '<img src="'.$list[$i]['image'].'" style=" width: 100px; height: 100px;" id="categoryimage">';
                                    echo '
                                    <form action="./Ajax/productupdate_ajax.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="productid" value="'.$list[$i]['id'].'">
                                        <div class="form-group my-2">
                                            <label for="categoryname">Category Name</label>
                                            <select type="text" class="form-control" id="categoryname" name="categoryname">
                                                '.$option.'
                                            </select>
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="productname">Products Name</label>
                                            <input type="text" class="form-control" id="productname" name="productname" value="'.$list[$i]['name'].'">
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="image">Products Image</label>
                                             <input type="hidden" name="oldimage" value="'.$list[$i]['image'].'" id="oldimage">
                                            <input type="file" class="form-control" id="image" name="image">
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="amount">Products Amount</label>
                                            <input type="text" class="form-control" id="amount" name="amount" value="'.$list[$i]['amount'].'">
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="price">Products Price</label>
                                            <input type="text" class="form-control" id="price" name="price" value="'.$list[$i]['price'].'">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <button type="submit" class="form-control btn btn-primary btn-block updateproduct_submit">Update</button>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <a href="./index.php" class="form-control btn btn-danger btn-block">
                                                Cancel</a>
                                            </div>
                                        </div>
                                    </form>
                                    ';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
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
        $('.updateproduct_submit').click(function(e){
            e.preventDefault();
            const numberRegex =  /^\d+$/;
            var checkimage= false;
            $('p.text-danger').remove();
            if($('#categoryname').val() ==''){
                $('#categoryname').after('<p class="text-danger">Category name is a required field.</p>');
            }
            if($('#productname').val() ==''){
                $('#productname').after('<p class="text-danger">Product name is a required field.</p>');
            }
            if($('#amount').val() ==''){
                $('#amount').after('<p class="text-danger">Amount is a required field.</p>');
            }else if(!numberRegex.test($('#amount').val())){
                $('#amount').after('<p class="text-danger">Enter amount 0 to 9.</p>');
            }
            if($('#price').val() ==''){
                $('#price').after('<p class="text-danger">Price is a required field.</p>');
            }else if(!numberRegex.test($('#price').val())){
                $('#price').after('<p class="text-danger">Enter price 0 to 9.</p>');
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
            if($('#categoryname').val() !='' && $('#productname').val() !='' && $('#amount').val() !='' && numberRegex.test($('#amount').val()) && $('#price').val() !='' && numberRegex.test($('#price').val()) && $('#oldimage').val() !='' && checkimage== false){
                $(this).parent('div').parent('div').parent('form').submit();
            }else{
                console.log('error')
            }
        });
    });
</script>