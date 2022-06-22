@extends('layouts.app-login')

@section('content')

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name logo-name-small">All Music All Artists</h1>
        </div>
        <h3>Welcome to All Music All Artists</h3>
        <p>All Music All Artist, A Place For Fan And Artist To Interact.</p>
        <p>Login in. To see it in action.</p>
        <form class="m-t" role="form" method="POST" action="{{ route('login') }}">
            @csrf()
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" name="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
             @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}"><small>{{ __('Forgot password?') }}</small></a>
            @endif
        </form>
        <p class="m-t"> <small>Copyright &copy; All Music All Artists 2019</small> </p>
    </div>
</div>
@endsection
