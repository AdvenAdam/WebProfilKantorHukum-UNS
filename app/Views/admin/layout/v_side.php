<div class="page-sidebar">
    <ul class="list-unstyled accordion-menu">
        <li class="sidebar-title">
            Main
        </li>
        <li class="<?= $active == 'dashboard' ? 'active-page' : ''; ?>">
            <a href="/Admin"><i data-feather="home"></i>Dashboard</a>
        </li>
        <li class="sidebar-title">
            Manajemen Dokumen
        </li>
        <li class="<?= $active == 'dokumen' ? 'active-page' : ''; ?>">
            <a href="/Admin/Dokumen" class=""><i data-feather="inbox"></i>Dokumen Eksternal</a>
        </li>
        <li class="<?= $active == 'internal' ? 'active-page' : ''; ?>">
            <a href="/Admin/DokumenInternal"><i data-feather="inbox"></i>Dokumen Internal</a>
        </li>
        <li class="<?= $active == 'SK' ? 'active-page' : ''; ?>">
            <a href="" class=""><i data-feather="file-text"></i>SK<i class="fas fa-chevron-right dropdown-icon"></i></a>
            <ul class="">
                <li><a href="/Admin/SK" class="<?= $submenu == 'sk' ? 'active' : ''; ?>"><i class="fas fa-file-alt"></i>SK</a></li>
                <li><a href="/Admin/Herarki" class="<?= $submenu == 'herarki' ? 'active' : ''; ?>"><i class="fas fa-sitemap"></i>Herarki</a></li>
                <li><a href="/Admin/Peraturan" class="<?= $submenu == 'peraturan' ? 'active' : ''; ?>"><i class="fas fa-book"></i>Peraturan</a></li>
            </ul>
        </li>
        <li class="sidebar-title">
            Manajemen Informasi
        </li>
        <li class="<?= $active == 'info' ? 'active-page' : ''; ?>">
            <a href="" class=""><i data-feather="info"></i>Informasi Umum<i class="fas fa-chevron-right dropdown-icon"></i></a>
            <ul class="">
                <li><a href="/Admin/Slider" class="<?= $submenu == 'slider' ? 'active' : ''; ?>"><i class="fas fa-sliders-h"></i>Slider</a></li>
                <li><a href="/Admin/Informasi" class="<?= $submenu == 'informasi' ? 'active' : ''; ?>"><i class="fas fa-info"></i>Informasi Profil</a></li>
                <li><a href="/Admin/Masukan" class="<?= $submenu == 'masukan' ? 'active' : ''; ?>"><i class="fas fa-inbox"></i>Masukan</a></li>
                <li><a href="/Admin/Struktur" class="<?= $submenu == 'struktur' ? 'active' : ''; ?>"><i class="fas fa-briefcase"></i>Struktur Organisasi</a></li>
                <li><a href="/Admin/Template" class="<?= $submenu == 'template' ? 'active' : ''; ?>"><i class="fab fa-tumblr"></i>Template</a></li>
                <li><a href="/Admin/Pengumuman" class="<?= $submenu == 'pengumuman' ? 'active' : ''; ?>"><i class="fas fa-bullhorn"></i></i>Pengumuman</a></li>
            </ul>
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