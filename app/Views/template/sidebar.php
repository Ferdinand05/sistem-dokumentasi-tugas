<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>" class="brand-link">
        <span class="brand-text font-weight-light">Docs Tugas</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url() ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Ferdinand</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-header text-danger">Master Data</li>
                <li class="nav-item">
                    <a href="<?= base_url('semester') ?>" class="nav-link">
                        <i class="fas fa-graduation-cap nav-icon"></i>
                        <p>Semester</p>
                    </a>
                </li>
                <li class="nav-item user-panel">
                    <a href="<?= base_url('pelajaran') ?>" class="nav-link">
                        <i class="fas fa-clipboard-list nav-icon"></i>
                        <p>Pelajaran</p>
                    </a>
                </li>

                <li class="nav-header text-primary"> Data</li>
                <li class="nav-item">
                    <a href="<?= base_url('tugas') ?>" class="nav-link">
                        <i class="fas fa-tasks nav-icon"></i>
                        <p>Tugas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('modul') ?>" class="nav-link">
                        <i class="fas fa-book-reader nav-icon"></i>
                        <p>Modul/Slide</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>