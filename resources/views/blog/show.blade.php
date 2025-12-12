<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Blog Details</h2>
        <table class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Field</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Title</td>
                    <td>{{ $blog->title }}</td>
                </tr>
                <tr>
                    <td>Content</td>
                    <td>{{ $blog->content }}</td>
                </tr>
                <tr>
                    <td>Image</td>
                    <td>
                        @if($blog->image)
                            <img src="{{ asset('storage/blogs/' . $blog->image) }}" alt="{{ $blog->title }}" style="width: 100px; height: auto;">
                        @else
                            No image available
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Categories</td>
                    <td>
                        @if($blog->categories->count())
                            <ul>
                                @foreach($blog->categories as $cat)
                                    <li>{{ $cat->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>No category assigned.</p>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <a href="{{ route('blogs.index') }}" class="btn btn-primary">Back to Blog List</a>
    </div>

</body>
</html>
