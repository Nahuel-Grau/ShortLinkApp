@include('components.head')

@include('components.tittle')

<div class="d-flex justify-content-center align-items-center vh-60 ">
  <div class="card w-60 h-20" style="background-color: white">
    <div class="card-body" style="width: 35vw; height: 25vh; background-color: white">          
      
        <form  id="form" >
          @csrf
            <div class="mb-3">
                
                <label for="exampleInputEmail1" class="form-label" style="color: #0D0D0D">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
               
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label" style="color: #0D0D0D">Password</label>
                <input type="password" class="form-control" id="password">
            </div>
            <div class="d-flex justify-content-center">
            <button type="submit" class="btn text-white  " style="background-color: #0D0D0D">Ingresar</button>
            </div>
        </form>
            </div>
        </div>
    </div>

         @include('components.footer')
    </div>


<script>
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('form');
  const emailField = document.getElementById('email');
  const passwordField = document.getElementById('password');
  const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

  if (!form || !emailField || !passwordField) {
    console.error('Formulario o campos no encontrados');
    return;
  }

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    const emailInput = emailField.value;
    const passwordInput = passwordField.value;

    fetch('/api/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      credentials: 'include',
      body: JSON.stringify({
        email: emailInput,
        password: passwordInput
      })
    })
    .then(response => {
      if (!response.ok) {
        return response.json().then(err => { throw err });
      }
      return response.json();
    })
    .then(data => {
      if (!data.token) {
        throw new Error('No se recibió token');
      }
      if (!data.user || !data.user.id) {
        throw new Error('No se recibió información de usuario');
      }

      localStorage.setItem('token', data.token);

      return fetch('/sync-session', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        credentials: 'same-origin',
        body: JSON.stringify({ user_id: data.user.id })
      });
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Falló la sincronización de sesión');
      }
      return response.json();
    })
    .then(() => {
      console.log('✅ Sesión web sincronizada');
      window.location.href = '/'; 
    })
    .catch(error => {
      console.error('Error en login:', error);
    });
  });
});
</script>