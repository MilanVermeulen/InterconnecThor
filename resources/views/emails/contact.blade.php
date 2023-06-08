<!DOCTYPE html>
<html>

<head>
  {{-- bootstrap css --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  {{-- google fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
  <style>
    /* custom font */
    @import url('https://fonts.googleapis.com/css2?family=Nunito&display=swap');

    * {
      font-family: 'Nunito', sans-serif;
    }

    /* custom color scheme: blue #2BA2C5, dark #212529 */

    /* primary edit */
    .text-primary {
      color: #2BA2C5 !important;
    }

    .bg-primary {
      background-color: #2BA2C5 !important;
    }
  </style>
</head>

<body class="bg-dark">

  <div class="container-fluid">
    <div class="row justify-content-center mt-5 mb-5">
      <div class="col-md-10 bg-light p-5 rounded">

        <div class="card mt-3">
          <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ $firstName }} {{ $lastName }}</h4>
            <p>{{ $email }}</p>
          </div>
          <div class="card-body">
            <h5>{{ $subject }}</h5>
            <p>{{ $messageText }}</p>
          </div>
        </div>

      </div>
    </div>
  </div>

</body>

</html>