@extends("layouts.base")
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
     <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Hellooooo</h1>
     <!-- Button to trigger modal -->
  <button type="button" class="btn btn-info btn-lg" data-bs-toggle="modal" data-bs-target="#customerModal">
    Add <i class="bi bi-plus"></i>
  </button>

  <!-- Modal -->
  <div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form id="cform" method="#" action="#" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="customerModalLabel">Create New Customer</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="email" name="email">
            </div>

            <div class="mb-3">
              <label for="pass" class="form-label">Password</label>
              <input type="password" class="form-control" id="pass" name="password">
            </div>

              <div class="mb-3">
              <input type="hidden" class="form-control" id="status" name="status" value="active">
            </div>

            <div class="mb-3">
              <input type="hidden" class="form-control" id="role" name="role" value="user">
            </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="customerSubmit" type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap 5 JS Bundle (includes Popper) -->
</body>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('js/user.js')}}"></script>
    
</html>