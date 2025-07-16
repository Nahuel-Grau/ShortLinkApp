
<div class="position-fixed top-0 end-0 p-3 z-3">

        @auth
            
            @csrf

            <ul class="nav nav-underline">
              <li class="nav-item" >
                <a  class="nav-link" id="logout" style="color: #0D0D0D">Cerrar sesión</a>
              </li>
            </ul>
     
        @endauth
</nav>
</div>

<script>
const logoutBtn = document.getElementById('logout');
if (logoutBtn) {
    logoutBtn.addEventListener('click', function () {
        localStorage.removeItem('token');
        // Redirige o recarga la página si lo necesitas
        window.location.href = '/logout';
    });
}
</script>