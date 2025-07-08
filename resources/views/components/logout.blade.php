
<div class="position-fixed top-0 end-0 p-3 z-3">

    @auth
        
   
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn text-white  " style="background-color: #0D0D0D">
                Cerrar sesión
            </button>
        </form>
     @endauth
</nav>
</div>