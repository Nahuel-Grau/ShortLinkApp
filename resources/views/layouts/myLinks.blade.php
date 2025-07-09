@include('components.head')
@include('components.logout')

    <div class="container vh-100" >
        <h1 class="display-1 d-flex justify-content-center my-5 py-5" style="color: #0D0D0D">My shortLinks</h1>
    

        <table class="table table-dark table-striped">
            <thead>
                <tr style="background-color: #0D0D0D; color: white;">
                    <th scope="col" style="background-color: #0D0D0D;">Link</th>
                    <th scope="col" style="background-color: #0D0D0D;">ShortLink</th>
                    <th scope="col" style="background-color: #0D0D0D;"></th>
                </tr>

            </thead>
            <tbody>
                <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td><button type="button" class="btn btn-danger">eliminar</button></td>
                
                </tr>
        </table>
@include('components.footer')
        
    

   