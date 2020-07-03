<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('admin') }}" class="nav-link {{ request()->is('admin') ? ' active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <p>
                    DashBoard
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview {{ request()->is('admin/posts*') ? ' menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="fas fa-blog"></i>
                <p>
                    Blog
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->is('admin/posts') ? ' active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All Posts</p>
                    </a>
                </li>
                <li class="nav-item">
                    @if(request()->is('admin/posts/*'))
                        <a href="{{ route('admin.posts.index', '#create-modal') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>New Post</p>
                        </a>
                    @else
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#postModal">
                            <i class="far fa-circle nav-icon"></i>
                            <p>New Post</p>
                        </a>
                    @endif
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{ request()->is('admin/users*') ? ' menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/users*') ? ' active' : '' }}">
                <i class="fas fa-users"></i>
                <p>
                    Users
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->is('admin/users') ? ' active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users.create') }}" class="nav-link {{ request()->is('admin/users/create') ? ' active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>New User</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link" onclick="document.getElementById('logoutform').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <p>Logout</p>
            </a>
        </li>
    </ul>
</nav>
