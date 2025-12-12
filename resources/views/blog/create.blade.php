<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Add new blog</h2>
        <form action="{{ route('blogs.create') }}" method="POST" enctype="multipart/form-data"> 
            @csrf
            
            <div class="form-group">
                <label>categories:</label><br>
                @foreach($categories as $category)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="categories[]" value="{{ $category->id }}" {{ isset($blog) && $blog->categories->contains($category->id) ? 'checked' : '' }}>
                        <label class="form-check-label">{{ $category->name }}</label>
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <label for="title">title:</label>
                <input type="text" class="form-control" name="title" id="title" required>
            </div>
            <div class="form-group">
                <label for="content">content:</label>
                <textarea class="form-control" name="content" id="content" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">image:</label>
                <input type="file" class="form-control-file" name="image" id="image">
            </div>
            <button type="submit" class="btn btn-primary">send</button>
        </form>
    </div>


</body>
</html>
