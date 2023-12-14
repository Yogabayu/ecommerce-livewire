<div class="card card-primary">
    <div class="card-header">
        <h4>Login</h4>
    </div>
    <div class="card-body">
        {{-- <form method="POST" action="#" class="needs-validation" novalidate=""> --}}
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                <div class="invalid-feedback">
                    Please fill in your email
                </div>
            </div>

            <div class="form-group">
                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                <div class="invalid-feedback">
                    please fill in your password
                </div>
            </div>

            <div class="form-group">
                <a href="{{ route('admin-dashboard') }}">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                    </button>
                </a>
            </div>
            {{--
        </form> --}}

    </div>
</div>
