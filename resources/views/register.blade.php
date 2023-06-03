@extends('master')

@section('content')

    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-10 bg-light p-5 rounded">

            {{-- title --}}
            <div class="row justify-content-center mb-5">
                <div class="col-md-10">
                    <h2 class="text-center">Sign Up</h2>
                </div>
            </div>

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

            {{-- form --}}
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
        
                        <div class="form-group">
                            <label class="mb-1" for="first_name">First Name</label>
                            <input type="text" class="form-control mb-3" id="first_name" name="first_name" placeholder="Enter your first name" required>
                        </div>
        
                        <div class="form-group">
                            <label class="mb-1" for="last_name">Last Name</label>
                            <input type="text" class="form-control mb-3" id="last_name" name="last_name" placeholder="Enter your last name" required>
                        </div>
        
                        <div class="form-group">
                            <label class="mb-1" for="email">Email address</label>
                            <input type="email" class="form-control mb-3" id="email" name="email" placeholder="Enter your email" required>
                        </div>
        
                        <div class="form-group">
                            <label class="mb-1" for="phone">Phone</label>
                            <input type="tel" class="form-control mb-3" id="phone" name="phone" placeholder="Enter your phone number" required>
                        </div>
        
                        <div class="form-group">
                            <label class="mb-1" for="streetnr">Street + Number</label>
                            <input type="text" class="form-control mb-3" id="streetnr" name="streetnr" placeholder="Enter your street and number" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="mb-1" for="postal_code">Postal Code</label>
                            <input type="number" class="form-control mb-3" id="postal_code" name="postal_code" placeholder="Enter your postal code" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="mb-1" for="city">City</label>
                            <input type="text" class="form-control mb-3" id="city" name="city" placeholder="Enter your city" required>
                        </div>
        
                        <div class="form-group">
                            <label class="mb-1" for="country">Country</label>
                            <select class="form-control mb-3" id="country" name="country" required>
                                <option value="Belgium">Belgium</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="Germany">Germany</option>
                                <option value="France">France</option>
                            </select>
                        </div>
        
                        {{-- password --}}
                        <div class="form-group">
                            <label class="mb-1" for="password">Password</label>
                            <input type="password" class="form-control mb-3" id="password" name="password" placeholder="Enter your password" required>
                        </div>
        
                        {{-- password confirmation --}}
                        <div class="form-group">
                            <label class="mb-1" for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control mb-3" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                        </div>
        
                        {{-- recapcha here --}}
        
                        {{-- licence and agreement checkbox --}}
                        <div class="form-group">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="agree_terms" name="agree_terms" required>
                                <label class="form-check-label" for="agree_terms">I agree to the terms and conditions</label>
                            </div>
                        </div>
        
                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection