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
                            <h2 class="text-center"><span class="text-primary fw-bold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>, welcome to <span class="text-primary fw-bold">interconnecThor</span>, your hub for <span class="text-primary fw-bold">connection</span>, <span class="text-primary fw-bold">collaboration</span>, and <span class="text-primary fw-bold">creation</span>.</h2>
                        @endif
                    @else
                        <h2 class="text-center"><a href="/login" class="text-decoration-none"><span class="text-primary fw-bold">Log in</span></a> or <a href="/register" class="text-decoration-none"><span class="text-primary fw-bold">sign up</span></a> to join the <span class="text-primary fw-bold">interconnecThor community</span>!</h2>
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
                                    {{-- post form --}}
                                    <h5 class="mb-3 fw-bold">New Post</h5>
                                    @include('postForm')                            
                                </div>
                                <div class="col-md-6">
                                    {{-- posts/feed --}}
                                    <h5 class="mb-3 fw-bold">Feed</h5>
                                    @isset($posts)
                                        @foreach ($posts as $post)
                                            <div class="card mb-3">
                                                <div class="card-header bg-primary text-light">
                                                    <h4 class="m-0">
                                                        @if ($post->users->first_name)
                                                            {{ $post->users->first_name }} {{ $post->users->last_name }} ({{ $post->users->name }})
                                                        @else
                                                            {{ $post->users->name }}
                                                        @endif
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="mb-3 fw-bold">{{ $post->title }}</h5>
                                                    <p>{{ $post->description }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endisset
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