@extends('master')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-light p-5 rounded">

            {{-- title --}}
            <div class="row justify-content-center mb-5">
                <div class="col-md-10">
                    <h2 class="text-center text-primary fw-bold">Reset Password</h2>
                </div>
            </div>

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
                    <form action="{{ route('password.update') }}" method="POST" class="p-3 border rounded">
                        @csrf
                        
                        <!-- Token -->
                        <input type="hidden" name="token" value="{{ $token }}">

                        <!-- Password -->
                        <div class="form-group mb-3">
                            <label for="password" class="mb-1 fw-bold text-primary">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group mb-3">
                            <label for="password_confirmation" class="mb-1 fw-bold text-primary">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        </div>
                        
                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                    </form>
                </div>
            </div>
                                
        </div>
    </div>

@endsection