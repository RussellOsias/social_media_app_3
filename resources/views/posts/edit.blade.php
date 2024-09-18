<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #1e1e1e;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            margin-top: 50px;
        }
        h1 {
            color: #f00;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #f00;
            border-radius: 4px;
            background-color: #333;
            color: #e0e0e0;
            margin-bottom: 10px;
        }
        input[type="file"] {
            padding: 8px;
            border: 1px solid #f00;
            border-radius: 4px;
            background-color: #333;
            color: #e0e0e0;
            margin-bottom: 10px;
        }
        button {
            background-color: #f00;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #d00;
        }
        a {
            color: #f00;
            text-decoration: none;
            font-size: 16px;
            display: block;
            margin-top: 20px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Post</h1>

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Post Content Textarea -->
            <textarea name="content" rows="4" required>{{ old('content', $post->content) }}</textarea>

            <!-- Post Media Preview (if applicable) -->
            @if($post->photo)
                <div style="margin-bottom: 10px;">
                    <img src="{{ asset('storage/' . $post->photo) }}" alt="Post Image" style="max-width: 100%; height: auto; border-radius: 4px;">
                </div>
            @elseif($post->video)
                <div style="margin-bottom: 10px;">
                    <video controls style="max-width: 100%; height: auto; border-radius: 4px;">
                        <source src="{{ asset('storage/' . $post->video) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            @endif

            <!-- File Input for Updating Media -->
            <input type="file" name="media" accept="image/*,video/*">

            <!-- Submit Button -->
            <button type="submit">Update Post</button>
        </form>

        <!-- Back Link -->
        <a href="{{ route('posts.index') }}">Back to Posts</a>
    </div>
</body>
</html>
