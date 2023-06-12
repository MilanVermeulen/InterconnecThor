@extends('master')

@section('content')
    <div class="row justify-content-center mb-5">
        <div class="col-md-10 p-5 rounded bg-light">
            <h1 class="text-center mb-5">Your profile</h1>
            <h2 class="text-center mb-5">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
            <h3 class="text-center mb-5">{{ Auth::user()->email }}</h3>
            @if (Auth::user()->profile_picture)
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <img src="{{ asset('storage/profile-pictures' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="img-fluid rounded-pill mb-2 border border-light border-2 me-2 mt-1" style="max-height: 50vh; width: auto;">
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
