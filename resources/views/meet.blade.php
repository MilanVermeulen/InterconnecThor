@extends('master')
@section('content')

  <!-- tailwind -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" referrerpolicy="no-referrer" />

  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-light rounded h-screen pt-4 pb-4 mt-5">
    <div class="py-4">
        <h2 class="text-2xl fw-bold text-primary text-center">Meeting</h2>
    </div>
      <div class="max-w-2xl flex justify-center items-center m-auto pt-32">
          <div class="grid md:grid-cols-8 grid-cols-1 mt-4">
              <div class="md:col-span-5">
                  <form method="post" action="{{ route('validateMeeting') }}">
                    {{ csrf_field() }}
                  <div class="mt-1 flex rounded-md shadow-sm">
                    <div class="relative flex items-stretch flex-grow focus-within:z-10">
                      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <!-- Heroicon name: solid/users -->
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                        </svg>
                      </div>
                      <input type="text" name="meetingId" id="meetingId" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-none rounded-l-md pl-10 sm:text-sm border-gray-300" placeholder="Meeting ID">
                    </div>
                    <button type="submit" class="-ml-px relative inline-flex items-center space-x-2 px-4 py-2 border border-gray-300 text-sm font-medium rounded-r-md text-gray-700 bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                      <span>Join Meeting</span>
                    </button>
                  </div>
                  </form>
                </div>
                <div class="my-2 sm:my-0 flex items-center justify-center">
                  <span class="text-xs uppercase font-bold text-gray-400 px-1">OR</span>
                </div>
                <div class="md:col-span-2 flex items-center justify-center">
                  <form method="post" action="{{ route('createMeeting') }}">
                      {{ csrf_field() }}
                      <button type="submit" style="background-color: #2BA2C5;"  onmouseover="this.style.backgroundColor='#4338ca';" onmouseout="this.style.backgroundColor='#2BA2C5';" class="mt-1 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Create New Meeting</button>
                  </form>
              </div>
          </div>
      </div>
      <section>
        <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 md:px-12 lg:px-24 lg:py-24">
          <div class="flex flex-col w-full mb-12 text-center">
            <h1 class="max-w-5xl text-2xl font-bold leading-none tracking-tighter text-neutral-600 md:text-5xl lg:text-6xl lg:max-w-7xl m-3">
              Empower Your Communication with <span class="text-primary">i</span>nterconnect<span class="text-primary">T</span>hor Meetings!
            </h1>
            <p class="max-w-xl font-bold mx-auto mt-8 text-base leading-relaxed text-center text-gray-500">Unite and Collaborate Seamlessly with <span class="text-primary">i</span>nterconnect<span class="text-primary">T</span>hor Meetings!</p>
          </div>
        </div>
      </section>
  </div> 

@endsection