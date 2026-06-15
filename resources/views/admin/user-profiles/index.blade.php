<!DOCTYPE html>
<html>
<head>
    <title>User Profiles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<div class="d-flex justify-content-between mb-4">
    <h3 class="fw-bold">👤 User Profiles</h3>

   
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">

@foreach($profiles as $p)
<div class="col-md-4 mb-4">

<div class="card shadow border-0 p-3 text-center">

<img src="{{ $p->avatar ? asset('storage/'.$p->avatar) : 'https://via.placeholder.com/100' }}"
     class="rounded-circle mx-auto mb-3"
     width="100" height="100"
     style="object-fit: cover;">

<h5>{{ $p->user->name }}</h5>

<p class="text-muted mb-1">{{ $p->phone }}</p>

<span class="badge {{ $p->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
    {{ $p->status }}
</span>

<div class="mt-3">
    <a href="{{ route('profiles.edit', $p->id) }}"
       class="btn btn-warning btn-sm">Edit</a>

  
</div>

</div>

</div>
@endforeach

</div>

</div>

</body>
</html>