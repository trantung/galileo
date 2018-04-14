<?php 
    $admin = Auth::admin()->get();
    $roleId = null;
    $email = null;
    if ($admin) {
        $roleId = $admin->role_id;
        $email = $admin->email;
    }
?>
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="treeview">
                @if(checkUrlPermission('ManagerPartnerController@index'))
                    <a href=""><i class="fa fa-newspaper-o"></i>
                        <span>Quản lý hệ thống</span>
                        <span class="pull-right-container"><i class="fa fa-angle-down pull-right"></i></span>
                    </a>
                @endif
                <ul class="treeview-menu">
                    @if(checkUrlPermission('ManagerPartnerController@index'))
                    <li>
                        <a href="{{ action('ManagerPartnerController@index') }}">
                            <i class="fa fa-newspaper-o"></i> 
                            <span>Quản lý đối tác</span>
                        </a>
                    </li>
                    @endif

                    @if(checkUrlPermission('ManagerCenterController@index'))
                    <li>
                        <a href="{{ action('ManagerCenterController@index') }}">
                            <i class="fa fa-newspaper-o"></i> 
                            <span>Quản lý trung tâm</span>
                        </a>
                    </li>
                    @endif

                    @if(checkUrlPermission('ManagerUserController@index'))
                    <li>
                        <a href="{{ action('ManagerUserController@index') }}">
                            <i class="fa fa-newspaper-o"></i> 
                            <span>Quản lý nhân viên trung tâm</span>
                        </a>
                    </li>
                    @endif

                    @if(checkUrlPermission('SubjectController@index'))
                    <li>
                        <a href="{{ action('SubjectController@index') }}">
                            <i class="fa fa-newspaper-o"></i> 
                            <span>Quản lý môn học</span>
                        </a>
                    </li>
                    @endif

                    @if(checkUrlPermission('ClassController@index'))
                    <li>
                        <a href="{{ action('ClassController@index') }}">
                            <i class="fa fa-newspaper-o"></i> 
                            <span>Quản lý lớp học</span>
                        </a>
                    </li>
                    @endif
                    @if(checkUrlPermission('AdminController@index'))
                    <li>
                        <a href="{{ action('AdminController@index') }}">
                            <i class="fa fa-newspaper-o"></i> 
                            <span>Quản lý admin</span>
                        </a>
                    </li>
                    @endif

                    <li>
                        <a href="{{ action('QuantityDownloadController@index') }}">
                            <i class="fa fa-newspaper-o"></i> 
                            <span>Quản lý số lượt tải</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ action('AskPermissionController@index') }}">
                            <i class="fa fa-newspaper-o"></i> 
                            <span>Quản lý số lịch sử tải</span>
                        </a>
                    </li>
               </ul> 
            </li>
            @if(checkPermissionUserByField('role_id'))
            <li>
                <a href="{{ action('StudentController@index') }}">
                    <i class="fa fa-newspaper-o"></i> 
                    <span>Quản lý học sinh </span>
                </a>
            </li>
            @endif
            <li class="treeview">
                <a href=""><i class="fa fa-newspaper-o"></i>
                    <span>Quản lý nội dung</span>
                    <span class="pull-right-container"><i class="fa fa-angle-down pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    @if(checkUrlPermission('LevelController@index') || isset($roleId))
                    <li>
                        <a href="{{ action('LevelController@index') }}">
                            <i class="fa fa-newspaper-o"></i> 
                            <span>Quản lý trình độ</span>
                        </a>
                    </li>
                    @endif
                    @if(checkUrlPermission('DocumentController@index') || isset($roleId))
                    <li>
                        <a href="{{ action('DocumentController@index') }}">
                            <i class="fa fa-newspaper-o"></i> 
                            <span>Quản lý các học liệu</span>
                        </a>
                    </li>
                    @endif
                    @if(checkUrlPermission('AdminController@getUploadFile') || (isset($roleId) && isset($email)))
                    <li>
                        <a href="{{ action('AdminController@getUploadFile') }}">
                            <i class="fa fa-newspaper-o"></i> 
                            <span>Upload tài liệu</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @if(isset($roleId) && $roleId == ADMIN)
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
            @endif
        </ul>
    </section>
</aside>
