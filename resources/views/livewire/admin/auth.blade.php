<x-slot name='title'>
    Login
</x-slot>
<div>
    <div class="card card-primary">
        <div class="card-header">
            <h4>Login</h4>
        </div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="card-body">
            <form class="needs-validation" wire:submit.prevent="login">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input wire:model="email" id="email" type="email" class="form-control" name="email"
                        tabindex="1" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">
                            Please fill in your email
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                    </div>
                    <input wire:model="password" id="password" type="password" class="form-control" name="password"
                        tabindex="2" required>
                    @error('password')
                        <div class="invalid-feedback">
                            please fill in your password
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
