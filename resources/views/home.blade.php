@extends('master')

@section('content')

    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-10  bg-light p-5 rounded">
            <h1 class="text-center mb-5">Hello, motherfuckers!</h1>

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

            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nesciunt explicabo nihil libero dolor sit architecto quam tenetur temporibus debitis iusto nam assumenda facilis impedit voluptas, dolorum illo quibusdam magnam officia?</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nesciunt explicabo nihil libero dolor sit architecto quam tenetur temporibus debitis iusto nam assumenda facilis impedit voluptas, dolorum illo quibusdam magnam officia?</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nesciunt explicabo nihil libero dolor sit architecto quam tenetur temporibus debitis iusto nam assumenda facilis impedit voluptas, dolorum illo quibusdam magnam officia?</p>
        
        </div>
    </div>

@endsection
