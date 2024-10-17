@extends('sme_Cpanel.layout')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Founder</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Home</a></li>
                <li class="breadcrumb-item">Founder</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Update Founder</h5>
                        <form class="row g-3" id="founderForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" id="founderId" value="1"> <!-- Dynamic ID -->
                            
                            <div class="col-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            <div class="col-6">
                                <label for="imageUpload" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" accept="image/jpg, image/jpeg, image/png" id="imageUpload" required>
                            </div>
                            <div class="col-12">
                                <label for="description1" class="form-label">Description</label>
                                <textarea name="description" rows="5" id="description" class="form-control" required></textarea>
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" type="email" id="email" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label for="mobile" class="form-label">Mobile</label>
                                <input type="text" name="mobile" id="mobile" class="form-control" required>
                            </div>
                            <div class="text-left">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

@push('scripts')
<script>
  document.getElementById('founderForm').addEventListener('submit', async (event) => {
    event.preventDefault(); // Prevent the default form submission

    const formData = new FormData(event.target);
    const founderId = document.getElementById('founderId').value; // Get the founder ID

    try {
        const response = await fetch(`/api/v1/founder/${founderId}`, {
            method: 'POST', // Form method is POST
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('api_token')}`, // Include the API token
                'Accept': 'application/json', // Specify the accepted response type
            },
            body: formData,
        });

        if (!response.ok) {
            const errorData = await response.json();
            throw new Error(errorData.message || 'Update failed');
        }

        alert('Founder updated successfully!');
        window.location.reload(); // Reload the page
    } catch (error) {
        console.error('Update error:', error);
        alert('Error updating founder: ' + error.message);
    }
});


    // Fetch founder data to populate the form
    async function loadData() {
        const founderId = document.getElementById('founderId').value;
        console.log(founderId) // Use the hidden ID
        
        try {
            const response = await fetch(`/api/v1/founder/${founderId}/edit`); 
           console.log(response);
            if (!response.ok) throw new Error('Failed to fetch data');
            const data = await response.json();
            console.log(data);
            document.getElementById('name').value = data.name;
            document.getElementById('description').value = data.description;
            document.getElementById('email').value = data.email;
            document.getElementById('mobile').value = data.mobile;
        } catch (error) {
            console.error(error);
        }
    }

    document.addEventListener('DOMContentLoaded', loadData);
</script>
@endpush
@endsection
