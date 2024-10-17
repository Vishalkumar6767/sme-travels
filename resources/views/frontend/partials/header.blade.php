<header class="header">
    <div class="header-top"id="contactHeader" >
           
           {{-- Contact are dynamically Populated --}}
    </div>
    <div class="main-navigation">
        <nav class="navbar navbar-expand-lg">
            <div class="container position-relative">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="collection/img/logo/logo.png" alt="logo">
                </a>
                <div class="mobile-menu-right">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-mobile-icon"><i class="far fa-bars"></i></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="main_nav">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                           <a class="nav-link" href="{{ url('/home') }}">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">About Us</a>
                            <ul class="dropdown-menu fade-down">
                                <li><a class="dropdown-item" href="{{ url('/about') }}">About Dorrela</a></li>
                                <li><a class="dropdown-item" href="{{ url('/founders') }}"> Founders</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Service</a>
                            <ul class="dropdown-menu fade-down">
                                <li><a class="dropdown-item" href="{{ url('/corporate_hire') }}">Corporate Hire</a></li>
                                <li><a class="dropdown-item" href="{{ url('/employee_transportation') }}">Employee
                                        Transportation</a></li>
                                <li><a class="dropdown-item" href="{{ url('/fleet_management') }}">Fleet Management</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/our_solutions') }}">Our Solutions</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{ url('/fleet') }}">Fleet</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>
                    </ul>
                    <div class="nav-right">
                        <div class="nav-right-btn mt-2">
                            <a href="{{ url('/enquiry') }}" class="theme-btn"><span class="fas fa-taxi"></span>For
                                Enquiry</a>
                        </div>
                        <div class="sidebar-btn">
                            <button type="button" class="nav-right-link"><i class="far fa-bars-filter"></i></button>
                        </div>
                    </div>
                </div>
                <div class="search-area">
                    <form action="#">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Type Keyword...">
                            <button type="submit" class="search-icon-btn"><i class="far fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
    </div>
</header>
<script>
  function headerContact() {
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
        const contactHeader = document.querySelector('#contactHeader');
        if (contactHeader) {
            contactHeader.innerHTML = `
            <div class="container"  >
             <div class="header-top-wrapper">
                <div class="header-top-left">
                    <div class="header-top-contact">
                        <ul>
                            <li>
                                <a href="mailto:${data.email}">
                                    <i class="far fa-envelopes"></i>
                                    <span>${data.email || 'info@example.com'}</span>
                                </a>
                            </li>
                            <li>
                                <a href="tel:+91 ${data.mobile_1}"><i class="far fa-phone-volume"></i> +91 ${data.mobile_1 || '0000000000'}</a> |
                                <a href="tel:+91 ${data.mobile_2}"> +91 ${data.mobile_2 || '0000000000'}</a> |
                                <a href="tel:+91 ${data.mobile_3}"> +91 ${data.mobile_3 || '0000000000'}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="header-top-right">
                    <div class="header-top-social">
                        <span>Follow Us: </span>
                        <a href="${data.facebook || '#'}" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="${data.instagram || '#'}" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="${data.youtube || '#'}" target="_blank"><i class="fab fa-youtube"></i></a>
                        <a href="${data.linkdin || '#'}" target="_blank"><i class="fab fa-linkedin"></i></a>
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
headerContact();

</script>
