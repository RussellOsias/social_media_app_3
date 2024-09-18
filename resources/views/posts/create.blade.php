<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Create a New Post</h1>

        <!-- Display validation errors -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Post creation form -->
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <textarea name="content" rows="4" placeholder="What's on your mind?" required></textarea>
            <button type="submit">Post</button>
        </form>
    </div>
</body>
</html>
