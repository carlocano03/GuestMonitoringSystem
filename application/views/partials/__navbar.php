<style>
    #sidebarToggle {
        width: 30px;
        margin-left: 252px;
        background: #b71540;
        border: none;
        color: #fff;
        border-bottom-right-radius: 5px;
        border-top-right-radius: 5px;
        position: absolute;
        z-index: -1;
    }
</style>
<body class="sb-nav-fixed" onload="startTime()">
    <!-- <div class="sb-topnav">

    </div> -->

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <!-- Sidebar Toggle-->
                <button id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading text-center">
                            <img src="<?= base_url('assets/img/avatar.png')?>" alt="Avatar Image">
                            <h5><?= $_SESSION['loggedIn']['fullname']; ?></h5>
                            <div class="avatar-text"><i><?= $_SESSION['loggedIn']['email']; ?></i></div>
                            <div class="avatar-text"><?= $_SESSION['loggedIn']['branch']; ?></div>
                        </div>
                        <hr class="mt-0" style="background: #474787;">
                        <a class="nav-link <?= ($this->uri->segment(2) == '' || $this->uri->segment(2) == 'main' ? 'active' : '') ?>" href="<?= base_url('main')?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Main Dashboard
                        </a>
                        <a class="nav-link <?= ($this->uri->segment(2) == 'monitoring_board' ? 'active' : '') ?>" href="<?= base_url('main/monitoring_board')?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Guest Monitoring Board
                        </a>
                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-clock"></i></div>
                            Time Monitoring Analytics
                        </a>
                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-cog"></i></div>
                            Customer Registration
                        </a>
                        <a class="nav-link <?= ($this->uri->segment(2) == 'sales_transaction' ? 'active' : '') ?>" href="<?= base_url('main/sales_transaction')?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
                            Sales & Transaction
                        </a>
                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-money-check"></i></div>
                            Pricing & Promo
                        </a>
                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                            Inventory Module
                        </a>
                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-info-circle"></i></div>
                            Reservation & Inquiry
                        </a>
                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                            Party Package
                        </a>
                        <a class="nav-link <?= ($this->uri->segment(2) == 'account' ? 'active' : '') ?>" href="<?= base_url('main/account')?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-alt"></i></div>
                            Account Management
                        </a>
                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                            Configuration & Settings
                        </a>
                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-bar"></i></div>
                            General Reports
                        </a>
                    </div>
                </div>
            </nav>
        </div>