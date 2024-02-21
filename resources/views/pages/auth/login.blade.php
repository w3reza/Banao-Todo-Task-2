@extends('layouts.app')
@section('title','Login Page')
@section('content')
<section class="vh-100" style="background-color: #2779e2;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-9">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

                <h1 class="text-white mb-4 text-center">Login Page</h1>

                <div class="card" style="border-radius: 15px;">

                    <form action="{{ route('login.check') }}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="card-body">


                        <hr class="mx-n3">

                        <div class="row align-items-center py-3">
                            <div class="col-md-3 ps-5">

                                <h6 class="mb-0">Email Address</h6>

                            </div>
                            <div class="col-md-9 pe-5">
                                <input type="email" name="email"
                                    class="form-control form-control-lg  @if ($errors->has('email')) is-invalid @elseif(old('email')) is-valid @endif"
                                    placeholder="Email Address" value="{{ old('email') }}" />
                                @error('email')
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <hr class="mx-n3">



                        <div class="row align-items-center py-3">
                            <div class="col-md-3 ps-5">

                                <h6 class="mb-0">Password</h6>

                            </div>
                            <div class="col-md-9 pe-5">
                                <input type="password" name="password"
                                    class="form-control form-control-lg  @if ($errors->has('password')) is-invalid @elseif(old('password')) is-valid @endif"
                                    placeholder="Enter Password" value="" />
                                @error('password')
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>





                        <div class="px-5 py-4  text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Login</button>
                        </div>
                        <div class="text-center">
                            <p>Don't have an account? <a href="{{ route('register.create') }}">Register here</a>.</p>
                        </div>

                    </div>
                </form>
                </div>

            </div>
        </div>
    </div>
</section>



    @endsection

