@extends('master')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-light p-5 rounded">
            {{-- welcome message --}}
            <div class="row justify-content-center mb-5">
                <div class="col-md-10">
                    @if (Auth::check())
                        @if (Auth::user()->role_id == 1)
                            <h2 class="text-center"><span class="text-primary fw-bold">{{ Auth::user()->name }}</span>,
                                you are the most <span class="text-primary fw-bold">talented</span>, most <span
                                    class="text-primary fw-bold">interesting</span>, and most <span
                                    class="text-primary fw-bold">extraordinary</span> person in the universe.</h2>

                        @else
                            <h2 class="text-center"><span
                                    class="text-primary fw-bold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>,
                                you are the most <span class="text-primary fw-bold">talented</span>, most <span
                                    class="text-primary fw-bold">interesting</span>, and most <span
                                    class="text-primary fw-bold">extraordinary</span> person in the universe.</h2>
                        @endif

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

                        {{-- post form --}}
                        <div class="row justify-content-center text-center">
                            <div class="col-md-10">
                                <div class="row justify-content-center text-center">
                                    <div class="col-md-4 text-start mb-5">
                                        <row class="form-control">
                                            @include('postForm')
                                        </row>
                                    </div>
                                    <div class="col-md-4 mb-5">
                                        <img src="{{ asset('/assets/logo.png') }}" alt="logo" class="img-fluid"
                                             style="max-height: 50vh">
                                    </div>
                                    <div class="col-md-4 text-end mb-5">
                                        @isset($posts)
                                            @foreach ($posts as $post)
                                                <div class="card-header bg-primary rounded">
                                                    <h3>
                                                        @if ($post->users->name)
                                                        {{ $post->users->name }}
                                                            @else
                                                        No user set
                                                            @endif
                                                    </h3>
                                                </div>
                                                <div class="card-body btn-outline-dark">
                                                    <h3>{{ $post->title }}</h3>
                                                    <p>{{ $post->description }}</p>
                                                </div>
                                            @endforeach
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        <h2 class="text-center"><a href="/login" class="text-decoration-none"><span
                                    class="text-primary fw-bold">Log in</span></a> or <a href="/register"
                                                                                         class="text-decoration-none"><span class="text-primary fw-bold">sign up</span></a>
                            to join the <span class="text-primary fw-bold">interconnecThor</span> community!</h2>
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

                </div>
            </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
