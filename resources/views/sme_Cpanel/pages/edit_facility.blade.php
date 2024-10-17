@extends('sme_Cpanel.layout')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Feature</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/index') }}">Home</a></li>
                <li class="breadcrumb-item">Feature</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Update Feature</h5>
                        
                        <!-- Update Form -->
                        <form class="row g-3" method="POST" id="editFacilityForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- Use PUT for updates -->
                            <input type="hidden" id="facilityId" value="{{ $facility->id }}">

                            <div class="col-6">
                                <label for="facilityName" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="facilityName" value="{{ $facility->name }}" required>
                            </div>

                            <div class="col-6">
                                <label for="imageUpload" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" accept="image/jpg, image/jpeg, image/png, image/svg" id="imageUpload" onchange="fileValidation(this)">
                            </div>

                            <div class="col-12">
                                <label for="facilityDescription" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="facilityDescription" required>{{ $facility->description }}</textarea>
                            </div>

                            <div class="col-6">
                                <img src="{{ asset('storage/assets/' . $facility->image) }}" height="300" width="300" alt="Current Facility Image">
                            </div>

                            <div class="text-left">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form><!-- End Update Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', async () => {
        const urlParts = window.location.pathname.split('/');
        const featureId = urlParts[urlParts.length - 1]; // Extract ID from the URL

        try {
            // Fetch the facility data
            const response = await fetch(`/api/v1/feature/${featureId}/edit`);
            
            if (!response.ok) {
                throw new Error('Failed to fetch facility data.');
            }

            const facility = await response.json();
            // Populate the form fields with the fetched data
            document.querySelector('#facilityName').value = facility.name;
            document.querySelector('#facilityDescription').value = facility.description;

        } catch (error) {
            console.error('Error fetching facility data:', error);
            alert('Failed to load facility data.');
        }
    });

    // Handle form submission via AJAX
    document.querySelector('#editFacilityForm').addEventListener('submit', async function (event) {
        event.preventDefault();  // Prevent default form submission
        
        const formData = new FormData(event.target);
        const urlParts = window.location.pathname.split('/');
        const featureId = urlParts[urlParts.length - 1];

        try {
            const response = await fetch(`/api/v1/feature/${featureId}`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('api_token')}`,
                    'Accept': 'application/json',
                },
                body: formData  // Form data
            });

            if (!response.ok) {
                const errorData = await response.json();
                console.error('Error updating facility:', errorData);
                alert('Failed to update facility.');
                return;
            }

            alert('Facility updated successfully!');
            window.location.href = 'http://127.0.0.1:8000/dynamic/sme_Cpanel/home_feature'; // Redirect after success

        } catch (error) {
            console.error('Error updating facility:', error);
            alert('An error occurred while updating the facility.');
        }
    });

    // Validate the image file (optional)
    // function fileValidation(input) {
    //     const file = input.files[0];
    //     const fileType = file.type;
    //     const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];

    //     if (!allowedTypes.includes(fileType)) {
    //         alert('Please upload a valid image file (JPEG/PNG).');
    //         input.value = ''; // Clear the input
    //         return false;
    //     }

    //     return true;
    // }
</script>
@endpush
