<!DOCTYPE html>
<html>
<head>
    <title>Trash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h5>Deleted Blogs</h5>
    
    @if(session('message'))
        <div class="alert alert-info">{{ session('message') }}</div>
    @endif

    @forelse($blogs as $blog)
        <div class="border p-3 mb-2">
            <div class="d-flex justify-content-between">
                <div>
                    <strong>{{ $blog->title }}</strong>
                    <br>
                    <small class="text-muted">Deleted: {{ $blog->deleted_at->format('M d') }}</small>
                </div>
                <div>
                    <form action="{{ route('blogs.restore', $blog->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-success">Restore</button>
                    </form>
                    <form action="{{ route('blogs.force-delete', $blog->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">Trash is empty.</p>
    @endforelse

    <a href="{{ route('blogs.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
</body>
</html>