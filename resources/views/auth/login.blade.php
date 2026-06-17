<!DOCTYPE html>
<html>
<head>

    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container">

    <div class="row justify-content-center mt-5">

        <div class="col-md-4">

            <div class="card shadow">

                <div class="card-body">

                    <h3 class="text-center mb-4">
                        Login
                    </h3>

                    @if($errors->any())

                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>

                    @endif

                    <form method="POST" action="/login">

                        @csrf

                        <input
                            type="email"
                            name="email"
                            class="form-control mb-3"
                            placeholder="Enter Email">

                        <button
                            class="btn btn-primary w-100">

                            Login

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>