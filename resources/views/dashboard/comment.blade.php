<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Foto - {{ $photo->judul }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .comment-container {
            margin-top: 20px;
        }

        .comment-header {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .comment-list {
            list-style-type: none;
            padding-left: 0;
        }

        .comment-item {
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            padding: 10px;
        }

        .comment-item .comment-text {
            margin-bottom: 5px;
        }

        .comment-item .commenter-name {
            font-weight: bold;
            color: #007bff;
        }

        .add-comment-form {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <a href="#" class="btn btn-primary mb-3" id="backButton"><i class="bi bi-arrow-left"></i></a>
        <!-- Detail Foto -->
        <div class="row">
            <div class="col-md-6">
                <img src="{{ $photo->lokasifoto }}" class="img-fluid" alt="Foto">
            </div>
            <div class="col-md-6">
                <h1>{{ $photo->judul }}</h1>
                <p>{{ $photo->deskripsi }}</p>
                <p><strong>Nama Album:</strong> {{ $photo->album->namaAlbum }}</p>
            </div>
        </div>

        <hr>

        <div class="row comment-container">
            <div class="col-md-12">
                <div class="comment-header">Komentar</div>
                @if ($commentsQuery->isEmpty())
                    <p>Tidak ada komentar yang tersedia.</p>
                @else
                    <ul class="comment-list">
                        @foreach ($commentsQuery as $comment)
                            <li class="comment-item">
                                <div class="comment-text">{{ $comment->comment }}</div>
                                <div class="commenter-name">Ditulis oleh: {{ $comment->commenter_name }}</div>
                            </li>
                        @endforeach
                    </ul>
                @endif
                <hr>
                <!-- Form untuk menambahkan komentar -->
                <form action="{{ route('add.comment', ['id' => $photo->id]) }}" method="POST" class="add-comment-form">
                    @csrf
                    <input type="hidden" name="foto_id" value="{{ $photo->id }}">
                    <input type="hidden" class="form-control" id="commenter_name" name="commenter_name"
                        value="{{ Auth::user()->name }}" required readonly>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Tambah Komentar:</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('backButton').addEventListener('click', function(e) {
            e.preventDefault();
            history.back();
        });
    </script>
</body>

</html>
