<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Post CRUD')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('posts.index') }}">My Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-light fw-semibold" href="{{ route('posts.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light fw-semibold" href="{{ route('posts.create') }}">Create Post</a>
                    </li>
                    @can('manageTag', $tag)
                    <li class="nav-item">
                        <a class="nav-link text-light fw-semibold" href="{{ route('tags.index') }}">Manage Tags</a>
                    </li>
                    @endcan
                    @can('manageCategory', $category)
                    <li class="nav-item">
                        <a class="nav-link text-light fw-semibold" href="{{ route('categories.index') }}">Manage Categories</a>
                    </li>
                    @endcan
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            You
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @if (Auth::user())
                            <li><a class="dropdown-item" href="{{ route('user.profile', ['user' => Auth::user()]) }}">Account</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <h1 class="text-center mb-4">@yield('title', 'Post CRUD')</h1>
        <div class="row">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-light text-center py-4 mt-5">
        <p class="mb-0">© 2025 My Blog. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Filtering Logic (Optional)
    document.getElementById("filterForm")?.addEventListener("submit", function(event) {
        event.preventDefault();
        const selectedCategory = document.getElementById("category")?.value;
        const selectedTags = Array.from(document.getElementById("tags")?.selectedOptions || []).map(option => option.value);

        const posts = document.querySelectorAll(".post");
        posts.forEach(post => {
            const postCategory = post.getAttribute("data-category");
            const postTags = post.getAttribute("data-tags").split(',');

            const isCategoryMatch = !selectedCategory || postCategory === selectedCategory;
            const isTagsMatch = selectedTags.every(tag => postTags.includes(tag));

            post.style.display = isCategoryMatch && isTagsMatch ? "block" : "none";
        });
    });
    </script>
</body>
</html>
