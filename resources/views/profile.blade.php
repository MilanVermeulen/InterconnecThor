@extends('master')
@section('content')
    <div class="row justify-content-center mb-5">
        <div class="col-md-10 p-5 bg-light rounded">
            <div class="row justify-content-center">
                <div class="col-md-4 p-5 bg-light rounded">
                    @if ($user->profile_picture)
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture"
                                     class="img-fluid rounded-pill mb-2 border border-light border-2 me-2 mt-1"
                                     style="max-height: 50vh; width: auto;">
                            </div>
                        </div>
                    @endif
                    <h4 class="text-center mb-5">{{ $user->first_name }} {{ $user->last_name }}</h4>
                    <h5 class="text-center mb-5">{{ $user->city }}</h5>
                    <p>
                        @forelse ($user->categories->unique() as $category)
                            <li>{{ $category->name }}</li>
                        @empty
                            <li>No categories found</li>
                        @endforelse
                        @forelse ($user->courses as $course)
                            <li>{{ $course->name }}</li>
                        @empty
                            <li>No courses found</li>
                        @endforelse
                    </p>
                </div>
                <div class="col-md-8 bg-light">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-control mb-3">
                                @include('postForm')
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                        </div>
                    </div>
                </div>


            </div>
    </div>
@endsection
