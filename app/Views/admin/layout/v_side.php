<div class="page-sidebar">
    <ul class="list-unstyled accordion-menu">
        <li class="sidebar-title">
            Main
        </li>
        <li class="<?= $active == 'dashboard' ? 'active-page' : ''; ?>">
            <a href="/Admin"><i data-feather="home"></i>Dashboard</a>
        </li>
        <li class="sidebar-title">
            Manajemen
        </li>
        <li class="<?= $active == 'dokumen' ? 'active-page' : ''; ?>">
            <a href="" class=""><i data-feather="inbox"></i>Dokumen</a>
            <ul class="">
                <li><a href="/Admin/Dokumen/create" class="<?= $submenu == 'input' ? 'active' : ''; ?>"><i class="far fa-circle"></i>Tambah Dokumen</a></li>
                <li><a href="/Admin/Dokumen" class="<?= $submenu == 'view' ? 'active' : ''; ?>"><i class="far fa-circle"></i>View Dokumen</a></li>
            </ul>
        </li>
        <li class="<?= $active == 'user' ? 'active-page' : ''; ?>">
            <a href="/Admin/User"><i data-feather="users"></i>Users</a>
        </li>
        <li>
            <a href="social.html"><i data-feather="sidebar"></i>Slider</a>
        </li>
        <li>
            <a href="file-manager.html"><i data-feather="briefcase"></i>Struktur Organisasi</a>
        </li>
        <li class="sidebar-title">
            User
        </li>
        <li class="<?= $active == 'profil' ? 'active-page' : ''; ?>">
            <a href="/Admin/User/edit/<?= session()->user_id; ?>"><i data-feather="user"></i>Profil</a>
        </li>
        <li>
            <a href="/logout"><i data-feather="log-out"></i>Logout</a>
        </li>
</div>