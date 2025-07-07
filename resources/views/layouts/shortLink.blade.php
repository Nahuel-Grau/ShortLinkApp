@include('components.head')
 

 
   

    <div class="d-flex justify-content-center align-items-center vh-60">
    <div class="card w-60 h-20"  style="background-color: white">
        <div class="card-body" style="width: 30vw; height: 20vh;">          
            <form>
              <div class="mb-3 ">
                <label for="exampleInputEmail1" class="form-label" style="color: #0D0D0D">Enlace aquí</label>
                <input type="text" class="form-control" id="Link" aria-describedby="emailHelp">
                <div id="ShortLink Help" class="form-text" style="color: #0D0D0D">Si no estás logueado el shortlink se borrará en las próximas 24 horas</div>
              </div>
             <div class="d-flex justify-content-center">
                <button type="submit" class="btn text-white " style="background-color: #0D0D0D">ACORTAR</button>
              </div>

            </form>
        </div>
    </div>

    </div>
   <div class="d-flex justify-content-center align-items-center vh-60" style="margin:2vh">
    <div class="card w-60 h-20" style="background-color: white">
      <div class="card-body d-flex flex-column justify-content-center align-items-center" style="width: 30vw; height: 20vh;">
        <button type="button" class="btn btn-lg mb-3 w-50 text-white" style="background-color: #0D0D0D">Iniciar Sesión</button>
        <button type="button" class="btn btn-lg w-50 text-white" style="background-color: #0D0D0D">Registrarse</button>
      </div>
    </div>
  </div>
    </div>
    
    @include('components.footer')
        
    

   


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  </body>
</html>