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
    <table class="table table-bordered table-striped">
        <thead class="thead-light">
            <tr>
                <th>name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
       
        <a href="{{ route('categories.create') }}">+ Add New Category</a>
        
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->name}}</td>
                  
                    <td>
                        <a href="{{route('categories.edit', $category->id) }}"  class="btn btn-warning btn-sm">Update</a>
                        
                        <form action="{{route('categories.destroy', $category->id) }}"  method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button  type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('blogs.index')}}" class="btn btn-info btn-sm">show all blogs</a>
</div>


</body>
</html>