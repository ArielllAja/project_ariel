<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-blueGrey">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard.index') }}">Gallery Foto</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @guest
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                    @endguest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('album') }}">Album</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('foto') }}">Foto</a>
                    </li>
                </ul>
            </div>
            <div class="navbar-nav ms-auto">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-info" style="margin-right: 10px;">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-">Register</a>
                @else
                    <a href="{{ route('logout') }}" class="btn btn-info">Logout</a>
                @endguest
            </div>
        </div>
    </nav>



    <div class="container mt-4">
        <div class="row">
            @foreach ($photos as $photo)
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm">
                        <img src="{{ asset($photo->lokasifoto) }}" class="card-img-top rounded-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $photo->judul }}</h5>
                            <p class="card-text">{{ $photo->deskripsi }}</p>
                            <div class="d-flex justify-content-start">
                                <div>
                                    <p class="card-text me-2">{{ $likesCounts[$photo->id] }} Likes</p>
                                </div>
                                <div>
                                    <p class="card-text">{{ $commentsCounts[$photo->id] }} Comments</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-start align-items-center">
                            <form action="{{ route('like', ['id' => $photo->id]) }}" method="POST"
                                style="margin-right: 15px">
                                @csrf
                                <input type="hidden" name="foto_id" value="{{ $photo->id }}">
                                <button type="submit" class="btn-like">
                                    <i class="far fa-heart"></i> Like
                                </button>
                            </form>
                            <a style="color: black; text-decoration: none"
                                href="{{ route('comment', ['id' => $photo->id]) }}"><i class="far fa-comment"></i>
                                Comment</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
