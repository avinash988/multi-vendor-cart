<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — ShopNest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.4);
            overflow: hidden;
        }
        .login-header {
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            padding: 35px 30px;
            text-align: center;
        }
        .login-header h2 { font-weight: 800; color: white; margin: 0; }
        .login-header p { color: rgba(255,255,255,0.85); margin: 5px 0 0; font-size: 14px; }
        .login-body { padding: 35px 30px; background: white; }
        .form-control {
            border: 1.5px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #ff6b35;
            box-shadow: 0 0 0 3px rgba(255,107,53,0.15);
        }
        .form-label { font-weight: 600; font-size: 13px; color: #444; }
        .input-group-text { background: #f8f9fa; border: 1.5px solid #e0e0e0; border-radius: 10px 0 0 10px; border-right: none; color: #ff6b35; }
        .input-group .form-control { border-radius: 0 10px 10px 0; border-left: none; }
        .btn-login {
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            border: none;
            border-radius: 10px;
            padding: 13px;
            font-weight: 700;
            font-size: 15px;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(255,107,53,0.4); }
        .demo-box { background: #f8f9fa; border-radius: 10px; padding: 15px; border-left: 4px solid #ff6b35; }
        .demo-box .badge { font-size: 11px; }
        .alert { border-radius: 10px; border: none; font-size: 14px; }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">

            <div class="login-card">
                <div class="login-header">
                    <div class="mb-3">
                        <i class="fas fa-store" style="font-size: 40px; color: white;"></i>
                    </div>
                    <h2><span style="color: #1a1a2e;">Shop</span>Nest</h2>
                    <p>Multi Vendor Marketplace</p>
                </div>

                <div class="login-body">
                    <h5 class="fw-700 mb-1">Welcome Back!</h5>
                    <p class="text-muted small mb-4">Sign in to your account to continue</p>

                    @if($errors->any())
                        <div class="alert alert-danger d-flex align-items-center mb-3">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="/login">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-login text-white w-100">
                            <i class="fas fa-sign-in-alt me-2"></i>Sign In
                        </button>
                    </form>

                    <div class="demo-box mt-4">
                        <p class="fw-600 mb-2 small" style="color: #333;"><i class="fas fa-info-circle me-1" style="color:#ff6b35;"></i>Demo Accounts</p>
                        <div class="d-flex flex-column gap-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <code class="small" style="color:#333;">customer@test.com</code>
                                <span class="badge" style="background:#0f3460;">Customer</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-1">
                                <code class="small" style="color:#333;">admin@test.com</code>
                                <span class="badge" style="background:#ff6b35;">Admin</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
