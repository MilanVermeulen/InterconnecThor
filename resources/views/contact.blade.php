@extends('master')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-light p-5 rounded">

            {{-- title --}}
            <div class="row justify-content-center mb-5">
                <div class="col-md-10">
                    <h2 class="text-center">Contact Us</h2>
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
                    <form action="/contactemail" method="post">
                        @csrf
        
                        <div class="form-group">
                            <label class="mb-1" for="first_name">First Name</label>
                            <input type="text" class="form-control mb-3" id="first_name" name="first_name" placeholder="Enter your first name" value="{{ old('first_name') }}" required>
                        </div>
        
                        <div class="form-group">
                            <label class="mb-1" for="last_name">Last Name</label>
                            <input type="text" class="form-control mb-3" id="last_name" name="last_name" placeholder="Enter your last name" value="{{ old('last_name') }}" required>
                        </div>
        
                        <div class="form-group">
                            <label class="mb-1" for="email">Email address</label>
                            <input type="email" class="form-control mb-3" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
                        </div>

                        <div class="form-group">
                            <label class="mb-1" for="subject">Subject</label>
                            <input type="text" class="form-control mb-3" id="subject" name="subject" placeholder="Enter your subject" value="{{ old('subject') }}" required>
                        </div>

                        <div class="form-group">
                            <label class="mb-1" for="message">Message</label>
                            <textarea class="form-control mb-3" id="message" name="message" placeholder="Enter your message" rows="5" required>{{ old('message') }}</textarea>
                        </div>
                
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