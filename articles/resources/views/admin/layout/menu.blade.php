<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-users fa-fw"></i> User<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                    <a href="{{url('admin/users')}}">List User</a>
                    </li>
                    <li>
                        <a href="{{url('admin/users/create')}}">Add User</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-align-justify fa-fw"></i> Role<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                    <a href="{{url('admin/roles')}}">List Role</a>
                    </li>
                    <li>
                        <a href="{{url('admin/roles/create')}}">Add Role</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-align-justify fa-fw"></i> Article<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                    <a href="{{url('admin/articles')}}">List Article</a>
                    </li>
                    <li>
                        <a href="{{url('admin/articles/create')}}">Add Article</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
