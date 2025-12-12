<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Favorite Blogs</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Your Favorite Blogs</h1>

        @if($favorites->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($favorites as $fav)
                        <tr>
                            <td>{{ $fav->blog->title }}</td>
                            <td>{{ $fav->blog->content }}</td>
                            <td>
                                <img src="{{ asset('storage/blogs/' . $fav->blog->image) }}" alt="{{ $fav->blog->title }}" style="width: 100px; height: auto;">
                            </td>
                            <td>
                                <form action="{{ route('favorite.destroy', $fav->blog->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No favorites yet.</p>
        @endif
        <a href="{{ route('blogs.index') }}" class="btn btn-success">show all blogs</a>
    </div>
    
</body>
</html>
