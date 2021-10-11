<nav class="pcoded-navbar menu-light">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div " >
            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>
                <li class="nav-item"><a href="{{ route('index') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Tableau de bord</span></a></li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Audiences</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ route('demande.index') }}">Liste des demandes</a></li>
                        <li><a href="{{ route('demande.create') }}">Nouvelle des demandes</a></li>

                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Salle</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="#">Default</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
