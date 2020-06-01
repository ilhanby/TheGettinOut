<?php
$row = $_SESSION['myUser'];
?>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile border-bottom">
            <a href="<?php e(URL); ?>/pages/Others/logout.php/" class="nav-link">
                <div class="nav-profile-image">
                    <img src="/assets/images/faces-clipart/pic-<?php e(rand(1,4))?>.png" alt="profile">
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                        <span class="font-weight-bold mb-2"><?php e($row['name']);?></span>
                        <span class="text-secondary text-small"><?php e($row['position']);?></span>
                </div>
                <i class="mdi mdi-logout mr-2 text-primary nav-profile-badge"></i>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php e(URL); ?>/pages/Dashboard/index.php/">
                <span class="menu-title">Ana Sayfa</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php e(URL); ?>/pages/Kullanıcılar/index.php/">
                <span class="menu-title">Kullanıcılar</span>
                <i class="mdi mdi-contacts menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php e(URL); ?>/pages/Etkinlikler/index.php/">
                <span class="menu-title">Etkinlikler</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php e(URL); ?>/pages/Kategoriler/index.php/">
                <span class="menu-title">Kategoriler</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php e(URL); ?>/pages/Yorumlar/index.php/">
                <span class="menu-title">Yorumlar</span>
                <i class="mdi mdi-table-large menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php e(URL); ?>/pages/Anketler/index.php/">
                <span class="menu-title">Anketler</span>
                <i class="mdi mdi-medical-bag menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php e(URL); ?>/pages/Resimler/index.php/">
                <span class="menu-title">Resimler</span>
                <i class="mdi mdi-file-image menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php e(URL); ?>/pages/MusteriLogo/index.php/">
                <span class="menu-title">Müşteri Logoları</span>
                <i class="mdi mdi-account-card-details menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php e(URL); ?>/pages/Iconlar/index.php/">
                <span class="menu-title">Icon</span>
                <i class="mdi mdi-emoticon-poop menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php e(URL); ?>/pages/Ayarlar/index.php/">
                <span class="menu-title">Ayarlar</span>
                <i class="mdi mdi-settings menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>