@include('components.head')
@include('components.tittle')

   
     <div class="d-flex justify-content-center align-items-center vh-60 ">
        <div class="card w-60 h-20" style="background-color: white">
            <div class="card-body" style="width: 35vw; height: 40vh; background-color: white">          
            
        <form>
            <div class="mb-3">                
                <label for="exampleInputEmail1" class="form-label" style="color: #0D0D0D">Nombre </label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">               
            </div>
            <div class="mb-3">                
                <label for="exampleInputEmail1" class="form-label" style="color: #0D0D0D">Email </label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">               
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label" style="color: #0D0D0D">Contraseña</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label" style="color: #0D0D0D">Confirmar contraseña</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="d-flex justify-content-center">
            <button type="submit" class="btn text-white  " style="background-color: #0D0D0D">Registrar</button>
            </div>
        </form>
            </div>
        </div>
    </div>

         @include('components.footer')
    </div>


