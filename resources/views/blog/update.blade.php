<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update </title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2> update blog</h2>
        <form action="{{ route('blogs.update.submit', $blogs->id) }}" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>categories:</label><br>
             @foreach($categories as $category)
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="categories[]" value="{{ $category->id }}" {{  $blogs->categories->contains($category->id) ? 'checked' : '' }}>
                <label class="form-check-label">{{ $category->name }}</label>
            </div>
                @endforeach
            </div>

        @csrf
            @method('PUT')
            <div class="form-group">
            <label for="title">title:</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $blogs->title }}" required>
            </div>
            <div class="form-group">
            <label for="content">content:</label>
            <input type="text" class="form-control" name="content" id="content" value="{{ $blogs->content }}" required>
            </div>
            <div class="form-group">
                <label for="image">image:</label>
                <input type="file" class="form-control-file" name="image" id="image">
            </div>
            <button type="submit" class="btn btn-primary">update</button>
            <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Back to blogs List</a>
        </form>
    </div>
</body>
</html>
