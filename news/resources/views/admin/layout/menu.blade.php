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
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Category<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                    <a href="{{url('admin/categories')}}">List Category</a>
                    </li>
                    <li>
                        <a href="{{url('admin/categories/create')}}">Add Category</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-align-justify fa-fw"></i> News Type<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                    <a href="{{url('admin/newstypes')}}">List News Type</a>
                    </li>
                    <li>
                        <a href="{{url('admin/newstypes/create')}}">Add News Type</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-align-justify fa-fw"></i> News<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                    <a href="{{url('admin/news')}}">List News</a>
                    </li>
                    <li>
                        <a href="{{url('admin/news/create')}}">Add News</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-cube fa-fw"></i> Product<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">List Product</a>
                    </li>
                    <li>
                        <a href="#">Add Product</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-users fa-fw"></i> User<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">List User</a>
                    </li>
                    <li>
                        <a href="#">Add User</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
