@extends('master')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-10 p-5 bg-light rounded">

            {{-- Title --}}
            <div class="row justify-content-center mb-5">
                <div class="col-md-10">
                    <h2 class="text-center text-primary fw-bold">Connections</h2>
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
                @foreach($connections as $user)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 d-flex flex-column">
                            <div class="card-header bg-primary text-light text-shadow">
                                <div class="row">
                                    <div class="col">
                                        <h4 class="card-title">{{ $user->first_name }} {{ $user->last_name }}</h4>
                                        @if (!empty($user->city))
                                            <h5 class="card-title mb-1">{{ $user->city }}</h5>
                                        @endif
                                    </div>
                                    <div class="col text-end">
                                        <img
                                            src="{{ asset('storage/' . ($user->profile_picture ?: 'profile-pictures/default.jpg')) }}"
                                            alt="Profile Picture"
                                            class="img-fluid rounded-pill mb-2 border border-light border-2"
                                            style="max-height: 10vh; width: auto;">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body flex-grow-1">
                                <p class="card-text mb-1">Categories:</p>
                                <ul class="card-text">
                                    @forelse ($user->categories->unique() as $category)
                                        <li>{{ $category->name }}</li>
                                    @empty
                                        <li>No categories found</li>
                                    @endforelse
                                </ul>
                                <p class="card-text mb-1">Courses:</p>
                                <ul class="card-text">
                                    @forelse ($user->courses as $course)
                                        <li>{{ $course->name }}<br>
                                            <span
                                                class="small">{{ $course->pivot->start_year }} - {{ $course->pivot->end_year }}</span>
                                        </li>
                                    @empty
                                        <li>No courses found</li>
                                    @endforelse
                                </ul>
                            </div>
                            <div class="card-footer text-light text-shadow">
                                <div class="row justify-content-center text-center">
                                    <div class="col-md-4">
                                        @if(Auth::user()->id !== $user->id) <!-- Ensure the user cannot follow themselves -->
                                            @if (Auth::user()->isFollowing($user))
                                                <form action="{{ route('unfollow', $user) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger m-1">Unfollow</button>
                                                </form>
                                            @else
                                                <form action="{{ route('follow', $user) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-success m-1">Follow</button>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ route('chat', $user->id) }}" class="btn btn-outline-primary m-1">Message</a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ route('viewProfile', ['id' => $user->id]) }}" class="btn btn-primary m-1">Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> 

        </div>
    </div>

@endsection