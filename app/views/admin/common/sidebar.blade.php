<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="treeview">
                <a href=""><i class="fa fa-newspaper-o"></i>
                    <span>Quản lý hệ thống</span>
                    <span class="pull-right-container"><i class="fa fa-angle-down pull-right"></i></span>
                </a>
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

<<<<<<< HEAD
            @if(checkUrlPermission('AdminController@index'))
            <li>
                <a href="{{ action('AdminController@index') }}">
                    <i class="fa fa-newspaper-o"></i> 
                    <span>Quản lý admin</span>
                </a>
=======
                    @if(checkUrlPermission('AdminController@index'))
                    <li>
                        <a href="{{ action('AdminController@index') }}">
                            <i class="fa fa-newspaper-o"></i> 
                            <span>Quản lý admin</span>
                        </a>
                    </li>
                    @endif
               </ul> 
>>>>>>> d36d69d8f70f443bdb8b1b478fbae748c7a096e7
            </li>
            
            
            @if(checkUrlPermission('StudentController@index'))
            <li>
                <a href="{{ action('StudentController@index') }}">
                    <i class="fa fa-newspaper-o"></i> 
<<<<<<< HEAD
                    <span>Quản lý học sinh</span>
                </a>
            </li>
            @endif

            @if(checkUrlPermission('LevelController@index'))
            <li>
                <a href="{{ action('LevelController@index') }}">
                    <i class="fa fa-newspaper-o"></i> 
                    <span>Quản lý các trình độ</span>
=======
                    <span>Quản lý học sinh </span>
>>>>>>> d36d69d8f70f443bdb8b1b478fbae748c7a096e7
                </a>
            </li>
            @endif
            
            <li class="treeview">
                <a href=""><i class="fa fa-newspaper-o"></i>
                    <span>Quản lý nội dung</span>
                    <span class="pull-right-container"><i class="fa fa-angle-down pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    @if(checkUrlPermission('LevelController@index'))
                    <li>
                        <a href="{{ action('LevelController@index') }}">
                            <i class="fa fa-newspaper-o"></i> 
                            <span>Quản lý trình độ</span>
                        </a>
                    </li>
                    @endif
                    
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
            
        </ul>
    </section>
</aside>
