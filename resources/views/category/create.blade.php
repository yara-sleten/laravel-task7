<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to Categories List</a>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <lable for="name">name</lable><br>
        <input type="text" name="name" id=""><br>
        <button type="submit" >submit</button>

    </form>

</body>
</html>