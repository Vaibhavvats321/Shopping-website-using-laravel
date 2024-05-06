<x-header title="profile" description="Male_Fashion Template" keywords="Male_Fashion, unica, creative, html"/>


    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 mx-auto">
                    <div class="section-title">
                        <h2>My Account</h2>
                    </div>
                    <div class="contact__form">
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
                                    <input type="text" name="fullname" value="{{$user->username}}"  placeholder="Name" required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" name="email" value="{{$user->email}}" placeholder="Email" readonly required>
                                </div>
                                <div class="col-lg-12">
                                    <input type="file" name="file">
                                </div>
                                <div class="col-lg-12">
                                    <input type="text" name="password" value="{{$user->password}}" placeholder="password" required>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" name="register" class="site-btn">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <x-footer />