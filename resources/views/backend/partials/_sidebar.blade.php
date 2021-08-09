<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>

                @foreach($sidebar as $key => $menu)
                    @if ($menu['permission'])
                        @if(array_key_exists("url",$menu))
                            <li @if(array_key_exists("url",$menu) && $menu['url'] == request()->url()) class="menuitem-active" @endif>
                                <a
                                    @if(array_key_exists("url",$menu))
                                    href="{{ $menu['url'] }}@if(array_key_exists("parameters",$menu))?@foreach ($menu['parameters'] as $subKey => $parameter){{ $subKey ."=". $parameter }}@endforeach @endif"
                                    @endif
                                >

                                    <i class="{{ $menu['icon'] }}"></i>
                                    <span> {{ $menu['name'] }} </span>

                                </a>
                            </li>

                        @else

                            <li>
                                <a href="#{{ $menu['id'] }}" data-toggle="collapse">
                                    <i class="{{ $menu['icon'] }}"></i>
                                    <span> {{ $menu['name'] }} </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="{{ $menu['id'] }}">
                                    <ul class="nav-second-level">
                                        @foreach($menu['subMenu'] as $subKey => $subMenu)
                                            @if($subMenu['permission'])

                                                @if(array_key_exists("url",$subMenu))
                                                    <li @if(array_key_exists("url",$subMenu) && $subMenu['url'] == request()->url()) class="menuitem-active" @endif>
                                                        <a
                                                            @if(array_key_exists("url",$subMenu))
                                                            href="{{ $subMenu['url'] }}@if(array_key_exists("parameters",$subMenu))?@foreach ($subMenu['parameters'] as $subKey => $parameter){{ $subKey ."=". $parameter }}@endforeach @endif"
                                                            @endif
                                                        >
                                                            &#8226; &nbsp; <span> {{ $subMenu['name'] }} </span>

                                                        </a>
                                                    </li>
                                                @else
                                                <li>
                                                        <a href="#{{ $subMenu['id'] }}" data-toggle="collapse">
                                                            &#8226; &nbsp; {{ $subMenu['name'] }} <span class="menu-arrow"></span>
                                                        </a>
                                                        <div class="collapse" id="{{ $subMenu['id'] }}">
                                                            <ul class="nav-second-level">
                                                                @foreach($subMenu['subSubMenu'] as $subSubKey => $subSubMenu)
                                                                    @if($subSubMenu['permission'])
                                                                        <li>
                                                                             <a href="{{ $subSubMenu['url'] }}"> &#8226; &nbsp; {{ $subSubMenu['name'] }}</a>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>

                                                    @endif
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </li>

                        @endif
                    @endif

                @endforeach

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>

</div>
