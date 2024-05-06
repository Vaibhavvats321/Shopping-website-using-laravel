<x-admin-header title="Profile"/>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 col-md-6 col-lg-4 mx-auto grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <p class="card-title mb-2 text-center">Admin Profile</p>
                    @if(session()->has('success'))
                            <div class="alert alert-success">
                                <p>{{ session()->get('success')}}</p>
                            </div>
                        @endif
                        <img src="{{ URL::to('Uploads/profiles/'.$user->picture)}}" class="mx-auto d-block mb-3 rounded-circle shadow-4-strong" width="200px" alt="">
                        <form action="{{ URL::to('updateUser') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="fullname" value="{{$user->username}}" class="form-control mb-2"  placeholder="Name" required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" name="email" value="{{$user->email}}" class="form-control mb-2" placeholder="Email" readonly required>
                                </div>
                                <div class="col-lg-12">
                                    <input type="file" class="form-control mb-2" name="file">
                                </div>
                                <div class="col-lg-12">
                                    <input type="text" name="password" value="{{$user->password}}" class="form-control mb-2" placeholder="password" required>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" name="register" class="site-btn btn btn-success">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    
                </div>
              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->
 <x-admin-footer />