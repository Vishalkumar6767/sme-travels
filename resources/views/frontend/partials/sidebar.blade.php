  <div class="sidebar-wrapper" id="sideContact">
       
 </div>
 @push('scripts')
    <script>
      function sideContact() {
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
        const contactHeader = document.querySelector('#sideContact');
        if (contactHeader) {
            contactHeader.innerHTML = `
            <div class="sidebar-content">
          <button type="button" class="close-sidebar-popup"><i class="far fa-xmark"></i></button>
          <div class="sidebar-logo">
             <img src="collection/img/logo/logo.png" alt>
          </div>
          <div class="sidebar-contact">
             <h4>Contact Info</h4>
             <ul>
                <li>
                   <h6>Email</h6>
                   <a href="mailto:${data.email}"><i class="far fa-envelope"></i><span class="__cf_email__" data-cfemail="">${data.email || 'info@example.com'}</span></a>
                </li>
                <li>
                   <h6>Phone</h6>
                   <a href="tel:+91 ${data.mobile_1}"><i class="far fa-phone-volume"></i> +91 ${data.mobile_1}|  </a> <a href="tel:+91 ${data.mobile_2}"> +91 ${data.mobile_2} | </a> <a href="tel:+91 ${data.mobile_3}"> +91 ${data.mobile_3}</a>
                </li>
                <li>
                   <h6>Address</h6>
                   <a href="#"><i class="far fa-location-dot"></i>${data.address}</a>
                </li>
             </ul>
          </div>
          <div class="sidebar-social">
             <h4>Follow Us</h4>
             <a href="${data.facebook || '#'}"><i class="fab fa-facebook"></i></a>
             <a href="${data.instagram || '#'}"><i class="fab fa-instagram"></i></a>
             <a href="${data.youtube || '#'}"><i class="fab fa-youtube"></i></a>
             <a href="${data.linkdin || '#'}"><i class="fab fa-linkedin"></i></a>
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


sideContact();
    </script>
 @endpush
