<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tex</title>
    @include('Admin.head')
</head>
<body class="login_body">
    <div class="main-wrapper account-wrapper">
        <div class="account-page">
            <div class="account-center">
                <div class="account-box">
                    <form method="POST" action="{{ route('login-user') }}" class="needs-validation form-signin"
                        novalidate id="log_form" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label>Username</label>
                            <input type="email" autofocus="" minlength="6" class="form-control" id="user_name" required
                                name="email">
                            <div class="invalid-feedback">
                                Minimum 6 characters required.
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" minlength="6" id="user_pwd" required
                                name="password">
                            <!-- <span toggle="#user_pwd" class="fa fa-fw fa-eye field-icon toggle-password"></span> -->
                            <div class="invalid-feedback">
                                Minimum 6 characters required.
                            </div>
                        </div>
                        <div class="form-check mt-3">
                            <input type="checkbox" class="form-check-input" id="rememberMe" value="1" name="rememberMe">
                            <label class="form-check-label" for="rememberMe" >Remember Me</label>
                        </div>
                        @if(Session::has('error'))
                        <small class="text-danger">{{ Session::get('error') }}</small><br>
                        @endif
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary account-btn mt-3" id="login_btn">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('/sw.js') }}"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script>
</html>