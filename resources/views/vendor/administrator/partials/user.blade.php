<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <span class="hidden-xs">{{ \Auth::user()->name }}</span>
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">
        <li>
            <a href="{{ url('admin/logout') }}">
                <i class="glyphicon glyphicon-log-out"></i> {{ trans('Logout') }}
            </a>
        </li>
    </ul>
</li>