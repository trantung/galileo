<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">Menu</li>
            <li>
                <a href="{{ action('ManagerPartnerController@index') }}">
                    <i class="fa fa-newspaper-o"></i> 
                    <span>Quản lý đối tác</span>
                </a>
            </li>
            <li>
                <a href="{{ action('ManagerCenterController@index') }}">
                    <i class="fa fa-newspaper-o"></i> 
                    <span>Quản lý các trung tâm</span>
                </a>
            </li>
            <li>
                <a href="{{ action('ManagerUserController@index') }}">
                    <i class="fa fa-newspaper-o"></i> 
                    <span>Quản lý nhân viên trung tâm</span>
                </a>
            </li>
            <li>
                <a href="{{ action('SubjectController@index') }}">
                    <i class="fa fa-newspaper-o"></i> 
                    <span>Quản lý các môn học</span>
                </a>
            </li>
            <li>
                <a href="{{ action('ClassController@index') }}">
                    <i class="fa fa-newspaper-o"></i> 
                    <span>Quản lý các lớp học</span>
                </a>
            </li>
            <li>
                <a href="{{ action('LevelController@index') }}">
                    <i class="fa fa-newspaper-o"></i> 
                    <span>Quản lý các trình độ</span>
                </a>
            </li>

        </ul>
    </section>
</aside>