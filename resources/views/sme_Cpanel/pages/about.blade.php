@extends('sme_Cpanel.layout')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>About Us</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/index') }}">Home</a></li>
                <li class="breadcrumb-item active">About Us</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">About Us</h5>
                        
                        <!-- About Us Form -->
                        <form class="row g-3" id="aboutForm" method ="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" id="aboutId" value="1"> 
                            <div class="col-12">
                                <label for="imageUpload" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" accept="image/jpg, image/jpeg, image/png" id="imageUpload" onchange="fileValidation(this)">
                            </div>
                            <div class="col-12">
                                <label for="title" class="form-label">Title</label>
                                <input name="title" id="title" rows="5" class="form-control" required>   
                            </div>
                            
                            
                            <div class="col-12">
                                <label for="description1" class="form-label">Description</label>
                                <textarea name="description1" id="description1" rows="5" class="form-control" required>
                                    
                                </textarea>
                            </div>
                            <div class="col-12">
                                <label for="description2" class="form-label">Description</label>
                                <textarea name="description2" id="description2" rows="5" class="form-control" required>
                                    
                                </textarea>
                            </div>


                            <div class="col-12">
                                <label for="description3" class="form-label">Additional Description</label>
                                <textarea name="description3" id="description3" rows="5" class="form-control" required>
                                </textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-center" id="aboutData">
                                   
                                </div>
                            </div>

                            <div class="text-left">
                                <button type="submit" name="update" id="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form><!-- End About Us Form -->

                        <hr> 
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
     document.getElementById('aboutForm').addEventListener('submit', async (event) => {
    event.preventDefault(); // Prevent the default form submission

    const formData = new FormData(event.target);
    const aboutId = document.getElementById('aboutId').value; // Get the founder ID

    try {
        const response = await fetch(`/api/v1/about/${aboutId}`, {
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
        alert('Error updating About Us : ' + error.message);
    }
});


    // Fetch founder data to populate the form
    async function loadData() {
        const aboutId = document.getElementById('aboutId').value;
        console.log(aboutId) // Use the hidden ID
        
        try {
            const response = await fetch(`/api/v1/about/${aboutId}/edit`); 
           console.log(response);
            if (!response.ok) throw new Error('Failed to fetch data');
            const data = await response.json();
            console.log(data);
            document.getElementById('title').value = data.title;
            document.getElementById('description1').value = data.description1;
            document.getElementById('description2').value = data.description2;
            document.getElementById('description3').value = data.description3;

        } catch (error) {
            console.error(error);
        }
    }

    document.addEventListener('DOMContentLoaded', loadData);





     async function aboutUs() {
        try{
            const response = await fetch(`/api/v1/about/1`);
            if(!response.ok){
                throw new Error('Failed to fetch data');
            }
            const data = await response.json();
        
            const aboutUsData = `
                <div class="container">
                    
                                <div class="about-img">
                                    <img src="/storage/assets/${data.image} " alt="${data.title}" height="300" width="300">
                                </div>
                               
                </div>`;
            document.querySelector("#aboutData").innerHTML = aboutUsData;
        }catch(error){
            console.error('Error:',error);
        }
    }
        aboutUs();

</script>
    
@endpush
@endsection
