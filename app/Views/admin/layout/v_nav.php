<div class="page-header">
    <nav class="navbar navbar-expand-lg d-flex justify-content-between">
        <div class="" id="navbarNav">
            <ul class="navbar-nav" id="leftNav">
                <li class="nav-item">
                    <a class="nav-link" id="sidebar-toggle" href="#"><i data-feather="arrow-left"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Admin">Home</a>
                </li>
            </ul>
        </div>
        <div class="logo">
            <a class="navbar-brand" href=""></a>
        </div>
        <div class="" id="headerNav">
            <ul class="navbar-nav">

                <li class="nav-item dropdown">
                    <a class="nav-link profile-dropdown" href="#" id="profileDropDown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="/image/foto/<?= session()->user_image; ?>" style="width: 40px; height: 40px; object-fit: cover; object-position: center;" class="rounded-circle" alt=""></a>
                    <div class="dropdown-menu dropdown-menu-end profile-drop-menu" aria-labelledby="profileDropDown">
                        <a class="dropdown-item" href="/Admin/User/edit/<?= session()->user_id; ?>"><i data-feather="user"></i>Profile</a>
                        <a class="dropdown-item" href="/logout"><i data-feather="log-out"></i>Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>