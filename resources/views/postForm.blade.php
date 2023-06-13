<form method="post" action="{{ route('post') }}">
    @csrf <!-- Include CSRF token for form protection -->

    @if(Request::is('profile/*'))
        @php
            $profileUrl = Request::url();
        @endphp
        <input type="hidden" name="redirect_url" value="{{ $profileUrl }}">
    @else
        <input type="hidden" name="redirect_url" value="{{ url('/') }}">
    @endif

    <h1 class="text-center">Create a new post</h1>
    <div class="form-group mb-2">
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
    </div>
    <div class="form-group mt-1">
        <label for="description">Description</label>
        <textarea class="form-control mb-3" id="description" name="description" aria-label="Description"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
