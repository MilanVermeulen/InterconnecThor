@extends('master')

@section('content')

    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-10 bg-light p-5 rounded">

            {{-- Title --}}
            <div class="row justify-content-center mb-5">
                <div class="col-md-10">
                   <h2>Search Results</h2>
                </div>
            </div>

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
            
            {{-- student search result cards --}}
            <div class="row justify-content-center">
                <div class="col-md-10">

                    <div class="row">
                        @forelse ($students as $student)
                            <div class="col-lg-4 mb-3">
                                <div class="card">
                                    <div class="card-header bg-primary text-white text-shadow">
                                        <h4 class="card-title">{{ $student->first_name }} {{ $student->last_name }}</h4>
                                    </div>
                                    <div class="card-body">
                        
                                        @if (!empty($student->city))
                                            <p class="card-text mb-1">{{ $student->city }}</p>
                                        @else
                                            <p class="card-text mb-1 text-muted">No city given</p>
                                        @endif
                                                            
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-10 text-center">
                                <h5>No results found.</h5>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        
        </div>
    </div>

@endsection
