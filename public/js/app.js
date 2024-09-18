angular.module('socialApp', [])
.controller('PostController', function($scope, $http) {
    $scope.posts = [];
    $scope.newPost = {};

    // Create a new post
    $scope.createPost = function() {
        $http.post('/api/posts', $scope.newPost)
        .then(function(response) {
            $scope.posts.unshift(response.data);
            $scope.newPost = {};
        }, function(error) {
            console.error('Error creating post', error);
            alert('Error creating post');
        });
    };

    // Get all posts
    $scope.getPosts = function() {
        $http.get('/api/posts')
        .then(function(response) {
            $scope.posts = response.data;
        }, function(error) {
            console.error('Error fetching posts', error);
            alert('Error fetching posts');
        });
    };

    // Like a post
    $scope.likePost = function(post) {
        $http.post('/api/posts/' + post.id + '/like')
        .then(function(response) {
            angular.extend(post, response.data); // Update post with new data
        }, function(error) {
            console.error('Error liking post', error);
            alert('Error liking post');
        });
    };

    // Add a comment to a post
    $scope.addComment = function(post) {
        $http.post('/api/posts/' + post.id + '/comments', { comment: post.newComment })
        .then(function(response) {
            post.comments.push(response.data);
            post.newComment = '';
        }, function(error) {
            console.error('Error adding comment', error);
            alert('Error adding comment');
        });
    };

    // Initialize posts
    $scope.getPosts();
});
