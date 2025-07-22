
<div class="position-fixed top-0 end-0 p-3 z-3">

        @auth
            
            @csrf

          
             
                <button  class="" id="logout" style="color: #0D0D0D;text-decoration: none; ">Cerrar sesión</button>
             
          
     
        @endauth
</nav>
</div>

<script>
 document.addEventListener('DOMContentLoaded', function() {
    const logoutBtn = document.getElementById('logout');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function(e) {
            e.preventDefault();
            localStorage.removeItem('token');
            window.location.href = '/logout';
        });
    }
});
</script>