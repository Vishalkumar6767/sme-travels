@extends('sme_Cpanel.layout')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Testimonial</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/index') }}">Home</a></li>
                <li class="breadcrumb-item active">Edit Testimonial</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Update Testimonial</h5>
                       
                        <!-- Vertical Form -->
                        <form class="row g-3" id="editTestimonialForm" method="POST" enctype="multipart/form-data" >
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="testimonialId" value="{{ $testimonial->id }}">
                            <div class="col-6">
                                <label for="imageUpload" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" accept="image/jpg, image/jpeg, image/png" id="imageUpload" >
                            </div>
                            <div class="col-6">
                                <label for="inputName" class="form-label">Name</label>
                                <input type="text" class="form-control" name="title" id="inputName" value="{{ $testimonial->title }}" required>
                            </div>
                           
                               
                                <div class="col-6">
                                    <img src="{{ asset('storage/assets/' . $testimonial->image) }}" height="300" width="300" alt="Current Facility Image">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form><!-- End Vertical Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->
@push('scripts')
<script>
     document.querySelector('#editTestimonialForm').addEventListener('submit', async function (event) {
        event.preventDefault();  // Prevent default form submission
        
        const formData = new FormData(event.target);
        const urlParts = window.location.pathname.split('/');
        const testimonialId = urlParts[urlParts.length - 1];

        try {
            const response = await fetch(`/api/v1/home_testimonial/${testimonialId}`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('api_token')}`,
                    'Accept': 'application/json',
                },
                body: formData  // Form data
            });

            if (!response.ok) {
                const errorData = await response.json();
                console.error('Error updating Testimonial:', errorData);
                alert('Failed to update Testimonial.');
                return;
            }

            alert('Facility updated successfully!');
            window.location.href = 'http://127.0.0.1:8000/dynamic/sme_Cpanel/home_testimonial'; // Redirect after success

        } catch (error) {
            console.error('Error updating testimonial:', error);
            alert('An error occurred while updating the testimonial.');
        }
    });
</script>
    
@endpush

@endsection
