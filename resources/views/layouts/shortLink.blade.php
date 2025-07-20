@include('components.head')
@include('components.tittle')
@include('components.logout')




 @include('components.head')
@include('components.logout')

<!-- Primera tarjeta: Formulario -->
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <form id="shortenForm" action="/shortener">
            <div class="mb-3">
              <label for="Link" class="form-label text-dark">Enlace aquí</label>
              <input type="text" class="form-control" id="Link" placeholder="https://...">
              <div class="form-text text-dark">
                Si no estás logueado, el shortlink se borrará en las próximas 24 horas
              </div>
            </div>
            <div class="d-flex justify-content-center">
              <button type="submit" class="btn text-white" style="background-color: #0D0D0D">
                ACORTAR
              </button>
            </div>
          </form>
          <h4 class="text-center mt-4" id="result"></h4>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Segunda tarjeta: Botones de login/register o "Mis ShortLinks" -->
<div class="container my-4">
  <div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
      <div class="card shadow-sm">
        <div class="card-body d-flex flex-column align-items-center">
          @guest
            <button type="button" class="btn btn-lg mb-3 w-75 text-white" id="login" style="background-color: #0D0D0D">Iniciar Sesión</button>
            <button type="button" class="btn btn-lg w-75 text-white" id="register" style="background-color: #0D0D0D">Registrarse</button>
          @endguest

          @auth
            <h5 class="text-dark text-center mb-3">¿Quieres ver tus ShortLinks?</h5>
            <button type="button" class="btn btn-lg w-75 text-white" id="myShortLinks" style="background-color: #0D0D0D">Mis ShortLinks</button>
          @endauth
        </div>
      </div>
    </div>
  </div>
</div>

@include('components.footer')
<script>
document.getElementById('shortenForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const linkInput = document.getElementById('Link').value;
    const token = localStorage.getItem('token');

    fetch('/api/shortlinks', {
        method: 'POST',
          headers: {
          'Content-Type': 'application/json',
          ...(token ? { 'Authorization': 'Bearer ' + token } : {})
          
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
        document.getElementById('result').innerHTML = 'ShortLink: <a href="' + data.short_link + '" target="_blank">' + data.short_link + '</a>';
    })
    .catch(error => {
        let message = 'Error al generar el shortlink.';
        if (error.messages && error.messages.link) {
            message = 'Error: ' + error.messages.link[0];
        }
        document.getElementById('result').textContent = message;
    });

   
});

 const loginBtn = document.getElementById('login');
    if (loginBtn) {
        loginBtn.addEventListener('click', function () {
            window.location.href = '/login';
        });
    }
const registerBtn = document.getElementById('register');
    if (registerBtn) {
        registerBtn.addEventListener('click', function () {
            window.location.href = '/register';
        });
}
const myLinksBtn = document.getElementById('myShortLinks');
    if (myLinksBtn) {
        myLinksBtn.addEventListener('click', function () {
            window.location.href = '/myLinks';
        });
}
</script>
   
