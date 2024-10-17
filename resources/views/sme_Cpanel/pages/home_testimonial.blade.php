@extends('sme_Cpanel.layout')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Testimonial</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/index">Home</a></li>
                <li class="breadcrumb-item">Testimonial</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Testimonial</h5>
                        <!-- Vertical Form -->
                        <form class="row g-3" id="testimonialForm" enctype="multipart/form-data">
                            

                            <div class="col-6">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" required accept="image/jpg,image/jpeg,image/png" id="image">
                            </div>
                           
                            <div class="col-12">
                                <label for="title" class="form-label">Title</label>
                                <input name="title" rows="5" id="title" class="form-control" required>
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
                    <div class="card-body" id="testimonialDeta">
                       {{-- dynamically storing ouir testimonial data --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

@push('scripts')
<script>
   function storeTestimonial(){
    document.getElementById('testimonialForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        const formData = new FormData(this);

        fetch('/api/v1/home_testimonial', {
            method: 'POST',
            body: formData,
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            // Handle success (like redirecting or showing success message)
            window.location.href = "home_testimonial";
        })
        .catch(error => {
            alert('Error: ' + error.message);
        });
    });
   }
   async function loadTestimonial() {
        try {
            const response = await fetch(`/api/v1/home_testimonial`);
            if (!response.ok) {
                throw new Error('Failed to fetch data');
            }
            const data = await response.json();
            const testimonialData = document.querySelector('#testimonialDeta');
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
                                 <td  >${item.title}</td>
                                 <td>
                                    <button class="btn btn-green btn-xs btn-edit" data-id="${item.id}"><i class="fa fa-edit"></i></button>
                                </td>
                
                                <td>
                                    <button type="button" class="btn btn-danger btn-xs btn-delete" data-id="${item.id}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>`;

            testimonialData.innerHTML = tableData;

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
        const testimonialId = event.currentTarget.getAttribute('data-id');
        if (!confirm('Are you sure you want to delete this Testimonial?')) {
            return;
        }

        try {
            const response = await fetch(`/api/v1/home_testimonial/${testimonialId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin' // This line ensures cookies are sent with the request
            });

            if (response.status === 401) {
                throw new Error('You are not authenticated. Please log in and try again.');
            }

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Failed to delete testimonial');
            }

            alert('Testimonial deleted successfully');
            // Reload the data after deletion
            loadTestimonial();

        } catch (error) {
            console.error('Error deleting testimonial:', error);
            alert('Error deleting testimonial: ' + error.message);
        }
    }
    function handleEdit(event){
        const testmonialId = event.target.closest('button').getAttribute('data-id');
        window.location.href = `/sme_Cpanel/edit_testimonial/${testmonialId}`; 
    }

    loadTestimonial();

</script>
@endpush
@endsection
