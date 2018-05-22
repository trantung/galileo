<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="treeview">
                @if(hasRole(ADMIN) | hasRole(DEV) | userAccess('system.manage') | userAccess('admin.manage'))
                    <a href=""><i class="fa fa-newspaper-o"></i>
                        <span>Quản lý hệ thống</span>
                        <span class="pull-right-container"><i class="fa fa-angle-down pull-right"></i></span>
                    </a>
                @endif
                <ul class="treeview-menu">
                    @if(userAccess('admin.manage'))
                    <li>
                        <a href="{{ action('AdminController@index') }}">
                            <i class="fa fa-user"></i> 
                            <span>Quản lý admin</span>
                        </a>
                    </li>
                    @endif

                    @if(userAccess('system.manage'))
                    <li>
                        <a href="{{ action('ManagerPartnerController@index') }}">
                            <i class="fa fa-hourglass-half"></i> 
                            <span>Quản lý đối tác</span>
                        </a>
                    </li>
                    @endif

                    @if(userAccess('system.manage'))
                    <li>
                        <a href="{{ action('ManagerCenterController@index') }}">
                            <i class="fa fa-building"></i> 
                            <span>Quản lý trung tâm</span>
                        </a>
                    </li>
                    @endif

                    @if(userAccess('system.manage'))
                    <li>
                        <a href="{{ action('ManagerUserController@index') }}">
                            <i class="fa fa-users"></i> 
                            <span>Quản lý nhân viên trung tâm</span>
                        </a>
                    </li>
                    @endif

                    @if(userAccess('system.manage'))
                    <li>
                        <a href="{{ action('SubjectController@index') }}">
                            <i class="fa fa-suitcase"></i> 
                            <span>Quản lý môn học</span>
                        </a>
                    </li>
                    @endif

                    @if(userAccess('system.manage'))
                    <li>
                        <a href="{{ action('ClassController@index') }}">
                            <i class="fa fa-home"></i> 
                            <span>Quản lý lớp học</span>
                        </a>
                    </li>
                    @endif

                    @if( userAccess('system.manage') )
                    <li>
                        <a href="{{ action('QuantityDownloadController@index') }}">
                            <i class="fa fa-download"></i> 
                            <span>Quản lý số lượt tải</span>
                        </a>
                    </li>
                    @endif

                    @if( userAccess('system.manage') )
                    <li>
                        <a href="{{ action('AskPermissionController@index') }}">
                            <i class="fa fa-history"></i> 
                            <span>Quản lý lịch sử tải</span>
                        </a>
                    </li>
                    @endif
               </ul> 
            </li>

            @if(userAccess('student.manage'))
            <li>
                <a href="{{ action('StudentController@index') }}">
                    <i class="fa fa-graduation-cap "></i> 
                    <span>Quản lý học sinh </span>
                </a>
            </li>
            @endif

            <li class="treeview">
                @if(userAccess('schedule.manage') | userAccess('schedule.create') | userAccess('content.manage'))
                    <a href=""><i class="fa fa-book"></i>
                        <span>Quản lý nội dung</span>
                        <span class="pull-right-container"><i class="fa fa-angle-down pull-right"></i></span>
                    </a>
                @endif
                <ul class="treeview-menu">
                    @if(userAccess('level.view'))
                    <li>
                        <a href="{{ action('LevelController@index') }}">
                            <i class="fa fa-connectdevelop"></i> 
                            <span>Quản lý trình độ</span>
                        </a>
                    </li>
                    @endif

                    @if(userAccess('document.view'))
                    <li>
                        <a href="{{ action('DocumentController@index') }}">
                            <i class="fa fa-file"></i> 
                            <span>Quản lý các học liệu</span>
                        </a>
                    </li>
                    @endif

                    @if(userAccess('document.upload_many'))
                    <li>
                        <a href="{{ action('AdminController@getUploadFile') }}">
                            <i class="fa fa-upload"></i> 
                            <span>Upload tài liệu</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>

            @if(userAccess('schedule.manage') | userAccess('document.manage'))
            <li class="treeview">
                <a href=""><i class="fa fa-calendar"></i>
                    <span>Quản lý lịch học</span>
                    <span class="pull-right-container"><i class="fa fa-angle-down pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    @if(userAccess('admin.manage'))
                    <li>
                        <a href="{{ action('PackageController@index') }}">
                            <i class="fa fa-cubes   "></i> 
                            <span>Quản lý gói học</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ action('ScheduleController@index') }}">
                            <i class="fa fa-calendar"></i> 
                            <span>Quản lý lịch học</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ action('ScheduleController@course') }}">
                            <i class="fa fa-tasks"></i> 
                            <span>Quản lý khóa học</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            @if( userAccess('system.manage') )
                <li>
                    <a href="{{ action('PermissionController@index') }}">
                        <i class="fa fa-cogs"></i> 
                        <span>Quản lý phân quyền</span>
                    </a>
                </li>
            @endif

        </ul>
    </section>
</aside>
