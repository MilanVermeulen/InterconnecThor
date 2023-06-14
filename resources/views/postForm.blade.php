<h4 class="mb-3 fw-bold">Create a New Post</h4>
<form method="post" action="{{ route('postform') }}" class="border rounded p-3 mb-5">
    @csrf <!-- Include CSRF token for form protection -->

    @if(Request::is('profile/*'))
        @php
            $profileUrl = Request::url();
        @endphp
        <input type="hidden" name="redirect_url" value="{{ $profileUrl }}">
    @else
        <input type="hidden" name="redirect_url" value="{{ url('/') }}">
    @endif

    <div class="form-group mb-3">
        <label for="title" class="mb-1 text-primary fw-bold">Title</label>
        <input type="text" name="title" id="title" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label for="description" class="mb-1 text-primary fw-bold">Description</label>
        <textarea class="form-control" id="description" name="description" aria-label="Description"></textarea>
    </div>
    
    <button type="submit" class="btn btn-outline-primary">Post!</button>
</form>
<h4 class="mb-3 fw-bold">Search Existing Posts</h4>
<form method="post" action="{{ route('search-posts') }}" class="border rounded p-3 mb-5">
    @csrf <!-- Include CSRF token for form protection -->

    <div class="form-group mb-3">
        <label for="search" class="mb-1 text-primary fw-bold">Enter Post Keywords</label>
        <input class="form-control me-2" type="search" name="search" placeholder="Enter keywords or phrases" required minlength="3">
    </div>

    <button class="btn btn-outline-primary me-2 mb-1" type="submit">Search!</button>
</form>