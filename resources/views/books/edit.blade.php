<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Book</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --bg-soft: #f4f7ee;
            --bg-mesh-a: rgba(230, 110, 48, 0.16);
            --bg-mesh-b: rgba(13, 110, 120, 0.14);
            --panel: #ffffff;
            --ink: #16222d;
            --muted: #647481;
            --brand: #d65f2a;
            --brand-2: #0f7d74;
            --line: #d8e3d0;
        }
        body {
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            background:
                radial-gradient(circle at 10% 10%, var(--bg-mesh-a), transparent 40%),
                radial-gradient(circle at 85% 20%, var(--bg-mesh-b), transparent 40%),
                var(--bg-soft);
        }
        .form-shell {
            background: var(--panel);
            border-radius: 1.1rem;
            box-shadow: 0 18px 45px rgba(19, 36, 43, 0.12);
            overflow: hidden;
            border: 1px solid rgba(22, 34, 45, 0.06);
        }
        .form-header {
            color: white;
            padding: 1.5rem;
            background: linear-gradient(120deg, var(--brand-2), #19a193);
        }
        .form-body {
            padding: 1.5rem;
        }
        .form-label {
            color: var(--ink);
            font-weight: 600;
        }
        .form-control,
        .form-select {
            border-color: var(--line);
            padding: 0.65rem 0.85rem;
        }
        .form-control:focus,
        .form-select:focus {
            border-color: rgba(15, 125, 116, 0.6);
            box-shadow: 0 0 0 0.2rem rgba(15, 125, 116, 0.15);
        }
        .page-back {
            border-color: #c8d3bf;
            color: #44525f;
            font-weight: 600;
        }
        .page-back:hover {
            background: #ebf1e3;
            border-color: #c8d3bf;
            color: #34424e;
        }
        .btn-update {
            background: linear-gradient(120deg, var(--brand-2), #19a193);
            border: 0;
            color: #fff;
            font-weight: 600;
            padding-inline: 1rem;
        }
        .btn-update:hover {
            color: #fff;
            opacity: 0.92;
        }
        .btn-cancel {
            border-color: #c8d3bf;
            color: #44525f;
            font-weight: 600;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="mb-3">
            <a href="{{ route('books.ui') }}" class="btn page-back">
                <i class="bi bi-arrow-left"></i> Back to list
            </a>
        </div>

        <div class="form-shell">
            <div class="form-header">
                <h1 class="h3 mb-1"><i class="bi bi-pencil-square"></i> Edit Book</h1>
                <p class="mb-0">Update the selected book record.</p>
            </div>

            <div class="form-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Please fix the validation errors below.</strong>
                    </div>
                @endif

                <form action="{{ route('books.ui.update', $book->id) }}" method="POST" class="row g-4">
                    @csrf
                    @method('PUT')

                    <div class="col-md-6 col-lg-4">
                        <label class="form-label">Author</label>
                        <select name="author_id" class="form-select @error('author_id') is-invalid @enderror">
                            <option value="">Select author</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}" @selected(old('author_id', $book->author_id) == $author->id)>{{ $author->name }}</option>
                            @endforeach
                        </select>
                        @error('author_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                            <option value="">Select category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $book->category_id) == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-4">
                        <label class="form-label">Price</label>
                        <input type="number" name="price" value="{{ old('price', $book->price) }}" step="0.01" min="0" class="form-control @error('price') is-invalid @enderror" placeholder="0.00">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" value="{{ old('title', $book->title) }}" class="form-control @error('title') is-invalid @enderror" placeholder="Book title">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Book description">{{ old('description', $book->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 d-flex gap-2">
                        <button type="submit" class="btn btn-update">
                            <i class="bi bi-save"></i> Update Book
                        </button>
                        <a href="{{ route('books.ui') }}" class="btn btn-cancel">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>