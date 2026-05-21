<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Books Table</title>
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
            --line: #e7ecdf;
        }
        body {
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            background:
                radial-gradient(circle at 10% 10%, var(--bg-mesh-a), transparent 40%),
                radial-gradient(circle at 85% 20%, var(--bg-mesh-b), transparent 40%),
                var(--bg-soft);
        }
        .table-container {
            background: var(--panel);
            border-radius: 1.1rem;
            box-shadow: 0 18px 45px rgba(19, 36, 43, 0.12);
            overflow: hidden;
            border: 1px solid rgba(22, 34, 45, 0.06);
        }
        .table-header {
            color: white;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(120deg, var(--brand), var(--brand-2));
        }
        .table-header h5 {
            margin: 0;
            font-weight: 700;
            font-size: 1.35rem;
            letter-spacing: 0.02em;
        }
        .table thead th {
            background: #f8fbf3;
            color: #4b5c64;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            border: none;
            padding: 1rem;
        }
        .table tbody tr {
            border-bottom: 1px solid var(--line);
            transition: all 0.25s ease;
        }
        .table tbody tr:hover {
            background-color: #f9fcf5;
            box-shadow: inset 0 0 0 999px rgba(214, 95, 42, 0.03);
        }
        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            color: var(--ink);
        }
        .book-title {
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 0.25rem;
        }
        .book-date {
            font-size: 0.875rem;
            color: var(--muted);
        }
        .price-badge {
            color: white;
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            font-weight: 600;
            display: inline-block;
            background: linear-gradient(120deg, var(--brand), #ee8a2b);
        }
        .category-badge {
            background: #e8f8f6;
            color: #0f7d74;
            padding: 0.35rem 0.75rem;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.875rem;
        }
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--muted);
        }
        .empty-state i {
            font-size: 3rem;
            color: #c2ccbf;
            margin-bottom: 1rem;
        }
        .create-btn {
            border: 1px solid rgba(255, 255, 255, 0.65);
            color: #ffffff;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.14);
        }
        .create-btn:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.24);
        }
        .btn-edit {
            background: #ecb130;
            border-color: #ecb130;
            color: #ffffff;
        }
        .btn-edit:hover {
            background: #d99f25;
            border-color: #d99f25;
            color: #ffffff;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid py-4">
        @if (session('success'))
            <div class="container mb-3">
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <!-- Hero Section -->
        <!-- <div class="hero-section">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-md-8">
                        <h1 class="display-4 fw-bold mb-2">
                            <i class="bi bi-book"></i> Book Store Catalog
                        </h1>
                        <p class="lead mb-0">Explore our collection of books with detailed information</p>
                    </div>
                    <div class="col-md-4">
                        <div class="text-end">
                            <div class="stat-number">{{ $totalBooks ?? 0 }}</div>
                            <div class="stat-label">Total Books</div>
                        </div>
                    </div>
                </div>
                
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="stat-card">
                            <i class="bi bi-book-half" style="font-size: 1.5rem;"></i>
                            <div class="stat-number">{{ $totalBooks ?? 0 }}</div>
                            <div class="stat-label">Books</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <i class="bi bi-person" style="font-size: 1.5rem;"></i>
                            <div class="stat-number">{{ $totalAuthors ?? 0 }}</div>
                            <div class="stat-label">Authors</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <i class="bi bi-tag" style="font-size: 1.5rem;"></i>
                            <div class="stat-number">{{ $totalCategories ?? 0 }}</div>
                            <div class="stat-label">Categories</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <i class="bi bi-check-circle" style="font-size: 1.5rem;"></i>
                            <div class="stat-number">{{ $totalWithDetails ?? 0 }}</div>
                            <div class="stat-label">With Details</div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Table -->
        <div class="container">
            <div class="table-container">
                <div class="table-header">
                    <h5><i class="bi bi-list-ul"></i> Complete Book List</h5>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge text-bg-light">{{ $totalBooks ?? 0 }} entries</span>
                        <a href="{{ route('books.ui.create') }}" class="btn create-btn btn-md">
                            <i class="bi bi-plus-circle"></i> Create Book
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                        <tr>
                            <th style="width: 70px;">#</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th class="text-end">Price</th>
                            <th>Description</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                            <tr>
                                <td>
                                    <span class="badge" style="background-color: #0f7d74;">{{ $book->id }}</span>
                                </td>
                                <td>
                                    <div class="book-title"><i class="bi bi-book"></i> {{ $book->title }}</div>
                                    <div class="book-date">{{ $book->created_at?->format('M d, Y') ?? 'N/A' }}</div>
                                </td>
                                <td>
                                    <i class="bi bi-person-circle"></i> {{ $book->author->name ?? 'Unknown author' }}
                                </td>
                                <td>
                                    <span class="category-badge">{{ $book->category->name ?? 'Uncategorized' }}</span>
                                </td>
                                <td class="text-end">
                                    <div class="price-badge">${{ number_format((float) $book->price, 2) }}</div>
                                </td>
                                <td style="max-width: 300px;">
                                    <small>{{ \Illuminate\Support\Str::limit($book->bookDetail?->description ?? $book->description ?? 'No description available.', 60) }}</small>
                                </td>
                                <td class="text-center">
                                    <div class="" role="group">
                                        <a href="{{ route('books.ui.edit', $book->id) }}" class="btn btn-edit w-100 fw-semibold mb-2">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <form action="{{ route('books.ui.destroy', $book->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this book?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger w-100 text-white fw-semibold">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <h5>No books found</h5>
                                        <p>Use the create button to add the first book.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>