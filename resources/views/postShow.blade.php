@extends('master')

@section('content')

    <div class="row mt-5 justify-content-center">
        <div class="col-md-10 bg-light p-5 rounded">

            {{-- custom error message --}}
            @if (session('error'))
                <div class="row justify-content-center mb-5">
                    <div class="col-md-10">
                        <div class="alert alert-danger text-center">
                            {{ session('error') }}
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
                <div class="col-md-6">
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
                            <p>{{ $post->description }}</p>
                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-center text-center">
                                <div class="col-auto text-start">
                                    @if ($post->likes->contains(Auth::user()))
                                        <!-- Unlike Button -->
                                        <form method="POST" action="{{ route('unlikePost', $post->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">
                                                <i class="fa-regular fa-thumbs-up"></i> {{ $post->likes->count() }}
                                            </button>
                                        </form>
                                    @else
                                        <!-- Like Button -->
                                        <form method="POST" action="{{ route('likePost', $post->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success">
                                                <i class="fa-regular fa-thumbs-up"></i> {{ $post->likes->count() }}
                                            </button>
                                        </form>
                                    @endif
                                </div>    
                                <div class="col-auto text-start">
                                    <p class="btn btn-primary no-cursor">
                                        <i class="fa-regular fa-comment"></i> {{ $post->comments->count() }}
                                    </p>
                                </div>
                                @if($post->user_id === Auth::id())
                                    <div class="col-auto text-start">
                                        <form action="{{ route('post.delete', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    </div>
                                @endif
                                <div class="col text-end">
                                    <p class="m-0 text-muted">
                                        {{ $post->created_at->diffForHumans() }} at {{ $post->created_at->format('H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            @forelse($post->comments->sortByDesc('created_at') as $comment)
                                <div class="card d-flex flex-column mb-3">
                                    <div class="card-header bg-dark text-light text-shadow cursor-pointer" onclick="window.location.href='{{ route('viewProfile', ['id' => $comment->user->id]) }}'">
                                        <div class="row">
                                            <div class="col">
                                                <h4 class="m-0">
                                                    @if ($comment->user->first_name)
                                                        <span class="fw-bold">{{ $comment->user->first_name }} {{ $comment->user->last_name }}<br></span>
                                                    @endif
                                                    <span class="fs-6">{{ $comment->user->name }}</span>
                                                </h4>
                                            </div>
                                            <div class="col text-end">
                                                <img src="{{ asset('storage/' . ($comment->user->profile_picture ?: 'profile-pictures/default.jpg')) }}" alt="Profile Picture" class="img-fluid rounded-pill mb-2 border border-light border-2" style="max-height: 7vh; width: auto;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row justify-content-center text-center">
                                            @if($comment->user_id === Auth::id())
                                                <div class="col text-start">
                                                    <form action="{{ route('comments.delete', ['id' => $comment->id]) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i></button>
                                                    </form>
                                                </div>
                                            @endif
                                            <div class="col text-end">
                                                <p class="m-0 text-muted">
                                                    {{ $comment->created_at->diffForHumans() }} at {{ $comment->created_at->format('H:i') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted mb-0 text-center">No comments yet.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4 class="mb-3 fw-bold">Leave a Comment</h4>
                    <form action="{{ route('posts.comments.create', ['id' => $post->id]) }}" method="POST" class="border rounded p-3 mb-5">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="comment" class="mb-1 text-primary fw-bold">Your Comment:</label>
                            <textarea id="comment" name="comment" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection