@extends('layouts.app')

@section('content')


<main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Add new department</h4>
                </div>
              </div>
              @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
              <div class="card-body">
                    <div class="container fluid">
                        Add new staff:
                        <form action="{{ route('staff.store') }}" method="POST" role="form" class="text-start" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            <div class="input-group input-group-outline my-3">
                                <strong>Staff id:</strong>
                                <input type="text" name="staff" id="staff" class="form-control" required>
                                @error('staff')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <strong>Photo:</strong>
                                <input type="file" name="photo" id="photo" class="form-control" required>
                                @error('photo')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <strong>Name:</strong>
                                <input type="text" name="name" id="name" class="form-control" required>
                                @error('name')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <strong>Email:</strong>
                                <input type="email" name="email" id="email" class="form-control" required>
                                @error('email')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <strong>Phone number:</strong>
                                <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="user@example.com" required>
                                @error('phone_number')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <strong>Address:</strong>
                                <input type="address" name="address" id="address" class="form-control" placeholder="user@example.com" required>
                                @error('address')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="dropdown-group">
                              <!-- Department Dropdown -->
                              <strong>Department:</strong> 
                              <select id='sel_depart' name='sel_depart'>
                                <option value='0'>-- Select department --</option>
                                <!-- Read Departments -->
                                @foreach($departmentData['data'] as $department)
                                <option value='{{ $department->id }}'>{{ $department->name }}</option>
                                @endforeach
                              </select>
                              <br><br>
                              <!-- Department Employees Dropdown -->
                              <strong>Role:</strong> 
                              <select id='sel_emp' name='sel_emp'>
                                <option value='0'>-- Select Employee --</option>
                                @foreach($roles as $role)
                                <option value='{{ $role->id }}'>{{$role->name}}</option>
                                @endforeach
                              </select><br><br><br>                     
                            </div>
                            <div class="justify-content center">
                              <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Submit</button>
                            </div>
                          </div>
                       </form>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer position-absolute bottom-2 py-2 w-100">
        <div class="container">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-12 col-md-6 my-auto">
              <div class="copyright text-center text-sm text-white text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart" aria-hidden="true"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold text-white" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
            <div class="col-12 col-md-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-white" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-white" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-white" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-white" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <!-- Script -->
  <script type='text/javascript'>

$(document).ready(function(){

  // Department Change
  $('#sel_depart').change(function(){

     // Department id
     var id = $(this).val();

     // Empty the dropdown
     $('#sel_emp').find('option').not(':first').remove();

     // AJAX request 
     $.ajax({
       url: 'getEmployees/'+id,
       type: 'get',
       dataType: 'json',
       success: function(response){

         var len = 0;
         if(response['data'] != null){
           len = response['data'].length;
         }

         if(len > 0){
           // Read data and create <option >
           for(var i=0; i<len; i++){

             var id = response['data'][i].id;
             var name = response['data'][i].name;

             var option = "<option value='"+id+"'>"+name+"</option>"; 

             $("#sel_emp").append(option); 
           }
         }

       }
    });
  });

});

</script>
@endsection