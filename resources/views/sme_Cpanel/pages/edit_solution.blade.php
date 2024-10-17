@extends('sme_Cpanel.layout')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Solution</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/index') }}">Home</a></li>
                <li class="breadcrumb-item active">Edit Solution</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Update Solution</h5>
                       
                        <!-- Vertical Form -->
                        <form class="row g-3" id="editSolutionlForm"  enctype="multipart/form-data" >
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="testimonialId" value="{{ $solution->id }}">
                            <div class="col-6">
                                <label for="inputName" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="inputName" value="{{ $solution->name }}" required>
                            </div>
                            <div class="col-6">
                                <label for="imageUpload" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" accept="image/jpg, image/jpeg, image/png" id="imageUpload" >
                            </div>
                          
                            <div class="col-12">
                                <label for="facilityDescription" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="facilityDescription" required>{{ $solution->description }}</textarea>
                            </div>
                           
                               
                                <div class="col-6">
                                    <img src="{{ asset('storage/assets/' . $solution->image) }}" height="300" width="300" alt="Current Facility Image">
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
     document.querySelector('#editSolutionlForm').addEventListener('submit', async function (event) {
        event.preventDefault();  // Prevent default form submission
        
        const formData = new FormData(event.target);
        const urlParts = window.location.pathname.split('/');
        const solutionId = urlParts[urlParts.length - 1];

        try {
            const response = await fetch(`/api/v1/our-solution/${solutionId}`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('api_token')}`,
                    'Accept': 'application/json',
                },
                body: formData  // Form data
            });

            if (!response.ok) {
                const errorData = await response.json();
                console.error('Error updating solution:', errorData);
                alert('Failed to update solution.');
                return;
            }

            alert('Facility updated successfully!');
            window.location.href = 'http://127.0.0.1:8000/dynamic/sme_Cpanel/our-solution'; // Redirect after success

        } catch (error) {
            console.error('Error updating solution:', error);
            alert('An error occurred while updating the solution.');
        }
    });
</script>
    
@endpush

@endsection
