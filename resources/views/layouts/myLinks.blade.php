@include('components.head')
@include('components.logout')

    <div class="container vh-100" >
        @include('components.tittle')
    

        <table class="table table-dark table-striped">
            <thead>
                <tr style="background-color: #0D0D0D; color: white;">
                    <th scope="col" style="background-color: #0D0D0D;">Link</th>
                    <th scope="col" style="background-color: #0D0D0D;" >ShortLink</th>
                    <th scope="col" style="background-color: #0D0D0D;" >Clicks</th>
                    <th scope="col" style="background-color: #0D0D0D;"></th>
                </tr>

            </thead>
            <tbody>
                <tr>
                <th scope="row" id="link"></th>
                <td id="shortLink"></td>
                <td id="clicks"></td>
                
                
                </tr>
        </table>
@include('components.footer')
        
<script>
  document.addEventListener('DOMContentLoaded', function () {
   
    const token = localStorage.getItem('token');
    const tbody = document.querySelector('tbody');


    fetch('/api/shortlinks', {
        method: 'GET',
          headers: {
          'Content-Type': 'application/json',
          ...(token ? { 'Authorization': 'Bearer ' + token } : {})

      }
        }).then(response => {
    if (!response.ok) {
        throw new Error('Fallo al obtener datos');
    }
    return response.json();
    })
    .then(data => {
    console.log('✅ Datos:', data);
    const tbody = document.querySelector('tbody');
    tbody.innerHTML = ''; // Limpia la tabla

    data.forEach(link => {
        tbody.innerHTML += `
            <tr>
                <th scope="row">${link.link}</th>
                <td>${link.shortLink}</td>
                <td>${link.clicks}</td>
                <td><button type="button" class="btn btn-danger" id="${link.id}">eliminar</button></td>
            </tr>
        `;
    });
})
    .catch(error => {
    console.error('❌ Error:', error);
    });
  
 
    tbody.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('btn-danger')) {
            const linkId = link.id
            fetch('/api/shortlinks/delete/' + linkId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    ...(token ? { 'Authorization': 'Bearer ' + token } : {})
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Error al eliminar');
                // Elimina la fila de la tabla
                e.target.closest('tr').remove();
            })
            .catch(error => {
                console.error('❌ Error al eliminar:', error);
            });
        }
    });

   })    

</script>

   