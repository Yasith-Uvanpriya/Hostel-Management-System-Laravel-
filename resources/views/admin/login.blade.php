<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(120deg, #e0eafc 0%, #b6e0fe 100%);
            font-family: 'Roboto', Arial, sans-serif;
        }

        .card {
            width: 100%;
            max-width: 400px;
            border-radius: 20px;
            box-shadow: 0 12px 40px rgba(44, 62, 80, 0.13);
            padding: 20px;
        }

        .btn.btn-primary.btn-glow {

            background-image: none !important;
            background: linear-gradient(90deg, #2193b0 0%, #6dd5ed 100%) !important;

            color: #ffffff !important;
            border: none !important;
            border-radius: 50px !important;
            padding: 0.62rem 1.8rem !important;
            font-size: 1.05rem;
            font-weight: 600;
            box-shadow: 0 4px 14px rgba(33, 147, 176, 0.12);
            position: relative;
            overflow: hidden;
            transition: transform .35s cubic-bezier(.2, .9, .3, 1), box-shadow .35s ease;
            -webkit-font-smoothing: antialiased;
        }

        .btn.btn-primary.btn-glow::before {
            content: "";
            position: absolute;
            top: 0;
            left: -140%;
            width: 240%;
            height: 100%;
            background: linear-gradient(120deg,
                    rgba(255, 255, 255, 0.08) 0%,
                    rgba(255, 255, 255, 0.02) 50%,
                    rgba(255, 255, 255, 0.08) 100%);
            transform: skewX(-20deg);
            transition: left .45s cubic-bezier(.2, .9, .3, 1);
            z-index: 1;
            pointer-events: none;
        }

        .btn.btn-primary.btn-glow .btn-text {
            position: relative;
            z-index: 2;
            display: inline-block;
        }

        .btn.btn-primary.btn-glow:hover,
        .btn.btn-primary.btn-glow:focus {
            transform: translateY(-4px) scale(1.035);
            box-shadow: 0 16px 40px rgba(33, 147, 176, 0.24);
            outline: none;
        }

        .btn.btn-primary.btn-glow:hover::before,
        .btn.btn-primary.btn-glow:focus::before {
            left: 0;
        }

        .btn.btn-primary.btn-glow:active {
            transform: translateY(-1px) scale(0.995);
        }

        .btn.btn-primary.btn-glow:focus {
            box-shadow: 0 0 0 6px rgba(109, 213, 237, 0.12);
        }

        @media (max-width: 480px) {
            .btn.btn-primary.btn-glow {
                padding: 0.56rem 1.2rem !important;
                font-size: 0.98rem;
                border-radius: 40px !important;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card mt-5 shadow-sm">
                    <div class="card-header text-center fw-600">Admin Login</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.login.submit') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-glow">
                                    <span class="btn-text">Login</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>