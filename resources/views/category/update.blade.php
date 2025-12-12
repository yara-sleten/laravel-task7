<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Category</h2>
        <form action="{{ route('categories.update', $categories->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $categories->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary">update</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to Categories List</a>
        </form>
    </div>

</body>
</html>
