@extends('sme_Cpanel.layout')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Why Choose Us</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/index') }}">Home</a></li>
                <li class="breadcrumb-item">Why Choose Us</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Why Choose Us</h5>

                        <!-- Form to Update Content -->
                        <form class="row g-3"  id="homeWhyForm" method ="POST" enctype="multipart/form-data">
                            @csrf <!-- CSRF token for security -->
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" id="homeId" value="1"> 

                            <div class="col-12">
                                <label for="imageUpload" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" accept="image/jpg, image/jpeg, image/png" id="imageUpload" onchange="fileValidation(this)">
                            </div>

                            <div class="col-12">
                                <label for="description" class="form-label">Main Description</label>
                                <textarea name="description" rows="5" id="description" class="form-control"></textarea>
                            </div>

                            <div class="col-12">
                                <label for="title1" class="form-label">Title 1</label>
                                <input type="text" class="form-control" name="title1" value="State-of-the-Art Infrastructure" id="title1">
                            </div>

                            <div class="col-12">
                                <label for="description1" class="form-label">Description 1</label>
                                <textarea name="description1" rows="5" id="description1" class="form-control"></textarea>
                            <div class="col-12">
                                <label for="title2" class="form-label">Title 2</label>
                                <input type="text" class="form-control" name="title2" id="title2">
                            </div>

                            <div class="col-12">
                                <label for="description2" class="form-label">Description 2</label>
                                <textarea name="description2" rows="5" id="description2" class="form-control"></textarea>

                            <div class="col-12">
                                <label for="title3" class="form-label">Title 3</label>
                                <input type="text" class="form-control" name="title3" id="title3">
                            </div>

                            <div class="col-12">
                                <label for="description3" class="form-label">Description 3</label>
                                <textarea name="description3" rows="5" id="description3" class="form-control"></textarea>
                            
                            <div class="col-12">
                                <label for="title4" class="form-label">Title 4</label>
                                <input type="text" class="form-control" name="title4"  id="title4">
                            </div>

                            <div class="col-12">
                                <label for="description4" class="form-label">Description 4</label>
                                <textarea name="description4" rows="5" id="description4" class="form-control"></textarea>
                            
                            <div class="col-12">
                                <label for="title5" class="form-label">Title 5</label>
                                <input type="text" class="form-control" name="title5" id="title5">
                            </div>

                            <div class="col-12">
                                <label for="description5" class="form-label">Description 5</label>
                                <textarea name="description5" rows="5" id="description5" class="form-control"></textarea>

                            <div class="col-4" id="whyChooseUsData">
                               
                            </div>
                            <br>

                            <div class="text-left">
                                <button type="submit" name="update" class="btn btn-primary">Update</button>
                            </div>
                        </form><!-- End Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->
@if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@push('scripts')
<script>

  document.getElementById('homeWhyForm').addEventListener('submit', async (event) => {
    event.preventDefault(); // Prevent the default form submission

    const formData = new FormData(event.target);
    const homeId = document.getElementById('homeId').value; // Get the founder ID

    try {
        const response = await fetch(`/api/v1/home_why/${homeId}`, {
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
        alert('Error updating Why Choose us: ' + error.message);
    }
});


    // Fetch founder data to populate the form
    async function loadData() {
        const homeId = document.getElementById('homeId').value;
        console.log(homeId) // Use the hidden ID
        
        try {
            const response = await fetch(`/api/v1/home_why/${homeId}/edit`); 
           console.log(response);
            if (!response.ok) throw new Error('Failed to fetch data');
            const data = await response.json();
            console.log(data);
            document.getElementById('description').value = data.description;
            document.getElementById('title1').value = data.title1;
            document.getElementById('description1').value = data.description1;
            document.getElementById('title2').value = data.title2;
            document.getElementById('description2').value = data.description2;
            document.getElementById('title3').value = data.title3;
            document.getElementById('description3').value = data.description3;
            document.getElementById('title4').value = data.title4;
            document.getElementById('description4').value = data.description4;
            document.getElementById('title5').value = data.title1;
            document.getElementById('description5').value = data.description5;

        } catch (error) {
            console.error(error);
        }
    }

    document.addEventListener('DOMContentLoaded', loadData);



async function whyChooseUs() {
   try{
    const response = await fetch('/api/v1/home_why/1');
    if (!response.ok){
        throw new Error('Failed to fetch data');
    } 
    const item = await response.json();
    console.log(item);
    const whyChooseUsData = `
        
     <img src="/storage/assets/${item.image}"alt="About Image" class="img-fluid" height="300" width="300">
            
           `;
           document.querySelector("#whyChooseUsData").innerHTML = whyChooseUsData;
   }catch(error){
    console.error('Error:',error);
   }   
}
whyChooseUs();
</script>
@endpush
@endsection
