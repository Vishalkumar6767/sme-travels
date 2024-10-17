<footer class="footer-area" id="contactFooter">
</footer>
@push('scripts')
    <script>
      function footerContact() {
    fetch('/api/v1/contact/1', {
        method: 'GET',
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Failed to fetch Contact Information');
        }
        return response.json();
    })
    .then(data => {
        console.log('Fetched data:', data);
        
        // Safely update contact header
        const contactHeader = document.querySelector('#contactFooter');
        if (contactHeader) {
            contactHeader.innerHTML = `
            <div class="footer-widget">
        <div class="container">
            <div class="row footer-widget-wrapper pt-120 pb-70 align-items-center">
                <div class="col-md-6 col-lg-4">
                    <div class="footer-widget-box about-us">
                        <a href="index.html" class="footer-logo">
                            <img src="collection/img/logo/logo.png" alt>
                        </a>
                        <div class="footer-newsletter">
                            <ul class="footer-contact">
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">Quick Links</h4>
                        <ul class="footer-list">
                            <li><a href="{{ url('/about') }}"><i class="fas fa-caret-right"></i> About Dorrela</a></li>
                            <li><a href="{{ url('/founders') }}"><i class="fas fa-caret-right"></i>Founders</a></li>
                            <li><a href="{{ url('/fleet') }}"><i class="fas fa-caret-right"></i> Fleet</a></li>
                            <li><a href="{{ url('/contact') }}"><i class="fas fa-caret-right"></i> Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">Our Services</h4>
                        <ul class="footer-list">
                            <li><a href="{{ url('/corporate_hire') }}"><i class="fas fa-caret-right"></i> Corporate
                                    Hire</a></li>
                            <li><a href="{{ url('/employee_transportation') }}"><i class="fas fa-caret-right"></i>
                                    Employee Transportation</a></li>
                            <li><a href="{{ url('/fleet_management') }}"><i class="fas fa-caret-right"></i> Fleet
                                    Management</a></li>
                            <li><a href="{{ url('/our_solutions') }}"><i class="fas fa-caret-right"></i>Our
                                    Solutions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">Contact Details</h4>
                        <div class="footer-newsletter">
                            <ul class="footer-contact">
                                <li><a href="tel:+91 ${data.mobile_1}"><i class="far fa-phone-volume"></i> +91 ${data.mobile_1} </a>
                                    <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a
                                        href="tel:+91 ${data.mobile_2}"> +91 ${data.mobile_2} </a> <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a
                                        href="tel:+91 ${data.mobile_3}"> +91 ${data.mobile_3}</a> <br> <a
                                        href="tel:+91 ${data.office_no}"><span class="office_number">Office : </span> +91
                                        ${data.office_no}</a></li>
                                <li><a href="mailto:${data.email} "><i class="far fa-envelope"></i><span
                                            class="__cf_email__" data-cfemail="">${data.email || 'info@example.com'} </span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-8 align-self-center">
                    <p class="copyright-text">
                        &copy; Copyright <span id="date"></span> <a href="#"> Dorrela Service Pvt.ltd </a> All Rights
                        Reserved | Website Design & Developed by Siri Group
                    </p>
                </div>
                <div class="col-md-4 align-self-center">
                    <ul class="footer-social">
                        <li><a href="${data.facebook || '#'}"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="${data.instagram || '#'}"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="${data.linkdin || '#'}"><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a href="${data.youtube || '#'}"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
                
    </div>
            `;
        }
    })
    .catch(error => {
        console.error('Error fetching contact info:', error);
    });
}

// Call the function to load the header content
footerContact();
    </script>
@endpush
