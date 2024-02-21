@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <section class="vh-100" style="background-color: #2779e2;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-9">

                    <h1 class="text-white mb-4 text-center">Dashboard</h1>


                    <div class="card" style="border-radius: 15px;">


                        <div class="row align-items-center py-3">
                            <div class="col-md-4 ">
                                <h4 class="mb-4" style="margin-left: 5px;">
                                    Hello, {{ auth()->user()->name }}
                                </h4>
                            </div>
                            <div class="col-md-6"> </div>

                            <div class="col-md-2">
                                <a href="{{ route('logout') }}" class="btn btn-warning ml-2 mr-2">Logout</a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
