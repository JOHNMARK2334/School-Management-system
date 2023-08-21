@extends('layouts.app')

@section('content')


<div class="main-content  mt-0">
<hr class="horizontal light mt-0 mb-2">
   <aside>
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
      <li class="nav-item">
            <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Home</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{ route('pages.dashboard') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
            <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Elements</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{ route('departments.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Departments</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{ route('courses.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">feed</i>
            </div>
            <span class="nav-link-text ms-1">Courses</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{ route('staff.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Staff</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{ route('students.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">group</i>
            </div>
            <span class="nav-link-text ms-1">Students</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{ route('roles.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">view_list</i>
            </div>
            <span class="nav-link-text ms-1">Roles</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{ route('units.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">format_list_bulleted</i>
            </div>
            <span class="nav-link-text ms-1">Units</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{ route('pages.billing') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Billing</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="../pages/notifications.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">notifications</i>
            </div>
            <span class="nav-link-text ms-1">Notifications</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="../pages/profile.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{ route('auth.login') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">login</i>
            </div>
            <span class="nav-link-text ms-1">Sign In</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{ route('auth.register')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">assignment</i>
            </div>
            <span class="nav-link-text ms-1">Sign Up</span>
          </a>
        </li>
      </ul>
    </div>
    </aside>
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-9 col-md-12 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Edit Student details</h4>
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
                        Edit student details:
                        <form action="{{ route('courses.update') }}" method="POST" role="form" class="text-start" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                            <input type="text" name="id" id="id" class="form-control" value="{{$courses->id}}" hidden>
                            <div class="input-group input-group-outline my-3">
                                <strong>Name:</strong>
                                <input type="text" name="name" id="name" class="form-control" value="{{$courses->name}}" required>
                                @error('name')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <strong>Short name:</strong>
                                <input type="text" name="short_name" id="short_name" class="form-control" value="{{$courses->short_name}}"required>
                                @error('short_name')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <strong>Number:</strong>
                                <input type="number" name="number" id="number" class="form-control" value="{{$courses->number}}" required>
                                @error('number')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <strong>Duration:</strong>
                                <input type="text" name="duration" id="duration" class="form-control" value="{{$courses->duration}}" required>
                                @error('duration')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <strong>Description:</strong>
                                <input type="text" name="description" id="description" class="form-control" value="{{$courses->description}}" required></textarea>
                                @error('description')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="input-group">
                              <strong>Department</strong>
                              <select class="form-select" data-placeholder="Select a course.." style="width:50%" name="department_id" value="{{\App\Models\Department::query()->where('id',$courses->department_id)->first()->name}}">
                                    @foreach($departments as $department)
                                    <option value="{{$department->id }}">{{$department->name}}</option>
                                    @endforeach
                               </select>
                               @error('course')
                               <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                               </div>
                               @enderror
                            </div>
                            <div class="input-group">
                              <strong>Category</strong>
                              <select class="form-select" data-placeholder="Select a course.." style="width:50%" name="category_id" value="{{\App\Models\Category::query()->where('id',$courses->category_id)->first()->name}}">
                                    @foreach($categories as $category)
                                    <option value="{{$category->id }}">{{$category->name}}</option>
                                    @endforeach
                               </select>
                               @error('course')
                               <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                               </div>
                               @enderror
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
@endsection