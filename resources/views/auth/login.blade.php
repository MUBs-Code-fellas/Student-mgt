<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | SMS</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="bg-white rounded-lg shadow-md p-8 w-full max-w-md">
    <h1 class="text-2xl font-bold text-blue-800 mb-2 text-center">Student Management System</h1>
    <h2 class="text-gray-600 text-center mb-6">Sign in to your account</h2>

    @if ($errors->any())
      <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
        @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input
          id="email"
          type="email"
          name="email"
          value="{{ old('email') }}"
          required
          autofocus
          class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
      </div>

      <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input
          id="password"
          type="password"
          name="password"
          required
          class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
      </div>

      <div class="mb-6 flex items-center">
        <input id="remember" type="checkbox" name="remember" class="mr-2">
        <label for="remember" class="text-sm text-gray-600">Remember me</label>
      </div>

      <button type="submit" class="w-full bg-blue-800 text-white py-2 rounded hover:bg-blue-700 transition">
        Sign In
      </button>
    </form>
  </div>
</body>
</html>
