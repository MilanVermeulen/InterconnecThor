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
                            <div class="col text-start">
                                <p class="m-0 text-muted">
                                    {{ $post->comments->count() }} comment(s)
                                </p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                @forelse($comments as $comment)
                                    <div class="row justify-content-center text-center">
                                        <div class="col text-end">
                                            <p class="m-0 text-muted">
                                                {{ $comment->created_at->diffForHumans() }} at {{ $comment->created_at->format('H:i') }}
                                            </p>
                                        </div>
                                        <div class="col text-start">
                                            <p class="m-0 text-muted">
                                                {{ $comment->user->name }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center text-center">
                                        <div class="col text-end">
                                            <p class="m-0 text-muted">
                                                {{ $comment->comment }}
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="row justify-content-center text-center">
                                        <div class="col text-end">
                                            <p class="m-0 text-muted">
                                                No comments yet
                                            </p>
                                        </div>
                                    </div>
                                @endforelse
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

            <!-- Comments -->
            <div class="mt-4">
                <h4>Comments</h4>
                @forelse($post->comments as $comment)
                    <div class="card mb-2">
                        <div class="card-body">
                            <p>{{ $comment->comment }}</p>
                            @if($comment->user_id === Auth::id())
                                <form action="{{ route('comments.delete', ['id' => $comment->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <p>No comments yet.</p>
                @endforelse
            </div>

        </div>
    </div>
@endsection
