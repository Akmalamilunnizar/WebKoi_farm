@extends('admin.layouts.template')
@section('page_title')
    SANKE | Halaman Ubah Profil Admin
@endsection
@section('search')
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            <form method="GET" action={{ route('searchusers') }} class="d-inline-block ms-2">
                <input type="text" name="search" class="form-control border-0 shadow-none ps-2"
                    placeholder="Pencarian Id atau nama..." value="{{ isset($search) ? $search : '' }}"
                    aria-label="Pencarian..." />
            </form>
        </div>
    </div>
@endsection

@section('content')

    <div class="container mt-4">
        <text class="btn btn-success ms-auto" style="background: linear-gradient(45deg, #28a745, #34d058);">
            Image Classifier
        </text>
        <style>
            /* Center the form and preview container */
            form.text-center {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                min-height: 50vh; /* Adjust as needed */
            }

            #preview {
                display: none;
                max-width: 300px;
                max-height: 300px;
                margin-top: 20px;
                border: 1px solid #ddd;
                object-fit: contain; /* Ensures the image is well-scaled */
            }

            button[type="submit"] {
                margin-top: 20px; /* Space between the preview and the button */
            }
        </style>
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Daftar Ikan Koi</h5>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <h1 class="text-center">Image Classifier</h1>

            <!-- Form to upload image -->
            <form action="{{ url('/admin/predict') }}" method="post" enctype="multipart/form-data" class="text-center">
                @csrf <!-- CSRF token for form security -->
                <input type="file" name="imagefile" accept="image/*" required onchange="previewImage(event)">
                <img id="preview" alt="Image Preview">
                <button type="submit">Predict Image</button>
            </form>

            <!-- Display prediction results -->
            @if (isset($prediction))
                <div class="text-center">
                    <h2>Prediction: {{ $prediction }}</h2>
                    <p>Probabilities:</p>
                    <ul>
                        @foreach ($classes_with_percentages as $class_name => $percentage)
                            <li>{{ $class_name }}: {{ $percentage }}%</li>
                        @endforeach
                    </ul>
                    <img src="{{ $image_url }}" alt="Uploaded Image" style="max-width: 300px; max-height: 300px;">
                </div>
            @endif

            <script>
                // Preview selected image
                function previewImage(event) {
                    const file = event.target.files[0];
                    const preview = document.getElementById('preview');
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                        }
                        reader.readAsDataURL(file);
                    }
                }
            </script>
            </body>
        </div>
    </div>


@endsection