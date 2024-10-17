@extends('sme_Cpanel.layout')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Our Solution</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Home</a></li>
                <li class="breadcrumb-item">Our Solution</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Our Solution</h5>
                        <!-- Vertical Form -->
                        <form class="row g-3" id="solutionForm" enctype="multipart/form-data">
                            <div class="col-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>

                            <div class="col-6">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" required accept="image/jpg,image/jpeg,image/png" id="image">
                            </div>
                           
                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" rows="5" id="description" class="form-control" required></textarea>
                            </div>

                            <div class="text-left">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form><!-- End Vertical Form -->
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body" id="solutionsData">
                       {{-- dynamically storing ouir solutions data --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

@push('scripts')
<script>
   function storeSolutions(){
    document.getElementById('solutionForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        const formData = new FormData(this);

        fetch('/api/v1/our-solution', {
            method: 'POST',
            body: formData,
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            // Handle success (like redirecting or showing success message)
            window.location.href = "our-solution";
        })
        .catch(error => {
            alert('Error: ' + error.message);
        });
    });
   }
   async function loadData() {
        try {
            const response = await fetch(`/api/v1/our-solution`);
            if (!response.ok) {
                throw new Error('Failed to fetch data');
            }
            const data = await response.json();
            const solutionData = document.querySelector('#solutionsData');
            // const imageUrl = data.image;
           
            
            // Create table structure and populate data
            let tableData = `
                <h5 class="card-title">Our Solution</h5>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th   scope="col">#</th>
                            <th   scope="col">Image</th>
                            <th   scope="col">Name</th>
                            <th   scope="col">Edit</th>
                            <th   scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        ${data.map(item => `
                        
                            <tr>
                                <td  >${item.id}</td>
                                <td  ><img height="100" width="100" src="/storage/assets/${item.image}"></td>
                                 <td  >${item.name}</td>
                                <td  ><a ><button class="btn btn-green btn-xs btn-edit" title="Edit" data-id="${item.id}"><i class="fa fa-edit"></i></button></a></td>
                
                                <td  >
                                    <button type="button" class="btn btn-danger btn-xs btn-delete" data-id="${item.id}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>`;

            solutionData.innerHTML = tableData;

            // Attach delete event listeners
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

    // Function to delete an enquiry
    async function handleDelete(event) {
        const solutionId = event.target.closest('button').getAttribute('data-id');
        if (!confirm('Are you sure you want to delete this enquiry?')) {
            return;
        }

        try {
            const response = await fetch(`/api/v1/store-solution/${id}`, {
                method: 'DELETE'
            });

            if (!response.ok) {
                throw new Error('Failed to delete enquiry');
            }

            console.log('Enquiry deleted:', solutionId);
            // Reload the data after deletion
            loadData();

        } catch (error) {
            console.error('Error deleting enquiry:', error);
        }
    }
    function handleEdit(event){
        const solutionId = event.target.closest('button').getAttribute('data-id');
        window.location.href =`/sme_Cpanel/edit_solution/${solutionId}`;
    }
    loadData();
    storeSolutions();

</script>
@endpush
@endsection
