@include('components.head')
@include('components.tittle')
@include('components.logout')

 <div class="d-flex justify-content-center align-items-center vh-60" style="margin:2vh">
    <div class="card w-60 h-20" style="background-color: white">
      <div class="card-body d-flex flex-column justify-content-center align-items-center" style="width: 30vw; height: 20vh;">
        
        
        <h3>shortLink:  </h3>
        
    </div>
</div>
</div>
@auth
  <div class="d-flex justify-content-center align-items-center vh-60">
  <div class="d-flex flex-column align-items-center">
    <div class="text" style="color: #0D0D0D">
      <h3>¿Quieres ver tus ShortLinks?</h3>
    </div>
    <button type="button" class="btn btn-lg mb-3 w-50 text-white" style="background-color: #0D0D0D">
      Mis ShortLinks
    </button>
  </div>
</div>
  
@endauth



        

@include('components.footer')
        
    

   
