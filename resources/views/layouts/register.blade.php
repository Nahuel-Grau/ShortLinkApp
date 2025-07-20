@include('components.head')
@include('components.tittle')

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
      <div class="card shadow-sm">
        <div class="card-body bg-white">
          <form id="registerform">
            <div class="mb-3">
              <label for="name" class="form-label text-dark">Nombre</label>
              <input type="text" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label text-dark">Email</label>
              <input type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label text-dark">Contraseña</label>
              <input type="password" class="form-control" id="password" required>
            </div>
            <div class="mb-3">
              <label for="password2" class="form-label text-dark">Confirmar contraseña</label>
              <input type="password" class="form-control" id="password2" required>
            </div>
            <div class="d-flex justify-content-center">
              <button type="submit" class="btn text-white" style="background-color: #0D0D0D">Registrar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@include('components.footer')

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const name = document.getElementById('name');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const password2 = document.getElementById('password2');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

      if (!name||!email || !password || !password2) {
    console.error('Formulario o campos no encontrados');
    return;
  }

document.getElementById('registerform').addEventListener('submit', function(e) {   
   e.preventDefault();
   console.log("llegue aqui")

   const nameInput = name.value; 
    const emailInput = email.value;
    const passwordInput = password.value;
    const password2Input = password2.value;

    fetch('/api/register', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        name: nameInput,
        email: emailInput,
        password: passwordInput,
        password_confirmation: password2Input
      })
    })
    .then(response => {
      if (!response.ok) {
        return response.json().then(err => { throw err });
        
      }
      return response.json();
    }) .then(data => {
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
        credentials: 'include',
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
  
    
  

})})
</script>