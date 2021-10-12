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
                        @can('secretaire')
                        <li><a href="{{ route('fiche.create') }}">Enregistrement</a></li>
                        @endcan
                        @can('admin')
                        <li><a href="{{ route('fiche.create') }}">Enregistrement</a></li>
                        @endcan
                        <li><a href="{{ route('fiche.index') }}">Liste des demandes</a></li>
                    </ul>
                </li>
                @can('admin')
                <li class="nav-item pcoded-hasmenu">
                    <a href="#" class="nav-link "><span class="pcoded-micon"><i class="feather icon-settings"></i></span><span class="pcoded-mtext">Paramètres</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ route('register') }}">Inscription</a></li>
                        <li><a href="{{ route('user.index') }}">Utilisateurs</a></li>
                        <li class="nav-item pcoded-hasmenu">
                            <a href="#" class="nav-link "><span class="pcoded-micon"><i class="feather icon-settings"></i></span><span class="pcoded-mtext">Filieres</span></a>
                            <ul class="pcoded-submenu">
                                <li><a href="{{ route('filiere.index') }}">Liste des filières</a></li>
                                <li><a href="{{ route('filiere.create') }}">Nouvelle filière</a></li>

                            </ul>
                        </li>

                        <li class="nav-item pcoded-hasmenu">
                            <a href="#" class="nav-link "><span class="pcoded-micon"><i class="feather icon-settings"></i></span><span class="pcoded-mtext">Matières</span></a>
                            <ul class="pcoded-submenu">
                                <li><a href="{{ route('matiere.index') }}">Liste des matières</a></li>
                                <li><a href="{{ route('matiere.create') }}">Nouvelle matière</a></li>

                            </ul>
                        </li>
                        <li><a href="{{ route('user.index') }}">Utilisateurs</a></li>
                        <li><a href="{{ route('salle.index') }}">Salles</a></li>
                    </ul>
                </li>
                @endcan
            </ul>
        </div>
    </div>
</nav>
