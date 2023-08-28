@extends('layouts.app')

@section('content')
<main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-8 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Add new course</h4>
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
                        Add new Course:
                        <form action="{{ route('courses.store') }}" method="POST" role="form" class="text-start" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            <div class="input-group input-group-outline my-3">
                                <strong>Course Id:</strong>
                                <input type="text" name="course_id" id="course_id" class="form-control" hidden>
                                @error('course_id')
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
                                <strong>Ref name:</strong>
                                <input type="text" name="short_name" id="short_name" class="form-control" required>
                                @error('short_name')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <strong>Number:</strong>
                                <input type="text" name="number" id="number" class="form-control" placeholder="user@example.com">
                                @error('number')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <strong>Description:</strong>
                                <textarea class="form-control" rows="5" name="description" required></textarea>
                                @error('description')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <strong>Duration:</strong>
                                <input type="text" name="duration" id="duration" class="form-control" placeholder="user@example.com" required>
                                @error('duration')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="input-group input-group-outline  my-3">
                              <label for="">Department:</label><br>
                              <select class="form-select" data-placeholder="Select a State..." style="width:50%" name="department_id">
                                    @foreach($departments as $department)
                                    <option value="{{$department->id }}">{{$department->name}}</option>
                                    @endforeach
                               </select>
                               @error('department')
                               <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                               </div>
                               @enderror
                            </div>
                            <br>
                            <div class="input-group input-group-outline my-3">
                              <label for="">Category:</label><br>
                              <select class="form-select" data-placeholder="Select a State..." style="width:50%" name="category_id">
                                    @foreach($categories as $category)
                                    <option value="{{$category->id }}">{{$category->name}}</option>
                                    @endforeach
                               </select>
                               @error('category')
                               <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                               </div>
                               @enderror
                            </div>
                            <br>
                            <div class="justify-content center">
                              <button type="submit" class="btn btn-primary ml-3">Submit</button>
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
@endsection