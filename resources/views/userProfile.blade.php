@extends('master')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-10 p-5 bg-light rounded">

            {{-- success message --}}
            @if (session('success'))
                <div class="row justify-content-center mb-5">
                    <div class="col-md-12">
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
            @endif

            {{-- validation errors --}}
            @if ($errors->any())
                <div class="row justify-content-center mb-5">
                    <div class="col-md-12">
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
                <div class="col-md-4 p-5 text-center border rounded bg-light">

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

                    <p class="mb-0 cursor-pointer" onclick="window.location.href='{{ route('user.following', $user->id) }}'">Following: <span class="text-primary fw-bold">{{ $user->following_count }}</span></p>
                    <p class="mb-0 cursor-pointer" onclick="window.location.href='{{ route('user.followers', $user->id) }}'">Followers: <span class="text-primary fw-bold">{{ $user->followers()->count() }}</span></p>
                    <p class="mb-5 cursor-pointer" onclick="window.location.href='{{ route('user.connections', $user->id) }}'">Connections: <span class="text-primary fw-bold">{{ $user->connections()->count() }}</span></p>

                    <p>
                        <h5 class="fw-bold text-primary mb-1">Categories</h5>
                        <ul class="list-group list-group-flush mb-3">
                            @forelse ($user->categories->unique() as $category)
                                <li class="list-group-item bg-light">{{ $category->name }}</li>
                            @empty
                                <li class="list-group-item bg-light">No categories found</li>
                            @endforelse
                        </ul>

                        <h5 class="fw-bold text-primary mb-1">Courses</h5>
                        <ul class="list-group list-group-flush mb-3">
                            @forelse ($user->courses as $course)
                                <li class="list-group-item bg-light">{{ $course->name }}<br>
                                     <span class="small ">{{ $course->pivot->start_year }} - {{ $course->pivot->end_year }}</span></li>
                            @empty
                                <li class="list-group-item bg-light">No courses found</li>
                            @endforelse
                        </ul>
                    </p>
                </div>
                <div class="col-md-4">
                    @forelse ($user->posts()->latest()->get() as $post)
                        <div class="card d-flex flex-column mb-3">
                            <div class="card-header bg-primary text-light text-shadow cursor-pointer" onclick="window.location.href='{{ route('viewProfile', ['id' => $post->user->id]) }}'">
                                <div class="row">
                                    <div class="col">
                                        <h4 class="m-0">
                                            @if ($post->user->first_name)
                                                <span class="fw-bold">{{ $post->user->first_name }} {{ $post->user->last_name }}<br></span>
                                            @endif
                                            <span class="fs-6">{{ $post->user->name }}</span>
                                        </h4>
                                    </div>
                                    <div class="col text-end">
                                        <img src="{{ asset('storage/' . ($post->user->profile_picture ?: 'profile-pictures/default.jpg')) }}" alt="Profile Picture" class="img-fluid rounded-pill mb-2 border border-light border-2" style="max-height: 7vh; width: auto;">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="mb-3 fw-bold">{{ $post->title }}</h5>
                                <p class="mb-0" >{{ $post->description }}</p>
                                @if(strlen($post->description) >= 255)
                                    <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none text-primary font-weight-bold">View more</a>
                                @endif            
                            </div>
                            <div class="card-footer">
                                <div class="row justify-content-center text-center">
                                    <div class="col text-start">
                                        <p class="m-0 text-muted cursor-pointer-comment" onclick="window.location.href='{{ route('post.show', $post->id) }}'">
                                            <i class="fa-regular fa-comment"></i> {{ $post->comments->count() }}
                                        </p>
                                    </div>
                                    <div class="col text-end">
                                        <p class="m-0 text-muted">
                                            {{ $post->created_at->diffForHumans() }} at {{ $post->created_at->format('H:i') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="mt-5">No posts found.</p>
                    @endforelse
                </div>
                <div class="col-md-4">
                    @include('postForm')
                </div>
            </div>

        </div>
    </div>

@endsection
