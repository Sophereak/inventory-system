<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password — InvenTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md px-6">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="{{ route('welcome') }}" class="inline-flex items-center gap-2 justify-center">
                <span class="text-4xl">📦</span>
                <span class="font-extrabold text-2xl text-gray-800">InvenTrack</span>
            </a>
            <p class="text-gray-400 text-sm mt-2">Reset your password</p>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

            <p class="text-sm text-gray-500 mb-6">
                Forgot your password? Enter your email and we'll send you a reset link.
            </p>

            @if (session('status'))
                <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm">
                    ✅ {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           placeholder="you@example.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-2">⚠️ {{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg text-sm font-semibold hover:bg-blue-700 transition">
                    Send Reset Link
                </button>
            </form>
        </div>

        {{-- Back to login --}}
        <p class="text-center text-sm text-gray-400 mt-6">
            Remember your password?
            <a href="{{ route('login') }}" class="text-blue-500 font-medium hover:underline">Back to login</a>
        </p>

    </div>

</body>
</html>