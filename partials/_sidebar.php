<?php
global $db;

$cat = $db->_Category();

?>
<style>
    .anaLogo{
        animation: bounceIn 0.6s;
        transform: rotate(0deg) scale(0.9) translateZ(0);
        transition: all 0.5s cubic-bezier(.8,1.8,.75,.75);
        cursor: pointer;
        padding:0 35px;
    }
    .anaLogo:hover {
        transform: rotate(360deg) scale(1.1);
    }
</style>
<div class="sidebar" data-color="azure" id="sidebar" data-background-color="red" data-image="../assets/img/sidebar-2.jpg">
    <div class="logo" style="box-shadow: 0 10px 18px grey;">
        <img src="<?php e(URL);?>/assets/img/logoCor.png"  class="card-img-top anaLogo"/>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" id="dashboard" href="<?php e("http://$_SERVER[HTTP_HOST]");?>">
                    <i class="material-icons">dashboard</i>
                    <p>ANA SAYFA</p>
                </a>
            </li>
        <?php foreach ($cat as $row) { /*Class olarak 'categoryLink' eklenecek*/?>
            <li class="nav-item">
                <a class="nav-link categoryLink" href="javascript:void(0)" data-value="<?php e($row['Id']);?>">
                    <i class="material-icons"><?php e($row['icon']);?></i>
                    <p><?php e($row['name']);?></p>
                </a>
            </li>
        <?php } ?>
            <hr><br>
        </ul>
    </div>
</div>