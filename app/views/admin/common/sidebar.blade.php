<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">Menu</li>
            <li>
                <a href="{{ action('AdminController@index') }}">
                    <i class="fa fa-newspaper-o"></i> 
                    <span>Quản lý thành viên trung tâm</span>
                </a>
            </li>
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
        </ul>
    </section>
</aside>