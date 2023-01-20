@extends('user.layouts.template')
@section("content")
    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content d-md-flex justify-content-between align-items-center">
                    <div class="mb-3 mb-md-0">
                        <h2>Welcome</h2>
                        <p>Register to continue</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!-- ================ contact section start ================= -->
    <section class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Login</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <form method="post" action="{{route('post-login')}}" id="submitForm" data-parsley-validate class="form-horizontal form-label-left">
                       @csrf
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="item form-group">
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="email"  name="email" placeholder="Email" required class="form-control">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="password" name="password"
                                                class="form-control" placeholder="Password" required >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">Login and start shopping</button>
                                <p>Doesn't have an account? <a href="{{route('register.page')}}">Click to register</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->


@endsection
