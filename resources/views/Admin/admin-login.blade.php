<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column" style="min-height: 100vh;">

<!-- Top nav links -->
<div class="container py-3">
    <div class="d-flex justify-content-start">
      
    </div>
</div>

<!-- Login card -->
<div class="container flex-grow-1 d-flex align-items-center justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-lg rounded-4">
            <div class="card-body p-5">
                <h3 class="card-title text-center mb-4">Login</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin-login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                    </div>
                       <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        

                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <p class="mb-0">Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
                <div class="text-center mt-3">
              
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>