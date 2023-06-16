@extends('master')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-light p-5 rounded">

            {{-- title --}}
            <div class="row justify-content-center mb-5">
                <div class="col-md-10">
                    <h2 class="text-center text-primary fw-bold">Edit Profile & Data</h2>
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
                    <form action="{{ route('user.updateProfile') }}" method="POST" enctype="multipart/form-data" class="p-3 border rounded">
                        @csrf
                        <div class="form-group">
                            <label class="mb-1 fw-bold text-primary" for="first_name">First Name</label>
                            <input type="text" class="form-control mb-3" id="first_name" name="first_name" placeholder="Enter your first name" value="{{ old('first_name') }}" required>
                        </div>
        
                        <div class="form-group">
                            <label class="mb-1 fw-bold text-primary" for="last_name">Last Name</label>
                            <input type="text" class="form-control mb-3" id="last_name" name="last_name" placeholder="Enter your last name" value="{{ old('last_name') }}" required>
                        </div>

                        <div class="form-group">
                            <label class="mb-1 fw-bold text-primary" for="name">Username</label>
                            <input type="text" class="form-control mb-3" id="name" name="name" placeholder="Enter your username" value="{{ old('name') }}" required>
        
                        <div class="form-group">
                            <label class="mb-1 fw-bold text-primary" for="email">Email address</label>
                            <input type="email" class="form-control mb-3" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
                        </div>
        
                        <div class="form-group">
                            <label class="mb-1 fw-bold text-primary" for="phone">Phone</label>
                            <input type="tel" class="form-control mb-3" id="phone" name="phone" placeholder="Enter your phone number" value="{{ old('phone') }}" required>
                        </div>
        
                        <div class="form-group">
                            <label class="mb-1 fw-bold text-primary" for="street_nr">Street + Number</label>
                            <input type="text" class="form-control mb-3" id="street_nr" name="street_nr" placeholder="Enter your street and number" value="{{ old('street_nr') }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="mb-1 fw-bold text-primary" for="postal_code">Postal Code</label>
                            <input type="number" class="form-control mb-3" id="postal_code" name="postal_code" placeholder="Enter your postal code" value="{{ old('postal_code') }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="mb-1 fw-bold text-primary" for="city">City</label>
                            <input type="text" class="form-control mb-3" id="city" name="city" placeholder="Enter your city" value="{{ old('city') }}" required>
                        </div>
        
                        <div class="form-group">
                            <label class="mb-1 fw-bold text-primary" for="country">Country</label>
                            <select class="form-control mb-3" id="country" name="country" required>
                                <option value="Belgium" @if(old('country') == 'Belgium') selected @endif>Belgium</option>
                                <option value="Netherlands" @if(old('country') == 'Netherlands') selected @endif>Netherlands</option>
                                <option value="Germany" @if(old('country') == 'Germany') selected @endif>Germany</option>
                                <option value="France" @if(old('country') == 'France') selected @endif>France</option>
                            </select>
                        </div>

                        {{-- profile picture --}}
                        <div class="form-group">
                            <label class="mb-1 fw-bold text-primary" for="profile_picture">Profile Picture</label><br>
                            <input class="form-control mb-3" type="file" name="profile_picture" id="profile_picture">
                        </div>
                                                                
                        {{-- recapcha here --}}
        
                        {{-- licence and agreement checkbox --}}
                        <div class="form-group">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="agree_terms" name="agree_terms" @if(old('agree_terms')) checked @endif required>
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