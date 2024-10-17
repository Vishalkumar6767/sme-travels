@extends('frontend.layout')
@section('content')
<main class="main">
    <div class="site-breadcrumb" style="background: url(collection/img/breadcrumb/01.jpg)">
       <div class="container">
          <h2 class="breadcrumb-title">For Enquiry</h2>
       </div>
    </div>
    <div class="book-ride py-120">
       <div class="container">
          <div class="row">
             <div class="col-md-10 mx-auto">
                <div class="booking-form">
                   <div class="book-ride-head">
                      <h4 class="booking-title">Make Your Enquiry Here</h4>
                      <p>Have questions or need a custom travel solution? Fill out the form below, and our team will get back to you with the best options tailored to your needs.</p>
                   </div>
                   <form id="enquiry-form">
                      <div class="row">
                         <div class="col-lg-4">
                            <div class="form-group">
                               <label>Name</label>
                               <input type="text" class="form-control" id="name" placeholder=" Name">
                               <i class="far fa-user"></i>
                            </div>
                         </div>
                         <div class="col-lg-4">
                            <div class="form-group">
                               <label>Mobile</label>
                               <input type="text" class="form-control" id="mobile" placeholder="Mobile">
                               <i class="far fa-phone"></i>
                            </div>
                         </div>
                         <div class="col-lg-4">
                            <div class="form-group">
                               <label>Email</label>
                               <input type="text" class="form-control" id="email" placeholder="Email">
                               <i class="far fa-envelope"></i>
                            </div>
                         </div>
                         <div class="col-lg-6">
                            <div class="form-group">
                               <label>Company Name</label>
                               <input type="text" class="form-control" id="cName" placeholder="Company Name">
                            </div>
                         </div>
                         <div class="col-lg-6">
                            <div class="form-group">
                               <label>Company Address</label>
                               <input type="text" class="form-control" id="cAddress" placeholder="Company Address">
                            </div>
                         </div>
                         <div class="col-lg-12">
                            <div class="form-group">
                               <label>Your Message</label>
                               <textarea class="form-control" id="message" rows="5" placeholder="Write Your Message"></textarea>
                            </div>
                         </div>
                         <div class="col-lg-3 mx-auto">
                            <button class="theme-btn" type="submit" id="submit">Submit <i class="fas fa-arrow-right"></i></button>
                         </div>
                      </div>
                      <!-- Success/Error message container -->
                      <div class="form-messege text-success"></div>
                   </form>
                </div>
             </div>
          </div>
       </div>
    </div>
 </main>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Handle form submission
    document.getElementById('enquiry-form').addEventListener('submit', async function(event) {
        event.preventDefault();  

        const name = document.getElementById('name');
        const mobile = document.getElementById('mobile');
        const email = document.getElementById('email');
        const company_name = document.getElementById('cName');
        const company_address = document.getElementById('cAddress');
        const message = document.getElementById('message');

        // Check if any element is null
        if (!name || !mobile || !email || !company_name || !company_address || !message) {
            console.error('One or more form elements are missing');
            return;
        }

        try {
            const response = await fetch(`/api/v1/contact-enquiry`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    name: name.value,
                    mobile: mobile.value,
                    email: email.value,
                    company_name: company_name.value,
                    company_address: company_address.value,
                    message: message.value,
                })
            });

            if (!response.ok) {
                throw new Error('Error submitting form');
            }

            // Show success message and reset form
            document.querySelector('.form-messege').textContent = 'Your message has been sent successfully!';
            document.getElementById('enquiry-form').reset();

        } catch (error) {
            // Show error message
            document.querySelector('.form-messege').textContent = 'Failed to submit the form. Please try again!';
        }
    });
});


</script>
@endpush
@endsection
