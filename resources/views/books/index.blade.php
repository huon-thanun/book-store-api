<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Books Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
        }
        .stat-card {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 0.75rem;
            padding: 1.5rem;
            color: white;
            text-align: center;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-5px);
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0.5rem 0;
        }
        .stat-label {
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            opacity: 0.9;
        }
        .table-container {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }
        .table-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .table-header h5 {
            margin: 0;
            font-weight: 600;
            font-size: 1.5rem;
        }
        .table thead th {
            background: #f8f9fa;
            color: #495057;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            border: none;
            padding: 1rem;
        }
        .table tbody tr {
            border-bottom: 1px solid #e9ecef;
            transition: all 0.2s ease;
        }
        .table tbody tr:hover {
            background-color: #f8f9fa;
            box-shadow: inset 0 0 10px rgba(102, 126, 234, 0.05);
        }
        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
        }
        .book-title {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.25rem;
        }
        .book-date {
            font-size: 0.875rem;
            color: #718096;
        }
        .price-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            font-weight: 600;
            display: inline-block;
        }
        .category-badge {
            background: #e7f5ff;
            color: #1971c2;
            padding: 0.35rem 0.75rem;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.875rem;
        }
        .language-badge {
            background: #f0fdf4;
            color: #166534;
            padding: 0.35rem 0.75rem;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.875rem;
        }
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #718096;
        }
        .empty-state i {
            font-size: 3rem;
            color: #cbd5e0;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <!-- Hero Section -->
        <div class="hero-section">
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
                
                <!-- Stats Cards -->
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
        </div>

        <!-- Table -->
        <div class="container">
            <div class="table-container">
                <div class="table-header">
                    <h5><i class="bi bi-list-ul"></i> Complete Book List</h5>
                    <span class="badge bg-light text-dark">{{ $totalBooks ?? 0 }} entries</span>
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
                            <th>Language</th>
                            <th class="text-end">Pages</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                            <tr>
                                <td>
                                    <span class="badge bg-primary">{{ $book->id }}</span>
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
                                <td>
                                    <span class="language-badge"><i class="bi bi-globe"></i> {{ $book->bookDetail?->language ?? 'N/A' }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-secondary">{{ $book->bookDetail?->page_count ?? '0' }}</span>
                                </td>
                                <td style="max-width: 300px;">
                                    <small>{{ Str::limit($book->bookDetail?->description ?? $book->description ?? 'No description available.', 60) }}</small>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <h5>No books found</h5>
                                        <p>Please run the seeders to populate the database.</p>
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