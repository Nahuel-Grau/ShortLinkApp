@include('components.head')
@include('components.tittle')

   
     <div class="d-flex justify-content-center align-items-center vh-60 ">
        <div class="card w-60 h-20" style="background-color: white">
            <div class="card-body" style="width: 35vw; height: 40vh; background-color: white">          
            
        <form id="registerform">
       
            <div class="mb-3">                
                <label for="exampleInputEmail1" class="form-label" style="color: #0D0D0D">Nombre </label>
                <input type="text" class="form-control" id="name" aria-describedby="emailHelp">               
            </div>
            <div class="mb-3">                
                <label for="exampleInputEmail1" class="form-label" style="color: #0D0D0D">Email </label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp">               
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label" style="color: #0D0D0D">Contraseña</label>
                <input type="password" class="form-control" id="password">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label" style="color: #0D0D0D">Confirmar contraseña</label>
                <input type="password" class="form-control" id="password2">
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