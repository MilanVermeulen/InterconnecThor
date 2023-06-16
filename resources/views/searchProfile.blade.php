@extends('master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10 p-5 bg-light rounded">
            {{-- success message --}}
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
                <div class="col-md-6 p-5 text-center border rounded">

                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . ($user->profile_picture ?: 'profile-pictures/default.jpg')) }}" alt="Profile Picture"
                                 class="img-fluid rounded-pill mb-2 border border-light border-2 me-2 mt-1"
                                 style="max-height: 50vh; width: auto;">
                        </div>
                    </div>

                    <h4 class="fw-bold mb-0">{{ $user->first_name }} {{ $user->last_name }}</h4>
                    <h5 class="mb-3">{{ $user->name }}</h5>
                    <h5 class="mb-5">{{ $user->city }}</h5>
                    <p>
                    <h5 class="fw-bold text-primary mb-1">Categories</h5>
                    <ul class="list-group list-group-flush mb-3">
                        @forelse ($user->categories->unique() as $category)
                            <li class="list-group-item">{{ $category->name }}</li>
                        @empty
                            <li class="list-group-item">No categories found</li>
                        @endforelse
                    </ul>

                    <h5 class="fw-bold text-primary mb-1">Courses</h5>
                    <ul class="list-group list-group-flush mb-3">
                        @forelse ($user->courses as $course)
                            <li class="list-group-item">{{ $course->name }}<br>
                                <span class="small">{{ $course->pivot->start_year }} - {{ $course->pivot->end_year }}</span></li>
                        @empty
                            <li class="list-group-item">No courses found</li>
                        @endforelse
                    </ul>
                    </p>
                </div>
                <div class="col-md-6">
                    @forelse ($user->posts()->latest()->get() as $post)
                        <div class="card mb-3">
                            <div class="card-header bg-primary text-light">
                                <h5 class="m-0 fw-bold">{{ $post->title }}</h5>
                            </div>
                            <div class="card-body">
                                <p>{{ $post->description }}</p>
                            </div>
                        </div>
                    @empty
                        <p>No posts found.</p>
                    @endforelse
                </div>
                <div class="col-md-4">
                    {{-- Include your post form or any other content related to the user profile --}}
                </div>

            </div>
        </div>

@endsection
