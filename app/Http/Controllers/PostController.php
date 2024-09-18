<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use App\Models\User;

class PostController extends Controller
{
    // Show a list of posts with their likes and comments
    public function index()
    {
        // Fetch posts with their likes and comments, ordered by creation date (newest first)
        $posts = Post::with('user', 'comments.user')
            ->orderBy('created_at', 'desc') // Sort posts by creation date in descending order
            ->get();
    
        $otherUsers = User::where('id', '!=', auth()->id())->get(); // Get all users except the current user
        
        return view('posts.index', compact('posts', 'otherUsers'));
    }
        
    // Store a newly created post in the database
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'media' => 'nullable|mimes:jpeg,png,jpg,mp4,avi,mkv|max:100000', // Validate both image and video files
        ]);
    
        $post = new Post();
        $post->content = $request->input('content');
    
        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $fileExtension = $file->getClientOriginalExtension();
    
            if (in_array($fileExtension, ['jpg', 'jpeg', 'png'])) {
                // Handle image upload
                $photoPath = $file->store('photos', 'public');
                $post->photo = $photoPath;
                $post->video = null; // Ensure video field is cleared if an image is uploaded
            } elseif (in_array($fileExtension, ['mp4', 'avi', 'mkv'])) {
                // Handle video upload
                $videoPath = $file->store('videos', 'public');
                $post->video = $videoPath;
                $post->photo = null; // Ensure photo field is cleared if a video is uploaded
            }
        }
    
        $post->user_id = auth()->id();
        $post->save();
    
        return redirect()->route('posts.index');
    }
            // Show the form for creating a new post (currently not used if integrated into index)
    public function create()
    {
        return view('posts.create');
    }

    // Display a specific post (for API or detailed view, not needed in this case)
    public function show($id)
    {
        $post = Post::with('user', 'likes', 'comments.user')->findOrFail($id);
        return response()->json($post);
    }

    // Show the form for editing a post
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        // Ensure the user owns the post
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized access.');
        }

        return view('posts.edit', compact('post'));
    }

    // Update a specific post
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->content = $request->input('content');
    
        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $fileExtension = $file->getClientOriginalExtension();
    
            if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                // Handle image upload
                $path = $file->store('photos', 'public');
                $post->photo = $path;
                $post->video = null; // Ensure video field is cleared if an image is uploaded
            } elseif (in_array($fileExtension, ['mp4', 'avi', 'mov'])) {
                // Handle video upload
                $path = $file->store('videos', 'public');
                $post->video = $path;
                $post->photo = null; // Ensure photo field is cleared if a video is uploaded
            }
        }
    
        $post->save();  
    
        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }
    
    // Delete a specific post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Ensure the user owns the post
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized access.');
        }

        // Delete associated photo or video if they exist
        if ($post->photo) {
            Storage::delete('public/' . $post->photo);
        }
        if ($post->video) {
            Storage::delete('public/' . $post->video);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    // Handle the liking/unliking of a post
    public function likePost($id)
    {
        $post = Post::findOrFail($id);
        $user = auth()->user();

        // Check if the user has already liked the post
        $like = $post->likes()->where('user_id', $user->id)->first();

        if ($like) {
            // User has already liked the post, so remove the like
            $like->delete();
        } else {
            // Add a new like
            Like::create([
                'post_id' => $post->id,
                'user_id' => $user->id
            ]);
        }

        // Get the updated like count
        $likes_count = $post->likes()->count();

        return response()->json([
            'likes_count' => $likes_count,
            'liked' => !$like, // Indicates if the post is liked or not
        ]);
    }

    // Add a comment to a specific post
    public function addComment(Request $request, $postId)
    {
        $request->validate([
            'comment' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);
    
        $comment = new Comment();
        $comment->comment = $request->input('comment');
    
        // Handle file upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('comments', 'public');
            $comment->photo = $photoPath;
        }
    
        $comment->post_id = $postId;
        $comment->user_id = auth()->id();
        $comment->save();
    
        return redirect()->route('posts.index');
    }
    
    // Show the form for editing a comment
    public function editComment($id)
    {
        $comment = Comment::findOrFail($id);

        // Check if the authenticated user is the owner of the comment
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('comments.edit', compact('comment'));
    }

    // Update a specific comment in the database
    public function updateComment(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        // Validate input
        $request->validate([
            'comment' => 'required|string',
            'photo' => 'nullable|image|max:2048', // Validate that it's an image
        ]);

        // Update the comment content
        $comment->comment = $request->input('comment');

        // Handle the image upload
        if ($request->hasFile('photo')) {
            // Log the file upload
            \Log::info('Uploading new photo for comment ID ' . $id);

            // Delete the old photo from storage if it exists
            if ($comment->photo) {
                \Log::info('Deleting old photo: ' . $comment->photo);
                Storage::delete('public/comments/' . $comment->photo);
            }

            // Store the new photo in the 'comments' directory
            $path = $request->file('photo')->store('comments', 'public');
            
            // Update the comment's photo path with the 'comments/' prefix
            $comment->photo = 'comments/' . basename($path);
        }

        // Save the comment
        $comment->save();

        // Redirect back with a success message
        return redirect()->route('posts.index')->with('success', 'Comment updated successfully.');
    }

    // Delete a specific comment
    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);

        // Check if the authenticated user is the owner of the comment
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return redirect()->route('posts.index')->with('success', 'Comment deleted successfully.');
    }

    public function updateBackgroundPhoto(Request $request)
    {
        // Validate that the uploaded file is an image
        $request->validate([
            'back_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if a background photo was uploaded
        if ($request->hasFile('back_photo')) {
            $backPhotoPath = $request->file('back_photo')->store('profile_photos', 'public');

            // Delete the old background photo if it exists
            if (Auth::user()->back_photo) {
                Storage::disk('public')->delete(Auth::user()->back_photo);
            }

            // Update the user's background photo path in the database
            Auth::user()->update(['back_photo' => $backPhotoPath]);
        }

        // Redirect back with a success message
        return redirect()->route('profile.edit')->with('success', 'Background photo updated successfully.');
    }
}
