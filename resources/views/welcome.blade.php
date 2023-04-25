<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body  class="bg-fuchsia-100 font-serif">
<nav class="text-gray-500 font-semibold px-4 py-3">
    <ul class="flex space-x-3 justify-end">
        <a href="{{ route('login') }}" class="p-4"><li>Login</li></a>
        <a href="{{ route('register') }}" class="p-4"><li>Register</li></a>
    </ul>
</nav>
<main class="flex mx-6">

    <div class="main py-16 pl-4 w-1/2">
        <div class="text-6xl tracking-wide leading-snug">
            Connect with <span class="bg-purple-500 text-white rounded-lg px-3">developers</span> and  <span class="bg-purple-500 text-white rounded-lg px-3">mentors</span> from around the world!

        </div>
        <p class="py-3 my-3">A platform for developers to connect with experienced mentors who can help guide them in their careers. This could involve features such as mentor matching, scheduling sessions, tracking progress, and providing resources and feedback. The specific aim of the project would depend on the goals and objectives of its creators.</p>

        <div class="buttons mt-6">
            <a href="{{ route('register') }}" class="mx-4 bg-purple-300 rounded-lg hover:bg-purple-600 text-purple-600 font-semibold hover:text-fuchsia-100 py-2 px-4">Subscribe now for one-on-one sessions with mentors:</a>
        </div>
    </div>
    <div class="flex py-16 justify-end w-1/2 px-4 h-fit">
        <img class="rounded-full" src="https://i.ibb.co/8g9Bp06/student.webp" class="w-fit" >
    </div>
</main>
</body>
</html>
