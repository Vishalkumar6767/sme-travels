@extends('sme_Cpanel.layout')

@section('content')
<main id="main" class="main">

  <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/index') }}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
          </ol>
      </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
      <div class="row">

          <!-- Left side columns -->
          <div class="col-12">
              <div class="row">

                  <!-- Contact Enquiry Card -->
                  <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                      <div class="card info-card sales-card h-100">
                          <a href="{{ url('dynamic/sme_Cpanel/contact_enquiry') }}" class="h-100">
                              <div class="card-body d-flex flex-column justify-content-between">
                                  <h5 class="card-title">Contact Enquiry</h5>

                                  <div class="d-flex align-items-center mt-3">
                                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                          <i class="fas fa-fw fa-phone"></i>
                                      </div>
                                      <div class="ps-3" >
                                          <h6 id="total-count">0</h6>
                                      </div>
                                  </div>
                              </div>
                          </a>
                      </div>
                  </div>

                  <!-- Application Card -->
                  <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                      <div class="card info-card sales-card h-100">
                          <a href="{{ url('dynamic/sme_Cpanel/contact-enquiry') }}" class="h-100">
                              <div class="card-body d-flex flex-column justify-content-between">
                                  <h5 class="card-title">Application</h5>

                                  <div class="d-flex align-items-center mt-3">
                                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                          <i class="bi bi-file-earmark-text"></i>
                                      </div>
                                      <div class="ps-3">
                                          <h6>0</h6>
                                      </div>
                                  </div>
                              </div>
                          </a>
                      </div>
                  </div>

                  <!-- Contact Summary Card -->
                  <!-- <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                      <div class="card info-card sales-card h-100">
                          <div class="card-body">
                              <h5 class="card-title">Contact Summary</h5>
                              <div class="d-flex align-items-center">
                                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                      <i class="bi bi-people"></i>
                                  </div>
                                  <div class="ps-3">
                                      <h6>Total Contacts: <span id="total-count">Loading...</span></h6>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div> -->

              </div>
          </div><!-- End Left side columns -->

      </div>
  </section>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      fetch('/api/v1/contact-enquiry')
        .then(response => response.json())
        .then(data => {
          console.log('API Response:', data);  // Log the entire response
          
          let count = 'N/A';
          
          if (Array.isArray(data)) {
            count = data.length;
          } else if (typeof data === 'object' && data !== null && Array.isArray(data.data)) {
            count = data.data.length;
          }
          
          document.getElementById('total-count').textContent = count;
        })
        .catch(error => {
          console.error('Error fetching contact count:', error);
          document.getElementById('total-count').textContent = 'Error';
        });
    });
  </script>

</main><!-- End #main -->


@push('scripts')
<script>
    $(document).ready(function() {
    $("#loginButton").on('click',function(){
        const name = $("#email").val();
        const password = $("#password").val();
        

        $.ajax({
    //         headers: {
    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    // }
            url: '/api/v1/contact-enquiry',
            type: 'GET',
            contentType:'application/json',
            data: JSON.stringify({
                email:name,
                password:password
            }),
            success: function(response){
             const localToken = localStorage.getItem('api_token',response.token);
                console.log(localToken)
                window.location.href = "index";
            },
            error:function(xhr,status,error){
                alert('Error:'+xhr.responseText);
            }
        })
    })
})
</script>

    
@endpush
@endsection
  <!-- Content Row -->



