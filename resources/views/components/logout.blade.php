
<div class="position-fixed top-0 end-0 p-3 z-3">

        @auth
            
            @csrf

          
             
                <a  class="" id="logout" style="color: #0D0D0D;text-decoration: none; ">Cerrar sesión</a>
             
          
     
        @endauth
</nav>
</div>

<script>
const logoutBtn = document.getElementById('logout');
if (logoutBtn) {
    logoutBtn.addEventListener('click', function () {
        localStorage.removeItem('token');
         window.location.href = '/logout';
    });
}
</script>