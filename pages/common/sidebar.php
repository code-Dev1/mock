<?php $role = $auth->authRole('admin'); ?>
<div class="page-sidebar">
    <span class="fa fa-bars anim" id="sidebarToggle"></span>
    <ul id="sidebar">
        <li>
            <a href="dashboard?page=home" class="text-light">
                <span class="menu-icon fa fa-dashboard"></span>
                <span class="menu-text">داشبورد</span>
            </a>
        </li>
        <li>
            <a>
                <span class="menu-icon fa fa-sitemap"></span>
                <span class="menu-text">مدریت شاگردان</span>
                <span class="fa fa-angle-left"></span>
            </a>
            <div class="child-menu">
                <a href="dashboard?page=students">لیست شاگردان</a>
                <a href="dashboard?page=addStudent">افزودن شاگرد</a>
            </div>
        </li>
        <li>
            <a>
                <span class="menu-icon fa fa-shopping-cart"></span>
                <span class="menu-text">مدیریت کابران</span>
                <span class="fa fa-angle-left"></span>
            </a>
            <div class="child-menu">
                <a href="dashboard?page=users">لیست کابران</a>
                <a class="<?= ($role) ? '' : 'd-none' ?>" href="dashboard?page=addUser">آفزودن کابر</a>
            </div>
        </li>
        <li>
            <a href="logout" class="text-light">
                <span class="menu-icon fa fa-power-off"></span>
                <span class="menu-text">خارج شدن</span>
            </a>
        </li>
    </ul>
</div>