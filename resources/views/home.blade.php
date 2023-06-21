@extends('master')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-light p-5 rounded">

            {{-- welcome message --}}
            <div class="row justify-content-center mb-5">
                <div class="col-md-10">
                    @if (Auth::check())
                        @if (Auth::user()->role_id == 1)
                            <h2 class="text-center"><span class="text-primary fw-bold">{{ Auth::user()->name }}</span>, welcome to <span class="text-primary fw-bold">interconnecThor</span>, your hub for <span class="text-primary fw-bold">connection</span>, <span class="text-primary fw-bold">collaboration</span>, and <span class="text-primary fw-bold">creation</span>.</h2>
                        @else
                            <h2 class="text-center"><span class="text-primary fw-bold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>, welcome to <span class="text-primary fw-bold">interconnecThor</span>!<br>
                                Your hub for <span class="text-primary fw-bold">connection</span>, <span class="text-primary fw-bold">collaboration</span>, and <span class="text-primary fw-bold">creation</span>.</h2>
                        @endif
                    @else
                        <h2 class="text-center"><a href="/login" class="text-decoration-none"><span class="text-primary fw-bold">Log in</span></a> or <a href="/register" class="text-decoration-none"><span class="text-primary fw-bold">sign up</span></a> to join the <span class="text-primary fw-bold">interconnecThor</span> community!</h2>
                    @endif
                </div>
            </div>

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

            @if (Auth::check())
                @if (Auth::user()->role_id == 2)

                    {{-- postform + posts/feed --}}
                    <div class="row justify-content-center">
                        <div class="col-md-10">

                            <div class="row">
                                <div class="col-md-6">
                                    
                                    {{-- posts/feed --}}
                                    <h4 class="mb-3 fw-bold">Feed</h4>

                                   {{-- nav tab --}}
                                   <div class="nav nav-tabs justify-content-start mb-2" id="nav-tab" role="tablist">
                                        <a class="nav-link {{ Request::route()->getName() == 'home' ? 'active text-primary fw-bold' : 'text-dark' }}" href="{{ route('home') }}">Everyone</a>
                                        <a class="nav-link {{ Request::route()->getName() == 'followedPosts' ? 'active text-primary fw-bold' : 'text-dark' }}" href="{{ route('followedPosts') }}">Following</a>
                                    </div>

                                    @isset($posts)
                                        @forelse ($posts->sortByDesc('created_at') as $post)
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
                                                    <h5 class="mb-3 fw-bold cursor-pointer-comment" onclick="window.location.href='{{ route('post.show', $post->id) }}'">{{ $post->title }}</h5>
                                                    <p class="mb-0" >{{ $post->description }}</p>
                                                    @if(strlen($post->description) >= 255)
                                                        <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none text-primary font-weight-bold view-more">View more</a>
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
                                    @endisset
                                        
                                    {{-- pagination --}}
                                    <div class="d-flex justify-content-center">
                                        {{ $posts->links('pagination::bootstrap-4') }}
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    {{-- post form --}}
                                    @include('postForm')
                                </div>
                            </div>
                            
                        </div>
                    </div>
                @else

                    <div class="row justify-content-center text-center">
                        <div class="col-md-10">

                            <div class="row justify-content-center text-center">
                                <div class="col-md-4 text-start mb-5">
                                    <p>Welcome to <span class="text-primary fw-bold">interconnecThor</span>, the unique digital platform exclusively designed for the students. From <span class="text-primary fw-bold">connecting</span> with classmates to <span class="text-primary fw-bold">sharing innovative ideas</span>, interconnecThor is your go-to space for collaboration.</p>
                                    <p>Here, you can create <span class="text-primary fw-bold">personalized profiles</span>, follow peers, <span class="text-primary fw-bold">share your thoughts</span>, and much more. Our aim is to build an engaging and interactive community for all of our students.</p>
                                </div>
                                <div class="col-md-4 mb-5">
                                    <img src="{{ asset('/assets/logo.png') }}" alt="logo" class="img-fluid" style="max-height: 50vh">
                                </div>
                                <div class="col-md-4 text-end mb-5">
                                    <p>Seize <span class="text-primary fw-bold">exciting job opportunities</span>, transform <span class="text-primary fw-bold">innovative ideas</span> into meaningful projects, and experience seamless <span class="text-primary fw-bold">collaboration</span> with features like virtual meetings and screen sharing. The possibilities on interconnecThor are endless.</p>
                                    <p>We are excited to have you on this journey as we shape the future of our student community, one <span class="text-primary fw-bold">connection</span> at a time. Welcome to <span class="text-primary fw-bold">InterconnecThor</span> - your digital campus companion!</p>
                                </div>
                            </div>

                        </div>
                    </div>

                @endif
            @else

                <div class="row justify-content-center text-center">
                    <div class="col-md-10">

                        <div class="row justify-content-center text-center">
                            <div class="col-md-4 text-start mb-5">
                                <p>Welcome to <span class="text-primary fw-bold">interconnecThor</span>, the unique digital platform exclusively designed for the students. From <span class="text-primary fw-bold">connecting</span> with classmates to <span class="text-primary fw-bold">sharing innovative ideas</span>, interconnecThor is your go-to space for collaboration.</p>
                                <p>Here, you can create <span class="text-primary fw-bold">personalized profiles</span>, follow peers, <span class="text-primary fw-bold">share your thoughts</span>, and much more. Our aim is to build an engaging and interactive community for all of our students.</p>
                            </div>
                            <div class="col-md-4 mb-5">
                                <img src="{{ asset('/assets/logo.png') }}" alt="logo" class="img-fluid" style="max-height: 50vh">
                            </div>
                            <div class="col-md-4 text-end mb-5">
                                <p>Seize <span class="text-primary fw-bold">exciting job opportunities</span>, transform <span class="text-primary fw-bold">innovative ideas</span> into meaningful projects, and experience seamless <span class="text-primary fw-bold">collaboration</span> with features like virtual meetings and screen sharing. The possibilities on interconnecThor are endless.</p>
                                <p>We are excited to have you on this journey as we shape the future of our student community, one <span class="text-primary fw-bold">connection</span> at a time. Welcome to <span class="text-primary fw-bold">InterconnecThor</span> - your digital campus companion!</p>
                            </div>
                        </div>

                    </div>
                </div>

            @endif

        </div>
    </div>

@endsection
