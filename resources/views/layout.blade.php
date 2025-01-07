<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Post CRUD')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- JavaScript -->

</head>
<body>


        <nav class="navbar p-4  navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand " href={{route("posts.index")}}>Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href={{route('posts.index')}}>home</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href={{route('posts.create')}}>create post</a>
                    </li>
              @can('manageTag',$tag)
                    <li class="nav-item">
                        <a class="nav-link"  href={{route('tags.index')}}>mange tags</a>
                    </li>
                @endcan
                @can('manageCategory',$category)
                <li class="nav-item">
                    <a class="nav-link" href={{route('categories.index')}}>mange categories</a>
                </li>

                @endcan


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                         you
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href={{route('users.index')}}>account</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // كود الفلترة
    document.getElementById("filterForm").addEventListener("submit", function(event) {
        event.preventDefault();

        const selectedCategory = document.getElementById("category").value;
        const selectedTags = Array.from(document.getElementById("tags").selectedOptions).map(option => option.value);

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
