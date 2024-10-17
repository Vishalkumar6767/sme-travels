@extends('sme_Cpanel.layout')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Vision & Mission</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">Home</a></li>
                    <li class="breadcrumb-item">Vision & Mission</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Vision & Mission</h5>
                            <div id="response-message"></div>
                            <form class="row g-3" id="update-form" enctype="multipart/form-data">
                                {{-- @csrf
                                @method('PUT') --}}
                                <div class="col-12">
                                    <label for="vision" class="form-label">Vision</label>
                                    <textarea name="vision" rows="5" id="vision" class="form-control">{{ old('vision', $data->vision) }}</textarea>
                                </div>

                                <div class="col-12">
                                    <label for="mission" class="form-label">Mission</label>
                                    <textarea name="mission" rows="5" id="mission" class="form-control">{{ old('mission', $data->mission) }}</textarea>
                                </div>

                                <div class="col-12">
                                    <label for="core_value" class="form-label">Core Values</label>
                                    <textarea name="core_value" rows="5" id="core_value" class="form-control">{{ old('core_value', $data->core_value) }}</textarea>
                                </div>

                                <div class="text-left">
                                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form><!-- Vertical Form -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Ensure jQuery is loaded -->
    
    <script>
       $(document).ready(function() {
    $('#update-form').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        const formData = new FormData(this); // Create form data object
        const url = "{{ route('vision-mission.update', $data->id) }}"; // Use the updated route name

        // Get CSRF token from the meta tag
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Log FormData for debugging
        for (const [key, value] of formData.entries()) {
            console.log(key, value);
        }

        $.ajax({
            type: 'PUT', // Use PUT method for updating
            url: url, // URL for the update request
            data: formData,
            processData: false, // Prevent jQuery from processing FormData
            contentType: false, // Prevent jQuery from overriding the contentType
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken // Include CSRF token in request headers
            },
            success: function(response) {
                $('#response-message').html('<div class="alert alert-success">' +
                    response.message + '</div>');
            },
            error: function(xhr, status, error) {
                if (xhr.status === 400) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = '';

                    for (const key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            errorMessage += errors[key].join('<br>') + '<br>';
                        }
                    }

                    $('#response-message').html('<div class="alert alert-danger">' +
                        errorMessage + '</div>');
                } else {
                    console.error(xhr.responseText);
                }
            }
        });
    });
});

    </script>
@endsection
