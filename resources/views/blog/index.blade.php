<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class=" mt-5">
<form action="{{route('blogs.index')}}" method="GET">
    <select name="category_id">
        <option value="">Choose category</option>
        @foreach($categories as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
    <button type="submit"  class="btn btn-danger btn-sm">filter</button>
    <a href="{{ route('blogs.index') }}" class="btn btn-info">show all blogs</a>
</form>
</br>
@if(Auth::user()->role == 'admin')
<div class="mb-3">
    <a href="{{ route('blogs.create') }}" class="btn btn-info">+ New Blog</a>
    <a href="{{ route('blogs.trash') }}" class="btn btn-warning">Trash </a>
</div>
@endif
    <table class="table table-bordered table-striped">
        <thead class="thead-light">
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($blogs as $blog)
            <tr>
                <td>{{ $blog->title }}</td>
                <td>{{ $blog->content }}</td>
                <td>
                    <img src="{{ asset('storage/blogs/' . $blog->image) }}" alt="{{ $blog->title }}" style="width: 100px; height: auto;">
                </td>
                <td>
                @if(Auth::user()->role == 'user')
                    <form action="{{ route('favorite.store', $blog->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Add to Favorite</button>
                    </form>
                    @endif  
                    <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-info btn-sm">Details</a>
                    @if(Auth::user()->role == 'admin')
                        <a href="{{ route('blogs.update', $blog->id) }}" class="btn btn-warning btn-sm">Update</a>

                        <form action="{{ route('blogs.delete', $blog->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>

                    @endif
                </td>
            </tr>
        @endforeach
</tbody>

</table>
@if(Auth::user()->role == 'user')
<a href="{{ route('favorite.index')}}" class="btn btn-info btn-sm">my favorite list</a>
@endif
@if(Auth::user()->role == 'admin')
<a href="{{ route('categories.index') }}" class="btn btn-secondary">show all Categories </a>
@endif
</div>



</body>
</html>
