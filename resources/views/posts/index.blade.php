<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
body {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #121212;
    color: #e0e0e0;
}

.main-container {
    display: flex;
    width: 100%;
    max-width: 1900px; /* Maximum width for the layout */
    margin: 0; /* Remove margin to align centrally */
    padding: 0 20px; /* Add padding to prevent content from touching edges */
}

.left-sidebar, .right-sidebar {
    flex: 0 0 300px; /* Fixed width for sidebars */
    padding: 20px;
    background-color: #1e1e1e;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

.container {
    flex: 1; /* Fills the remaining space */
    padding: 20px;
    background-color: #1e1e1e;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    margin: 0 auto; /* Centers the container */
    max-width: calc(100% - 500px); /* Ensures it doesn't exceed the space between sidebars */
}

.profile-header {
    display: flex;
    align-items: center;
    border-bottom: 2px solid #f00;
    padding-bottom: 20px;
    margin-bottom: 20px;
}

.profile-header img {
    border-radius: 50%;
    width: 80px;
    height: 80px;
    object-fit: cover;
    margin-right: 20px;
}

.profile-header h1 {
    margin: 0;
    font-size: 24px;
    color: #f00;
}

.profile-details {
    margin-bottom: 20px;
}

.profile-details p {
    background-color: #333;
    border: 1px solid #f00;
    border-radius: 4px;
    padding: 10px;
    margin-bottom: 10px;
    color: #e0e0e0;
}

.profile-details p span {
    font-weight: bold;
    color: #f00;
}

.profile-details p span.email, 
.profile-details p span.age, 
.profile-details p span.birthday {
    color: #f00;
    font-weight: bold;
}

.edit-profile-btn {
    display: block;
    width: calc(100% - 22px); /* Adjusted to fit within padding */
    background-color: #f00;
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 4px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    font-size: 16px;
    margin-top: 10px; /* Added margin for spacing */
}

.edit-profile-btn:hover {
    background-color: #d00;
}

.go-back-btn {
    display: block;
    width: calc(100% - 22px); /* Adjusted to fit within padding */
    background-color: #f00;
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 4px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    font-size: 16px;
    margin-top: 10px; /* Added margin for spacing */
}

.go-back-btn:hover {
    background-color: #d00;
}

.container {
    flex: 1;
    max-width: 800px;
    margin: 0 10px;
    padding: 20px;
    background-color: #1e1e1e;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

.post {
    background-color: #1e1e1e;
    border: 1px solid #f00;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
    display: flex;
    align-items: flex-start;
}

.post .profile-info {
    margin-right: 15px;
}

.post .profile-info img {
    border-radius: 50%;
    width: 60px;
    height: 60px;
    object-fit: cover;
}

.post .content {
    flex: 1;
}

.post h3 {
    margin-top: 0;
    color: #f00;
}

.post p {
    color: #e0e0e0;
}

.post img {
    max-width: 100%;
    height: auto;
    margin-top: 10px;
    border-radius: 8px;
}

.like-btn, .comment-btn, .edit-btn, .delete-btn {
    background-color: #f00;
    color: #fff;
    border: none;
    padding: 8px 12px;
    border-radius: 4px;
    cursor: pointer;
    margin-right: 10px;
    font-size: 14px;
}

.like-btn:hover, .comment-btn:hover, .edit-btn:hover, .delete-btn:hover {
    background-color: #d00;
}

.comments {
    border-top: 1px solid #f00;
    padding-top: 10px;
    margin-top: 10px;
}

.comment {
    background-color: #2c2c2c;
    border: 1px solid #f00;
    border-radius: 4px;
    padding: 10px;
    margin-bottom: 10px;
    display: flex;
    align-items: flex-start;
}

.comment .profile-info {
    margin-right: 10px;
}

.comment .profile-info img {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    object-fit: cover;
}

.comment p {
    margin: 0;
}

.create-post-form, .add-comment-form {
    margin-bottom: 20px;
}

textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #f00;
    border-radius: 4px;
    background-color: #333;
    color: #e0e0e0;
}

input[type="file"] {
    margin-top: 10px;
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

.right-sidebar {
    text-align: left;
}
.content {
    flex: 1;
    padding: 20px;
    background-color: #1e1e1e;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

.right-sidebar h2 {
    margin-bottom: 15px;
    color: #f00;
    font-size: 22px;
    border-bottom: 2px solid #f00;
    padding-bottom: 10px;
}

.right-sidebar .user-box {
    background-color: #1e1e1e;
    border: 1px solid #f00;
    border-radius: 8px;
    padding: 10px;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
}

.right-sidebar .user-box img {
    border-radius: 50%;
    width: 60px;
    height: 60px;
    object-fit: cover;
    margin-right: 15px;
}

.right-sidebar .user-box span {
    color: #e0e0e0;
    font-size: 18px;
}
.logout-container {
    text-align: center;
    margin-top: 20px;
}

.logout-container p {
    color: #e0e0e0;
    font-size: 16px;
    margin-bottom: 10px;
}

.logout-btn {
    background-color: #d00;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    display: block;
    width: 150px; /* Adjust width as needed */
    margin: 0 auto; /* Center the button */
    color: #fff;
    text-decoration: none;
    text-align: center;
}
    </style>
</head>
<body>
    <div class="main-container">
    <div class="left-sidebar">
    <div class="profile-header">
        @if(Auth::user()->profile_picture)
            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture">
        @else
            <div style="width: 80px; height: 80px; background-color: #333; border-radius: 50%;"></div>
        @endif
        <h1>{{ Auth::user()->name }}</h1>
    </div>
    <div class="profile-details">
        <p><span>Email:</span> {{ Auth::user()->email }}</p>
        <p><span>Gender:</span> {{ Auth::user()->gender }}</p>
        <p><span>Address:</span> {{ Auth::user()->address }}</p>
        <p><span>Occupation:</span> {{ Auth::user()->occupation }}</p>
        <p><span>Nationality:</span> {{ Auth::user()->nationality }}</p>
        <p><span>Birthday:</span> {{ Auth::user()->birthday }}</p>
        <p><span>Age:</span> {{ Auth::user()->age }}</p>
    </div>
    <a href="{{ url('/profile') }}" class="edit-profile-btn">Edit Profile</a>
    <a href="{{ url('/') }}" class="edit-profile-btn">Go back to dashboard?</a>
    
</div>



        <!-- Main Content -->
        <div class="container">
            <!-- User Profile Header -->
            <div class="profile-header"></div>

           <!-- Create New Post Form -->
<div class="create-post-form">
    <h2>Create a New Post</h2>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <textarea name="content" rows="4" placeholder="What's on your mind?" required></textarea>
        <input type="file" name="media" accept="image/*,video/*"> <!-- Single file input for both images and videos -->
        <button type="submit">Post</button>
    </form>
</div>


          <!-- Displaying Posts -->
@if($posts->isEmpty())
    <p>No posts available.</p>
@else
    @foreach($posts as $post)
        <div class="post" id="post-{{ $post->id }}">
            <div class="profile-info">
                @if($post->user->profile_picture)
                    <img src="{{ asset('storage/' . $post->user->profile_picture) }}" alt="Profile Picture">
                @else
                    <div style="width: 60px; height: 60px; background-color: #333; border-radius: 50%;"></div>
                @endif
            </div>
            <div class="content">
                <h3>{{ $post->user->name ?? 'Unknown User' }}</h3>
                <p>{{ $post->content }}</p>
                @if($post->photo)
                    <img src="{{ asset('storage/' . $post->photo) }}" alt="Post Photo">
                @endif

                @if($post->video)
    <video width="640" height="480" controls>
        <source src="{{ asset('storage/' . $post->video) }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
@endif


                <!-- Displaying Like Button -->
                <button class="like-btn" data-post-id="{{ $post->id }}">
                    Like ({{ $post->likes_count }})
                </button>

                <!-- Post Edit and Delete Links -->
                @if($post->user_id === auth()->id())
                    <a href="{{ route('posts.edit', $post->id) }}" class="edit-btn">Edit Post</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">Delete Post</button>
                    </form>
                @endif

                <!-- Displaying Comments -->
                <div class="comments">
                    <h4>Comments:</h4>
                    @forelse($post->comments as $comment)
                        <div class="comment">
                            <div class="profile-info">
                                @if($comment->user->profile_picture)
                                    <img src="{{ asset('storage/' . $comment->user->profile_picture) }}" alt="Profile Picture">
                                @else
                                    <div style="width: 40px; height: 40px; background-color: #333; border-radius: 50%;"></div>
                                @endif
                            </div>
                            <div class="content">
                                <p>{{ $comment->user->name ?? 'Unknown User' }}: {{ $comment->comment }}</p>
                                @if($comment->photo)
                                    <img src="{{ asset('storage/' . $comment->photo) }}" alt="Comment Photo">
                                @endif

                                <!-- Edit and Delete Comment Links -->
                                @if($comment->user_id === auth()->id())
                                    <a href="{{ route('comments.edit', $comment->id) }}" class="edit-btn">Edit</a>
                                    <form action="{{ route('comments.delete', $comment->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p>No comments yet.</p>
                    @endforelse
                </div>

                <!-- Add Comment Form -->
                <form action="{{ route('posts.comment', $post->id) }}" method="POST" enctype="multipart/form-data" class="add-comment-form">
                    @csrf
                    <textarea name="comment" rows="3" placeholder="Add a comment..." required></textarea>
                    <input type="file" name="photo" accept="image/*">
                    <button type="submit" class="comment-btn">Submit Comment</button>
                </form>
            </div>
        </div>
    @endforeach
@endif

        </div>

<!-- Right Sidebar: Other Users -->
<div class="right-sidebar">
    <h2>Other Registered Users</h2>
    @if($otherUsers->isEmpty())
        <p>No other users available.</p>
    @else
        @foreach($otherUsers as $user)
            <div class="user-box">
                @if($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture">
                @else
                    <div style="width: 60px; height: 60px; background-color: #333; border-radius: 50%;"></div>
                @endif
                <span>{{ $user->name }}</span>
            </div>
            
        @endforeach
    @endif
</div>
<div class="logout-container">
        <!-- Logout Button -->
        <form action="{{ route('logout') }}" method="POST" class="logout-btn">
            @csrf
            <button type="submit">Logout</button>
        </form>
        <p>Thank you for visiting! See you soon.</p>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.like-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const postId = this.getAttribute('data-post-id');
                    fetch(`/posts/${postId}/like`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({ _method: 'POST' }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.liked) {
                            this.textContent = `Unlike (${data.likes_count})`;
                        } else {
                            this.textContent = `Like (${data.likes_count})`;
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
</body>
