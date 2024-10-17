@extends('sme_Cpanel.layout')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Fleet Management</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Home</a></li>
                <li class="breadcrumb-item">Fleet Management </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Update Fleet Management </h5>
                        <!-- Vertical Form -->
                        <form class="row g-3" id="fleetManagementForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" id="fleetId" value="1">
                            <div class="col-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>

                            <div class="col-6">
                                <label for="imageUpload" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" required accept="image/jpg, image/jpeg, image/png" id="imageUpload">
                            </div>

                            <div class="col-12">
                                <label for="description1" class="form-label">Description1</label>
                                <textarea name="description1" rows="5" id="description1" class="form-control" required></textarea>
                            </div>
                            <div class="col-12">
                                <label for="description2" class="form-label">Description2</label>
                                <textarea name="description2" rows="5" id="description2" class="form-control" required></textarea>
                            </div>
                            <div class="col-12">
                                <label for="description3" class="form-label">Description3</label>
                                <textarea name="description3" rows="5" id="description3" class="form-control" required></textarea>
                            </div>

                            <div class="text-left">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form><!-- End Vertical Form -->
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body" >
                        <div class="taxi-single pt-120 pb-100">
                            <div class="container">
                                <div class="taxi-single-wrapper">
                                    <div class="row " id="fleetManagementData">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

@push('scripts')
<script>
    document.getElementById('fleetManagementForm').addEventListener('submit', async (event) => {
        event.preventDefault();
        const formData = new FormData(event.target);
        const fleetId = document.getElementById('fleetId').value;

        try {
            const response = await fetch(`/api/v1/fleet-management/${fleetId}`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('api_token')}`,
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData,
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Update failed');
            }

            const result = await response.json();
            console.log('Update result:', result);

            alert('Fleet management updated successfully!');
            await loadData(); // Reload the data after successful update
        } catch (error) {
            console.error('Update error:', error);
            alert('Error updating Fleet Management: ' + error.message);
        }
    });

    async function loadData() {
        const fleetId = document.getElementById('fleetId').value;
        
        try {
            const response = await fetch(`/api/v1/fleet-management/${fleetId}/edit`);
            if (!response.ok) throw new Error('Failed to fetch data');
            const data = await response.json();

            document.getElementById('name').value = data.name;
            document.getElementById('description1').value = data.description1;
            document.getElementById('description2').value = data.description2;
            document.getElementById('description3').value = data.description3;

        } catch (error) {
            console.error('Error:', error);
        }
    }

    document.addEventListener('DOMContentLoaded', loadData);
    
        async function fleetManagementsDeta() {
            try {
                const response = await fetch('/api/v1/fleet-management/1');
                if (!response.ok) {
                    throw new Error('Failed to fetch data');
                }
                const item  = await response.json();
               //  const item = data[0];
                console.log(item);

                // Create the HTML structure with the fetched data
                const solutionData = `
                    <div class="col-lg-5">
                        <div class="taxi-single-img">
                            <img src="/storage/assets/${item.image}" alt="${item.name}" width="80%">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="about-right wow fadeInRight" data-wow-delay=".25s" 
                             style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInRight;">
                            <div class="site-heading mb-3">
                                <h2 class="site-title">${item.name}</h2>
                            </div>
                            <div class="about-text text-justify">
                                <p>${item.description1}</p>
                                <p>${item.description2}</p>
                                <p>${item.description3}</p>
                            </div>
                        </div>
                    </div>`;

                // Update the inner HTML of the target element
                document.querySelector('#fleetManagementData').innerHTML = solutionData;

            } catch (error) {
                console.error('Error:', error);
            }
        }

        fleetManagementsDeta();
    </script>
@endpush

@endsection
