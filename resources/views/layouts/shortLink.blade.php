@include('components.head')
 

 <body class="p-3 mb-2 bg-light text-dark">
    <div class="container vh-100" >
     <h1 class="display-1 d-flex justify-content-center my-5 py-5">ShortLink</h1>

    <div class="d-flex justify-content-center align-items-center vh-60 ">
    <div class="card w-60 h-20">
        <div class="card-body" style="width: 30vw; height: 20vh;">          
            <form>
              <div class="mb-3 ">
                <label for="exampleInputEmail1" class="form-label">Enlace aqui</label>
                <input type="text" class="form-control" id="Link" aria-describedby="emailHelp">
                <div id="ShortLink Help" class="form-text ">Si no estás logueado el shortlink se borrara en las proximas 24 horas</div>
              </div>
             <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">ACORTAR</button>
              </div>

            </form>
        </div>
    </div>

    </div>
   <div class="d-flex justify-content-center align-items-center vh-60" style="margin:2vh">
    <div class="card w-60 h-20">
      <div class="card-body d-flex flex-column justify-content-center align-items-center" style="width: 30vw; height: 20vh;">
        <button type="button" class="btn btn-primary btn-lg mb-3 w-50">Iniciar Sesión</button>
        <button type="button" class="btn btn-primary btn-lg w-50">Registrarse</button>
      </div>
    </div>
  </div>
    </div>
    
    @include('components.footer')
        
    

   


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  </body>
</html>