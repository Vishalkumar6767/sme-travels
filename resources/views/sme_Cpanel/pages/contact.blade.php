@extends('sme_Cpanel.layout')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Contact</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Home</a></li>
                <li class="breadcrumb-item">Contact</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Contact</h5>

                        <!-- Vertical Form -->
                        <form class="row g-3" id="contactForm" method="POST" enctype="multipart/form-data">
                            @csrf  
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" id="contactId" value="1">
                            <div class="col-12">
                                <label for="imageUpload" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" required
                                    accept="image/jpg, image/jpeg, image/png" id="imageUpload">
                            </div>
                        
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Address</label>
                                <textarea name="address" rows="5" id="address" class="form-control">
                                    #1239, 5th Phase, 3rd stage, BEML Layout, R.R. Nagar, Bangalore - 98
                                </textarea>
                            </div>
                        
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Mobile</label>
                                <input type="text" class="form-control" name="mobile_1" id="mobile_1"><br>
                                <input type="text" class="form-control" name="mobile_2" id="mobile_2"><br>
                                <input type="text" class="form-control" name="mobile_3" id="mobile_3">
                               
                            </div >
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Office No</label>
                                <input type="text" class="form-control" name="office_no" id="office_no">
                            </div>
                        
                            <div class="col-12">
                                <label for="inputPassword4" class="form-label">Email </label>
                                <input type="text" class="form-control" name="email" id="email">
                            </div>
                        
                            <div class="col-12">
                                <label for="inputPassword4" class="form-label">Facebook </label>
                                <input type="text" class="form-control" name="facebook" id="facebook">
                            </div>
                        
                            <div class="col-12">
                                <label for="inputPassword4" class="form-label">Instagram </label>
                                <input type="text" class="form-control" name="instagram" id="instagram">
                            </div>
                        
                            <div class="col-12">
                                <label for="inputPassword4" class="form-label">LinkedIn </label>
                                <input type="text" class="form-control" name="linkdin" id="linkdin">
                            </div>
                            <div class="col-12">
                                <label for="inputPassword4" class="form-label">Youtube </label>
                                <input type="text" class="form-control" name="youtube" id="youtube">
                            </div>
                            <br>
                        
                            <div class="col-12">
                                <div class="text-left">
                                    <button type="submit" name="submit" id="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                        
                        @if (session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->
@push('scripts')
<script>
    document.getElementById('contactForm').addEventListener('submit', async (event) => {
        event.preventDefault();
        const formData = new FormData(event.target);
        const contactId = document.getElementById('contactId').value;

        try {
            const response = await fetch(`/api/v1/contact/${contactId}`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('api_token')}`,
                    'Accept': 'application/json',
                },
                body: formData,
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Update failed');
            }

            alert('Contact updated successfully!');
            window.location.reload();
        } catch (error) {
            console.error('Update error:', error);
            alert('Error updating Contacts: ' + error.message);
        }
    });

    async function loadData() {
        const contactId = document.getElementById('contactId').value;

        try {
            const response = await fetch(`/api/v1/contact/${contactId}/edit`);
            if (!response.ok) throw new Error('Failed to fetch data');
            const data = await response.json();

            document.getElementById('address').value = data.address;
            document.getElementById('mobile_1').value = data.mobile_1;
            document.getElementById('mobile_2').value = data.mobile_2;
            document.getElementById('mobile_3').value = data.mobile_3;
            document.getElementById('office_no').value = data.office_no;
            document.getElementById('email').value = data.email;
            document.getElementById('facebook').value = data.facebook;
            document.getElementById('instagram').value = data.instagram;
            document.getElementById('linkdin').value = data.linkdin;
            document.getElementById('youtube').value = data.youtube;

        } catch (error) {
            console.error('Error:', error);
        }
    }

    document.addEventListener('DOMContentLoaded', loadData);

</script>
@endpush
@endsection
