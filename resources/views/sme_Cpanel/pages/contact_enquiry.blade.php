@extends('sme_Cpanel.layout')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Contact Enquiry</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('index') }}">Home</a></li>
                <li class="breadcrumb-item">Contact Enquiry</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body" id="enquiryContainer">
                        <!-- Table will be dynamically generated here -->
                    </div>
                   
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadData();

    async function loadData(page = 1) {
        try {
            const response = await fetch(`/api/v1/contact-enquiry?page=${page}`);
            if (!response.ok) {
                throw new Error('Failed to fetch data');
            }
            const result = await response.json();
            const enquiryContainer = document.querySelector('#enquiryContainer');
            
            // Create table structure and populate data
            let tableData = `
                <h5 class="card-title">Contact Enquiry</h5>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Email</th>
                            <th scope="col">Message</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${result.data.map(item => `
                            <tr>
                                <td align="center">${item.id}</td>
                                <td align="center">${item.name}</td>
                                <td align="center">${item.mobile}</td>
                                <td align="center">${item.email}</td>
                                <td align="center">${item.message}</td>
                                <td align="center">
                                    <button type="button" class="btn btn-danger btn-xs btn-delete" data-id="${item.id}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        ${generatePaginationLinks(result.links, result.current_page)}
                    </ul>
                </nav>
                `;

            enquiryContainer.innerHTML = tableData;

            // Attach delete event listeners
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', handleDelete);
            });

            // Attach pagination event listeners
            document.querySelectorAll('.page-link').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const page = e.target.getAttribute('data-page');
                    if (page) {
                        loadData(page);
                    }
                });
            });

        } catch (error) {
            console.error('Error:', error);
        }
    }

    function generatePaginationLinks(links, currentPage) {
        return links.map(link => {
            if (link.url === null) {
                return `<li class="page-item disabled"><span class="page-link">${link.label}</span></li>`;
            }
            return `
                <li class="page-item ${link.active ? 'active' : ''}">
                    <a class="page-link" href="#" data-page="${getPageFromUrl(link.url)}" ${link.active ? 'aria-current="page"' : ''}>
                        ${link.label}
                    </a>
                </li>
            `;
        }).join('');
    }

    function getPageFromUrl(url) {
        const match = url.match(/page=(\d+)/);
        return match ? match[1] : '1';
    }

    // Function to delete an enquiry
    async function handleDelete(event) {
        const enquiryId = event.target.closest('button').getAttribute('data-id');
        if (!confirm('Are you sure you want to delete this enquiry?')) {
            return;
        }

        try {
            const response = await fetch(`/api/v1/contact-enquiry/${enquiryId}`, {
                method: 'DELETE'
            });

            if (!response.ok) {
                throw new Error('Failed to delete enquiry');
            }

            console.log('Enquiry deleted:', enquiryId);
            // Reload the data after deletion
            loadData();

        } catch (error) {
            console.error('Error deleting enquiry:', error);
        }
    }
});
</script>
@endpush
@endsection
