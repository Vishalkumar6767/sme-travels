@extends('frontend.layout')
@section('content')
<main class="main">
    <div class="site-breadcrumb" style="background: url(collection/img/breadcrumb/01.jpg)">
       <div class="container">
          <h2 class="breadcrumb-title">Contact Us</h2>
       </div>
    </div>
    <div class="contact-area py-120">
       <div class="container">
          <div class="contact-content" id="contactContent">
             <!-- This content will be dynamically populated by the JavaScript -->
          </div>
          <div class="contact-wrapper">
             <div class="row">
                <div class="col-lg-6 align-self-center">
                   <div class="contact-img" id="imageContent">
                      {{-- card image --}}
                   </div>
                </div>
                <div class="col-lg-6 align-self-center">
                   <div class="contact-form">
                      <div class="contact-form-header">
                         <h2>Get In Touch</h2>
                         <p>Have questions or need a custom travel solution? Fill out the form below, and our team will get back to you with the best options tailored to your needs. 
                         </p>
                      </div>
                      <form method="post" action="" id="contact-form">
                        @csrf
                         <div class="row">
                            <div class="col-md-6">
                               <div class="form-group">
                                  <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                               </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                  <input type="tel" class="form-control" name="mobile" id="mobile" placeholder="Mobile" required>
                               </div>
                            </div>
                            <div class="col-md-12">
                               <div class="form-group">
                                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                                  {{-- <input type="hidden" class="form-control" name="company_name" id="company_name">
                                  <input type="hidden" class="form-control" name="company_address" id="company_address"> --}}

                               </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Write Your Message"></textarea>
                         </div>
                         <button type="submit" id="submit" class="theme-btn">Submit <i class="far fa-paper-plane"></i></button>
                         <div class="col-md-12 mt-3">
                            <div class="form-messege text-success"></div>
                         </div>
                         <div class="form-messege text-success"></div>
                      </form>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
</main>

<!-- Script Section -->
<script>
function storeenquiry() {
   document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("submit").addEventListener('click', function(event) {
        event.preventDefault();  // Prevent the default form submission

        const name = document.getElementById("name").value;
        const mobile = document.getElementById("mobile").value;
        const email = document.getElementById("email").value;
      //   const company_name = document.getElementById("company_name").value; // Get company name
      //   const company_address = document.getElementById("company_address").value; // Get company address
        const message = document.getElementById("message").value;

        fetch('/api/v1/contact-enquiry', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                name: name,
                mobile: mobile,
                email: email,
               //  company_name: company_name, // Include this in request
               //  company_address: company_address, // Include this in request
                message: message
            })
        })
        .then(response => response.json())
        .then(data => {
            // Handle success (like redirecting or showing success message)
            document.querySelector('.form-messege').textContent = 'Your message has been sent successfully!';
            document.getElementById('contact-form').reset();
        })
        .catch(error => {
            alert('Error: ' + error.message);
        });
    });
});
}

function loadData() {
   fetch(`/api/v1/contact/1`, {
      method: 'GET',
   })
   .then(response => {
      if (!response.ok) {
         throw new Error('Failed to fetch data');
      }
      return response.json();
   })
   .then(data => {
      console.log('Fetched data:', data);
      
      // Dynamically update contact information
      document.querySelector('#contactContent').innerHTML = `
         <div class="row">
            <div class="col-md-4">
               <div class="contact-info">
                  <div class="contact-info-icon">
                     <i class="fal fa-map-location-dot"></i>
                  </div>
                  <div class="contact-info-content">
                     <h5>Address</h5>
                     <p>${data.address}</p>
                  </div>
               </div>
            </div>
            <div class="col-md-4">
               <div class="contact-info">
                  <div class="contact-info-icon">
                     <i class="fal fa-phone-volume"></i>
                  </div>
                  <div class="contact-info-content">
                     <h5>Call Us</h5>
                     <p><a href="tel:+91${data.mobile_1}"> +91 ${data.mobile_1} </a></p>
                     <p><a href="tel:+91${data.mobile_2}"> +91 ${data.mobile_2} </a></p>
                     <p><a href="tel:+91${data.mobile_3}"> +91 ${data.mobile_3} </a></p>
                  </div>
               </div>
            </div>
            <div class="col-md-4">
               <div class="contact-info">
                  <div class="contact-info-icon">
                     <i class="fal fa-envelopes"></i>
                  </div>
                  <div class="contact-info-content">
                     <h5>Mail Us</h5>
                     <p><a href="mailto:${data.email}">${data.email}</a></p>
                  </div>
               </div>
            </div>
         </div>
      `;

      // Update the image dynamically
      // var imagePath = `/storage/collection/${data.image}`;
      document.querySelector('#imageContent').innerHTML = `<img src="${data.image_url}" alt="Contact Image">`;
   })
   .catch(error => {
      console.error('Error:', error); 
   });
}

// Call the function to load the data
loadData();
storeenquiry();

</script>
@endsection
