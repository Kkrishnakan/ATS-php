<div class="col-sm-6 clearfix">
    <div class="user-profile pull-right">
        <!--<img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">-->
        <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $user['first_name']." ".$user['last_name']; ?> <i class="fa fa-angle-down"></i></h4>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Settings</a>
            <a class="dropdown-item" href="data/logout.php">Log Out</a>
        </div>
    </div>
</div>
