@extends('components.admin.layouts.auth')

@section('title', 'Login')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/library/bootstrap-social/bootstrap-social.css') }}">
@endpush

@section()
    <div class="card card-primary">
        <div class="card-header">
            <h4>Login</h4>
        </div>
        <div>

            <h1>{{ $count }}</h1>
            
            <button wire:click="increment">+</button>
            
            <button wire:click="decrement">-</button>
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
</->

