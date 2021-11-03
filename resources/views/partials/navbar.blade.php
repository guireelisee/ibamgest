<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#"><span></span></a>
        <a href="{{ route('index') }}" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
            <h4 class="text-white">IBAM<span style="color: whitesmoke; font-size: 2rem">.</span>GEST</h4>
        </a>
        <a href="#" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="#" class="pop-search"><i class="feather icon-search"></i></a>
                <div class="search-bar">
                    <input type="text" class="form-control border-0 shadow-none" placeholder="Recherchez ici ...">
                    <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li>
                <div class="dropdown drp-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="feather icon-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <img src="{{Storage::url(Auth::user()->avatar)}}" class="img-radius" alt="User-Profile-Image">
                            <span>{{ Auth::user()->name .' '.Auth::user()->firstname }}</span>
                            {{-- <span>{{ Auth::user()->role->name }}</span> --}}
                        </div>
                        <ul class="pro-body">
                            <li><a href="user-profile.html" class="dropdown-item"><i class="feather icon-user"></i> Mon profil</a></li>
                            <li><a href="email_inbox.html" class="dropdown-item"><i class="feather icon-mail"></i> Mes messages</a></li>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf<li><a href="logout" class="dropdown-item" onclick="event.preventDefault();this.closest('form').submit();"><i class="feather icon-power"></i> Se déconnecter</a></li>
                            </form>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>


</header>
