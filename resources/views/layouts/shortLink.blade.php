@include('components.head')
@include('components.tittle')
@include('components.logout')




    <div class="d-flex justify-content-center align-items-center vh-6">
    <div class="card w-60 h-25"  style="background-color: white">
      
        <div class="card-body" style="width: 30vw; height: 22vh;">          
            <form id="shortenForm" action="/shortener">
              <div class="mb-3 ">
                <label for="exampleInputEmail1" class="form-label" style="color: #0D0D0D">Enlace aquí</label>
                <input type="text" class="form-control" id="Link">
                <div id="ShortLink Help" class="form-text" style="color: #0D0D0D">Si no estás logueado el shortlink se borrará en las próximas 24 horas</div>
              </div>
             <div class="d-flex justify-content-center">
                <button type="submit" class="btn text-white " style="background-color: #0D0D0D">ACORTAR</button>
              </div>
            </form>
             <h4 class="d-flex justify-content-center" id="result" style="margin: 15px">
                
              </h4>
            
        </div>
    </div>
    </div>
   <div class="d-flex justify-content-center align-items-center vh-60" style="margin:2vh">
    <div class="card w-60 h-20" style="background-color: white">
      <div class="card-body d-flex flex-column justify-content-center align-items-center" style="width: 30vw; height: 20vh;">
        @guest
          <button type="button" class="btn btn-lg mb-3 w-50 text-white" id="login" style="background-color: #0D0D0D">Iniciar Sesión</button>
          <button type="button" class="btn btn-lg w-50 text-white" id="register" style="background-color: #0D0D0D">Registrarse</button>
        @endguest

        @auth
           <div class="text" style="color: #0D0D0D"><h3>Quieres ver tus ShortLinks?</h3> </div>
           <button type="button" class="btn btn-lg mb-3 w-50 text-white" style="background-color: #0D0D0D">Mis ShortLinks</button>
        @endauth
        
      </div>
    </div>
  </div>
    </div>
    
    @include('components.footer')
        
    
<script>
document.getElementById('shortenForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const linkInput = document.getElementById('Link').value;

  fetch('/api/shortlinks', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      link: linkInput
    })
  })
  .then(response => {
    if (!response.ok) {
      return response.json().then(err => { throw err });
    }
    return response.json();
  })
  .then(data => {
    document.getElementById('result').textContent = 'ShortLink: ' + data.short_link;
  })
  .catch(error => {
    let message = 'Error al generar el shortlink.';
    if (error.messages && error.messages.link) {
      message = 'Error: ' + error.messages.link[0];
    }
    document.getElementById('result').textContent = message;
  });
});

document.getElementById('login').addEventListener('click', function () {
    window.location.href = '/login';
  });
document.getElementById('register').addEventListener('click', function () {
    window.location.href = '/register';
  });
</script>
   
