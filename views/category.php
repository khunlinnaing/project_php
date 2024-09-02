<?php
require_once('./Ajax/categorylist_ajax.php');
echo json_decode($result);
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
                <th>User Name</th>
                <th>User Email</th>
                <th>User Role</th>
                <th>Action</th>
            </thead>
            <tbody>
            
            </tbody>
        </table>
    </div>
</section>