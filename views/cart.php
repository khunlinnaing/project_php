<?php
  require_once('./Ajax/userorder_ajax.php');
  require_once('./Ajax/product_ajax.php');
  require_once('./Ajax/category_ajax.php');
  // echo json_encode($result);
?>
<section id="hero" class="hero section dark-background">
    <div class='container'>
        <h3 class="text-center text-white">Order lists</h3>
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <th>No</th>
                <th>Products Image</th>
                <th>Category Name</th>
                <th>Products Name</th>
                <th>Products Amount</th>
                <th>Products Price</th>
                <th>Total Price</th>
                <th>Action</th>
            </thead>
            <tbody>
              <?php
              $count=1;
              $product_name='';
              $product_image='';
              $category_name = '';
              $product_id='';
              $total=0;
                foreach ($carts_val['data'] as $cartdata) {
                  foreach ($productlist['data'] as $product) {
                    if($cartdata['product_id'] == $product['id']){
                      $product_name  = $product['name'];
                      $product_image = $product['image'];
                      $product_id = $product['category_id'];
                    }
                  }
                  foreach ($result['data'] as $category) {
                    if($category['id'] == $product_id){
                      $category_name = $category['name'];
                    }
                  }
                  $total+=(int)$cartdata['amount'] * (int)$cartdata['price'];
                  echo '<tr>
                          <td>'.$count++.'</td>
                          <td><img src="'.$product_image.'" class="w-25"></td>
                          <td>'.($category_name ? $category_name : '').'</td>
                          <td>'.$product_name.'</td>
                          <td>'.$cartdata['amount'].'</td>
                          <td>'.$cartdata['price'].' <span class="text-danger">Kyats</span></td>
                          <td>'.((int)$cartdata['amount'] * (int)$cartdata['price']).' <span class="text-danger">Kyats</span></td>
                          <td>
                            <input type="hidden" value="'.$cartdata['id'].'" class="cart_id" >
                            <input type="hidden" value="'.$cartdata['amount'].'" class="amount">
                            <input type="hidden" value="'.$cartdata['id'].'" class="card_id">
                            <i class="fa-solid increase fa-plus mx-2 btn btn-primary" style="font-size: 20px;"></i>
                            <i class="fa-solid decrease fa-minus mx-2 btn btn-danger" style="font-size: 20px;"></i>
                          </td>
                        </tr>';
                }
                if($total != 0){
                  echo '<tr><td colspan="6">Total Price</td><td colspan="2">'.$total.' <span class="text-danger">Kyats</span></td></tr>';
                  echo '<tr><td colspan="6"></td><td colspan="2"><button class="btn btn-primary w-100 orderbtn">Order</button></td></tr>';
                }
              ?>
              
            </tbody>
          </table>
    </div>
</section>
<script>
  $(document).ready(function(){
    getcart();
    $('.increase').click(function(){
      var id= $(this).siblings('.cart_id').val();
      var amount= parseInt($(this).siblings('.amount').val())+1;
      ReduceAndIncrease(id, amount,'./Ajax/cart/increaseproduct_ajax.php')
    });
    $('.decrease').click(function(){
      var id= $(this).siblings('.cart_id').val();
      var amount= parseInt($(this).siblings('.amount').val())-1;
      if(amount > 0){
        ReduceAndIncrease(id, amount,'./Ajax/cart/increaseproduct_ajax.php')
      }else{
        ReduceAndIncrease(id, amount,'./Ajax/cart/reduceproduct_ajax.php')
      }
    });
    $('.orderbtn').click(function(){
      var id=[];
      $('.card_id').each(function() {
        id.push($(this).val());
      });
      $.ajax({
            method: 'POST',
            url: './Ajax/order/order_ajax.php', 
            data: JSON.stringify({"id": id, 'user_id': <?php echo $_SESSION['userid']; ?>}),
            contentType: 'application/json',
            success: function(response) {
              console.log(response)
              // var data = JSON.parse(response);
              //   if(data.status == 'success'){
              //     location.reload();
              //   }
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    });
    function ReduceAndIncrease(id, amount,url){
      $.ajax({
            method: 'POST',
            url: url, 
            data: JSON.stringify({"id": id, 'amount':amount}),
            contentType: 'application/json',
            success: function(response) {
              var data = JSON.parse(response);
                if(data.status == 'success'){
                  location.reload();
                }
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    }
    function getcart(){
      var userid = <?php echo $_SESSION['userid']; ?>;
      var data={"userid": userid};
      $.ajax({
            method: 'POST',
            url: './Ajax/cartnotic_ajax.php', 
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function(response) {
              var data = JSON.parse(response);
                if(data.status == 'success'){
                    $('i.fa-cart-shopping').siblings('sup').remove();
                }
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    }
  });
</script>