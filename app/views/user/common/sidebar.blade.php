<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
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
            
        </ul>
    </section>
</aside>
