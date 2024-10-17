@extends('sme_Cpanel.layout')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Fleets</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/index">Home</a></li>
                <li class="breadcrumb-item">Fleets</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Fleet</h5>
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
                    <div class="card-body" id="testimonialsData">
                       {{-- dynamically storing ouir solutions data --}}
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
   async function loadData() {
        try {
            const response = await fetch(`/api/v1/home_testimonial`);
            if (!response.ok) {
                throw new Error('Failed to fetch data');
            }
            const data = await response.json();
            const testimonialData = document.querySelector('#testimonialsData');
            // const imageUrl = data.image;
           
            
            // Create table structure and populate data
            let tableData = `
                <h5 class="card-title">Our Fleets</h5>
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
                                <td  ><a ><button class="btn btn-green btn-xs" title="Edit" data-id="${item.id}"><i class="fa fa-edit"></i></button></a></td>
                
                                <td  >
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

        } catch (error) {
            console.error('Error:', error);
        }
    }

    // Function to delete an fleet
    async function handleDelete(event) {
        const testimonialId = event.target.closest('button').getAttribute('data-id');
        if (!confirm('Are you sure you want to delete this fleet?')) {
            return;
        }

        try {
            const response = await fetch(`/api/v1/home_testimonial/${testimonialId}`, {
                method: 'DELETE'
            });

            if (!response.ok) {
                throw new Error('Failed to delete fleet');
            }

            console.log('Fleet deleted:', testimonialId);
            // Reload the data after deletion
            loadData();

        } catch (error) {
            console.error('Error deleting fleet:', error);
        }
    }
    loadData();
    storeTestimonial();


</script>
@endpush
@endsection
