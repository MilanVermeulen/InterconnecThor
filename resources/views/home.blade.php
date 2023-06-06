@extends('master')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-light p-5 rounded">

            {{-- welcome message --}}
            <div class="row justify-content-center mb-5">
                <div class="col-md-10">
                    @if (Auth::guard('student')->check())
                        <h2 class="text-center"><span class="text-custom fw-bold">{{ Auth::guard('student')->user()->first_name }} {{ Auth::guard('student')->user()->last_name }}</span>, you are the most <span class="text-custom fw-bold">talented</span>, most <span class="text-custom fw-bold">interesting</span>, and most <span class="text-custom fw-bold">extraordinary</span> person in the universe.</h2>
                    @else
                        <h2 class="text-center">Welcome, log in or sign up!</h2>
                    @endif
                </div>
            </div>

            {{-- succes message --}}
            @if (session('success'))
                <div class="row justify-content-center mb-5">
                    <div class="col-md-10">
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
            @endif

            {{-- validation errors --}}
            @if ($errors->any())
                <div class="row justify-content-center mb-5">
                    <div class="col-md-10">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nesciunt explicabo nihil libero dolor sit architecto quam tenetur temporibus debitis iusto nam assumenda facilis impedit voluptas, dolorum illo quibusdam magnam officia?</p>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nesciunt explicabo nihil libero dolor sit architecto quam tenetur temporibus debitis iusto nam assumenda facilis impedit voluptas, dolorum illo quibusdam magnam officia?</p>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nesciunt explicabo nihil libero dolor sit architecto quam tenetur temporibus debitis iusto nam assumenda facilis impedit voluptas, dolorum illo quibusdam magnam officia?</p>        
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nesciunt explicabo nihil libero dolor sit architecto quam tenetur temporibus debitis iusto nam assumenda facilis impedit voluptas, dolorum illo quibusdam magnam officia?</p>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nesciunt explicabo nihil libero dolor sit architecto quam tenetur temporibus debitis iusto nam assumenda facilis impedit voluptas, dolorum illo quibusdam magnam officia?</p>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nesciunt explicabo nihil libero dolor sit architecto quam tenetur temporibus debitis iusto nam assumenda facilis impedit voluptas, dolorum illo quibusdam magnam officia?</p>        
                </div>
            </div>
        
        </div>
    </div>

@endsection