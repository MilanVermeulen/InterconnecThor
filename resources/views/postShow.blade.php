@extends('master')

@section('content')
    <div class="row mt-5 justify-content-center">
        <div class="col-md-10 bg-light p-5 rounded">

            <div class="card mb-3">
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
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="m-0 fw-bold">{{ $post->title }}</h5>
                        <p>{{ $post->description }}</p>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-center text-center">
                            <div class="col text-end">
                                <p class="m-0 text-muted">
                                    {{ $post->created_at->diffForHumans() }} at {{ $post->created_at->format('H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comment Form -->
            <form action="{{ route('posts.comments.create', ['id' => $post->id]) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="comment">Leave a comment:</label>
                    <textarea id="comment" name="comment" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
@endsection
