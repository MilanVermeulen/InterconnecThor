@extends('voyager::master')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .page-content {
        padding: 0px 40px 0 40px;
    }
</style>

@section('content')
    <div class="page-content">
        @include('voyager::alerts')
        @include('voyager::dimmers')
        <h1>User Count by category</h1>
        <div class="row">
            <div class="col-md-6">
                <canvas id="barChart" width="400" height="400"></canvas>
            </div>
        </div>
        @php
            $categories = App\Models\Category::withCount('users')->get();
            // put category names and user counts into arrays
            $category_names = [];
            $user_counts= [];

            // loop through categories and add to array
            foreach ($categories as $category) {
                $category_names[] = $category->name;
                $user_counts[] = $category->users_count;
            }

        @endphp

        <div class="content">
            <script>
                // PHP to JavaScript data conversion
                let categories = @json($category_names);
                let data = @json($user_counts);

                // Create bar chart
                var ctx = document.getElementById('barChart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: categories,
                        datasets: [{
                            label: '',
                            data: data,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 3
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
@stop
