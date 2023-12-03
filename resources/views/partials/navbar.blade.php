<nav class="sticky top-0 bg-blue-800 px-4 py-2">
<div class="mx-auto">
    <div class="flex justify-between">
        <div>
            <a href="/" class="text-lg text-white font-medium ml-2">SecureVault</a>
        </div>

        <div class="ml-auto flex items-center space-x-4 mr-2">
            @auth
            <div class="text-white">Hello, {{ auth()->user()->fullname }}</div>
            <div class="text-white"><a href="/users">Users</a></div>
            <div class="text-white"><a href="/request">Request</a></div>
            @endauth
            @auth
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="px-3 py-1 text-white bg-red-600 rounded-md">Log out</button>
                </form>
            @else
                <a href="/register" class="text-white">Register</a>
                <a href="/login" class="px-3 py-1 text-blue-800 bg-white rounded-md">Log in</a>
            @endauth
        </div>
    </div>
</div>
</nav>