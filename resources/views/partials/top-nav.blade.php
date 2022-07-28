<nav class="brand navbar navbar-default navbar-fixed-top">

    <div class="brand">

        <a href="{{ asset('index') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Klorofil Logo" class="img-responsive logo">
        </a>

        @if(!request()->routeIs('approve.failed'))
        <div class="navbar-btn">
            <button type="button" class="btn-toggle-fullwidth menu-toggle-btn"><i class="lnr lnr-arrow-left-circle"></i></button>
        </div>
        @endif

    </div>

    <div id="navbar-menu">

            <ul class="nav navbar-nav navbar-right dropdown-ul">

                {{-- <li class="dropdown">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <span>

                            @if (Session::has('business_name'))
                                {{ Session('business_name') }}
                            @endif

                        </span>
                        <i class="icon-submenu lnr lnr-chevron-down"></i>

                    </a>

                    <ul class="dropdown-menu">

                        <li><a href="#"><i class="lnr lnr-user"></i> <span>My Account</span></a></li>

                        <li>
                            <a class="dropdown-item" href="{{ route('businesslogout') }}">
                                <i class="lnr lnr-exit"></i> <span>
                                {{ __('Logout') }}
                                </span>
                            </a>

                            <form id="logout-form" action="" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>

                    </ul>

                </li> --}}
                {{-- <li class="dropdown">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

                        <span>


                        </span>
                        <i class="icon-submenu lnr lnr-chevron-down"></i>

                    </a>

                    <ul class="dropdown-menu">

                        <li><a href="#"><i class="lnr lnr-user"></i> <span>My Account</span></a></li>

                        <li>
                            <a class="dropdown-item" href="http://finder-delivery.test/logoutadmin">
                                <i class="lnr lnr-exit"></i> <span>
                                Logout
                                </span>
                            </a>

                            <form id="logout-form" action="" method="POST" style="display: none;">
                                <input type="hidden" name="_token" value="5DUwI07JwmbrcoFoOfBMiGJkRSvQae3wj0ubgoqV">                            </form>
                        </li>

                    </ul>

                </li> --}}

                <li class="drop-li">
                    <div class="drop-btn">
                        <i class="lnr lnr-chevron-down"></i>
                    </div>
                    <div class="items">
                        <a class="item" href="#">
                            <i class="lnr lnr-user"></i>
                            <span>Account</span>
                        </a>
                        <a class="item" href="{{ route('businesslogout') }}">
                            <i class="lnr lnr-exit"></i>
                            <span>
                                Logout
                            </span>
                        </a>
                    </div>
                </li>

            </ul>

    </div>
</nav>
