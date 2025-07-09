
<div class="position-fixed top-0 end-0 p-3 z-3">

        @auth
            
            @csrf

            <ul class="nav nav-underline">
              <li class="nav-item" method="POST" action="{{ route('logout') }}" >
                <a class="nav-link" href="#" style="color: #0D0D0D">Cerrar sesión</a>
              </li>
            </ul>
     
        @endauth
</nav>
</div>