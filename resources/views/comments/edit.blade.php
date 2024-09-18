<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Content</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #e0e0e0;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #1e1e1e;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: center;
        }
        h1 {
            color: #f00;
            margin-bottom: 20px;
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
            margin-top: 10px;
            border: 1px solid #f00;
            border-radius: 4px;
            padding: 5px;
            background-color: #333;
            color: #e0e0e0;
        }
        button {
            background-color: #f00;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #d00;
        }
        a {
            color: #f00;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            font-size: 16px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Edit Comment Section -->
        @isset($comment)
            <h1>Edit Comment</h1>
            <form action="{{ route('comments.update', $comment->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <textarea name="comment" rows="4" required>{{ old('comment', $comment->comment) }}</textarea>
                
                <!-- Display existing photo if available -->
                @if($comment->photo)
                    <img src="{{ asset('storage/' . $comment->photo) }}" alt="Comment Photo" style="max-width: 100%; border-radius: 8px; margin-top: 10px;">
                @endif
                
                <!-- File input for updating photo -->
                <input type="file" name="photo" accept="image/*">
                
                <!-- Submit button for updating the comment -->
                <button type="submit">Update Comment</button>
            </form>
            
            <!-- Form for deleting the comment -->
            <form action="{{ route('comments.delete', $comment->id) }}" method="POST" style="margin-top: 10px;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete Comment</button>
            </form>
        @endisset
        

        <!-- Back to Posts Link -->
        <a href="{{ route('posts.index') }}">Back to Posts</a>
    </div>
</body>
</html>
