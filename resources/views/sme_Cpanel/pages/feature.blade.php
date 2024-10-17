@extends('sme_Cpanel.layout')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Features</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Home</a></li>
                <li class="breadcrumb-item">Feature</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Feature</h5>
                        <!-- Vertical Form -->
                        <form class="row g-3" id="featureForm" enctype="multipart/form-data">
                            <div class="col-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>

                            <div class="col-6">
                                <label for="imageUpload" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" required accept="image/jpg, image/jpeg, image/png" id="imageUpload">
                            </div>

                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" rows="5" id="description" class="form-control" required></textarea>
                            </div>

                            <div class="text-left">
                                <button  type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form><!-- End Vertical Form -->
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body" id="facilitiesData">
                        {{-- Facilities data will be loaded here --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

@push('scripts')
<script>
    function storeFacility() {
        document.getElementById('featureForm').addEventListener('submit', async function(event) {
            event.preventDefault(); // Prevent the default form submission

            const formData = new FormData(this);
            try {
                const response = await fetch(`/api/v1/facility`, {
                    method: 'POST',
                    body: formData,
                });

                if (!response.ok) throw new Error('Network response was not ok');
                this.reset(); // Reset form after submission
                loadData(); // Reload data
            } catch (error) {
                alert('Error: ' + error.message);
            }
        });
    }

    async function loadData() {
        try {
            const response = await fetch('/api/v1/facility');
            if (!response.ok) {
                throw new Error('Failed to fetch data');
            }
            const data = await response.json();
            const facilitiesData = document.querySelector('#facilitiesData');

            // Create table structure and populate data
            let tableData = `
                <h5 class="card-title">Feature</h5>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${data.map(item => `
                            <tr>
                                <td>${item.id}</td>
                                <td><img height="100" width="100" src="/storage/assets/${item.image}" alt="${item.name}"></td>
                                <td>${item.name}</td>
                                <td>
                                    <button class="btn btn-green btn-xs btn-edit" data-id="${item.id}"><i class="fa fa-edit"></i></button>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-xs btn-delete" data-id="${item.id}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>`;
            facilitiesData.innerHTML = tableData;

            // Attach event listeners for edit and delete
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', handleDelete);
            });

            document.querySelectorAll('.btn-edit').forEach(button => {
                button.addEventListener('click', handleEdit);
            });

        } catch (error) {
            console.error('Error:', error);
        }
    }

    async function handleDelete(event) {
        const featureId = event.target.closest('button').getAttribute('data-id');
        if (!confirm('Are you sure you want to delete this facility?')) {
            return;
        }

        try {
            const response = await fetch(`/api/v1/facility/${featureId}`, {
                method: 'DELETE'
            });

            if (!response.ok) {
                throw new Error('Failed to delete feature');
            }

            loadData(); // Reload the data after deletion
        } catch (error) {
            console.error('Error deleting feature:', error);
        }
    }

    function handleEdit(event) {
        const featureId = event.target.closest('button').getAttribute('data-id');
        // Handle edit logic (e.g., load the facility data into the form)
        alert(`Edit functionality for feature ID: ${featureId} is not implemented.`);
    }

    // loadData();
    storeFacility();
</script>
@endpush
@endsection
