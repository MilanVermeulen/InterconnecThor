@extends('master')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-light p-5 rounded">

            {{-- title --}}
            <div class="row justify-content-center mb-5">
                <div class="col-md-10">
                    <h2 class="text-center text-primary fw-bold">Log In</h2>
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

            {{-- validation errors (IMPORTANT:ONLY APPROVED USERS CAN LOG IN) --}}
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

            {{-- form --}}
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <form action="{{ route('login') }}" method="POST" class="p-3 border rounded">
                        @csrf
            
                        <div class="form-group mb-3">
                            <label for="identifier" class="mb-1 fw-bold text-primary">Email or Username</label>
                            <input type="text" name="identifier" class="form-control" id="identifier" placeholder="Enter your email or username" required>
                        </div>
            
                        <div class="form-group mb-3">
                            <label for="password" class="mb-1 fw-bold text-primary">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter a password" required>
                        </div>
                        
                        <button type="submit" class="btn btn-outline-primary">Submit</button>

                        <a href="/forgot-password" class="text-decoration-none text-primary fp-hover">Forgot password?</a>
                    </form>
            
                </div>
            </div>            
                                
        </div>
    </div>

@endsection