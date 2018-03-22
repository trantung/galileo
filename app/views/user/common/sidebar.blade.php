<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">

            @if(checkPermissionUserByField('role_id'))
            <li>
                <a href="{{ action('StudentController@index') }}">
                    <i class="fa fa-newspaper-o"></i> 
                    <span>Quản lý học sinh</span>
                </a>
            </li>
            @endif
            <li class="treeview">
                <a href=""><i class="fa fa-newspaper-o"></i>
                    <span>Quản lý nội dung</span>
                    <span class="pull-right-container"><i class="fa fa-angle-down pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    @if(checkUrlPermission('DocumentController@index'))
                    <li>
                        <a href="{{ action('DocumentController@index') }}">
                            <i class="fa fa-newspaper-o"></i> 
                            <span>Quản lý các học liệu</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            <li class="treeview">
                <a href=""><i class="fa fa-newspaper-o"></i>
                    <span>Quản lý lịch học</span>
                    <span class="pull-right-container"><i class="fa fa-angle-down pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    @if(checkUrlPermission('PackageController@index'))
                    <li>
                        <a href="{{ action('PackageController@index') }}">
                            <i class="fa fa-newspaper-o"></i> 
                            <span>Quản lý gói học</span>
                        </a>
                    </li>
                    @endif
                    @if(checkPermissionUserByField('role_id'))
                    <li>
                        <a href="{{ action('ScheduleController@index') }}">
                            <i class="fa fa-newspaper-o"></i> 
                            <span>Quản lý lịch học</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ action('ScheduleController@course') }}">
                            <i class="fa fa-newspaper-o"></i> 
                            <span>Quản lý khóa học</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            
        </ul>
    </section>
</aside>
