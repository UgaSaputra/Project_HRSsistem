<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('css/login.css')}}" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="box1">
        <img src="images/Capture.PNG" alt="">
    </div>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="field">
            <input id="name" type="text" name="name" placeholder="Nama" required autocomplete="name" autofocus>
            <!-- @error('name') -->
            <strong>{{ $message }}</strong>
            <!-- @enderror -->
        </div>
        
        <div class="field">
            <input id="email" type="email" name="email" placeholder="Email" required autocomplete="email" autofocus>
            <!-- @error('email') -->
            <strong>{{ $message }}</strong>
            <!-- @enderror -->
        </div>
        
        <div class="field">
            <input id="password" name="password" type="password" placeholder="Password" required autocomplete="current-password">
            <!-- @error('password') -->
            <strong>{{ $message }}</strong>
            <!-- @enderror -->
        </div>
        
        <div class="field" style="width: 100%;">
            <select id="level" class="form-control @error('level') is-invalid @enderror" name="level" required>
                <option value="">Pilih Level</option>
                <option value="maneger" {{ old('level') == 'maneger' ? 'selected' : '' }}>Maneger</option>
                <option value="admin" {{ old('level') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('level')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        
        <button class="login-button" type="submit" title="login">Log In</button>
        <div class="separator">
            <div class="line"></div>
            <p>OR</p>
            <div class="line"></div>
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
    </form>
</body>

</html>
