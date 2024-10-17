@extends('frontend.layout')
@section('content')
    <main class="main">
        <div class="hero-section">
            <div class="hero-slider owl-carousel owl-theme">
                @foreach (['slider-1.jpg', 'slider-2.jpg', 'slider-3.jpg'] as $sliderImage)
                    <div class="hero-single" style="background: url(collection/img/slider/{{ $sliderImage }})">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-md-12 col-lg-9 mx-auto">
                                    <div class="hero-content text-center">
                                        <h6 class="hero-sub-title" data-animation="fadeInUp" data-delay=".25s">Dorrela Service Pvt.ltd</h6>
                                        <h1 class="hero-title" data-animation="fadeInRight" data-delay=".50s">
                                            Smart Corporate <span>Travel</span> Solutions
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="about-area py-120">
            <div class="container" id="aboutData"></div>
        </div>

        <div class="service-area bg py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline">Services</span>
                            <h2 class="site-title">Our Best Services For You</h2>
                            <div class="heading-divider"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach (['corporateHire' => 'Corporate Hire', 'employeeTransportation' => 'Employee Transportation', 'fleetManagement' => 'Fleet Management'] as $key => $title)
                        <div class="col-md-6 col-lg-4" id="{{ $key }}Data">
                            {{-- {{ $title }} data dynamically loaded --}}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="testimonial-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"><i class="flaticon-drive"></i> Fleets</span>
                            <h2 class="site-title text-white">
                                Let's Check Available <span> Cars </span>
                            </h2>
                            <div class="heading-divider"></div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slider owl-carousel owl-theme" id="fleetData">
                    <!-- Dynamic content will be injected here by JavaScript -->
                </div>
            </div>
        </div>
        <div class="feature-area pt-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline">Feature</span>
                            <h2 class="site-title">Our Awesome Feature</h2>
                            <div class="heading-divider"></div>
                        </div>
                    </div>
                </div>
                <div class="row" id="featureData">
                    {{-- Dynamically Loaded feature Data --}}
                </div>
            </div>
        </div>
    </main>

    @push('scripts')
    <script>
        async function fetchAndRender(url, elementId, renderFunction) {
            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error('Failed to fetch data');
                }
                const data = await response.json();
                if (data) {
                    const element = document.getElementById(elementId);
                    if (element) {
                        element.innerHTML = renderFunction(data);
                    } else {
                        console.warn(`Element with id '${elementId}' not found`);
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                // Optionally, display an error message to the user
            }
        }

        function renderAboutUs(data) {
            return `
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-right wow fadeInRight" data-wow-delay=".25s">
                            <div class="site-heading mb-3">
                                <span class="site-title-tagline"><i class="flaticon-drive"></i> About Us</span>
                                <h2 class="site-title">${data.title}</h2>
                            </div>
                            <p class="about-text">${data.description1}</p>
                            <a href="{{ url('/about') }}" class="theme-btn mt-4">Read More<i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-left wow fadeInLeft" data-wow-delay=".25s">
                            <div class="about-img">
                                <img src="/storage/assets/${data.image}" alt="">
                            </div>
                        </div>
                    </div>
                </div>`;
        }

        function renderService(data, serviceType) {
            const formattedServiceType = data.name.toLowerCase().replace(/ /g, '-');
            return `
                <div class="service-item wow fadeInUp" data-wow-delay=".25s">
                    <div class="service-img">
                        <img src="/storage/assets/${data.image}" alt="">
                    </div>
                    <div class="service-icon">
                        <img src="collection/img/icon/${formattedServiceType}.svg" alt="">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title"><a href="{{ url('/${serviceType}') }}">${data.name}</a></h3>
                        <p class="service-text">${data.description1}</p>
                        <div class="service-arrow">
                            <a href="{{ url('/${serviceType}') }}" class="theme-btn">Read More<i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>`;
        }

        function renderFeatures(data) {
            return data.map(item => `
                <div class="col-md-6 col-lg-3">
                    <div class="feature-item wow fadeInUp" data-wow-delay=".25s">
                        <div class="feature-icon">
                            <img src="/storage/assets/${item.image}" alt>
                        </div>
                        <div class="feature-content">
                            <h4>${item.name}</h4>
                            <p>${item.description}</p>
                        </div>
                    </div>
                </div>`).join('');
        }

        function renderFleet(data) {
            return `
                <div class="testimonial-slider owl-carousel owl-theme">
                    ${data.map(item => `
                        <div class="testimonial-single">
                            <div class="rate-item wow fadeInUp" data-wow-delay=".25s">
                                <div class="rate-header">
                                    <div class="rate-img">
                                        <img src="/storage/assets/${item.image}" alt="${item.title}" />
                                    </div>
                                </div>
                                <div class="rate-header-content">
                                    <h5>${item.title}</h5>
                                </div>
                            </div>
                        </div>
                    `).join('')}
                </div>
            `;
        }

        async function loadAllHomeData() {
            await Promise.all([
                fetchAndRender('/api/v1/about/1', 'aboutData', renderAboutUs),
                fetchAndRender('/api/v1/corporate-hire/1', 'corporateHireData', data => renderService(data, 'corporate_hire')),
                fetchAndRender('/api/v1/employee-transportation/1', 'employeeTransportationData', data => renderService(data, 'employee_transportation')),
                fetchAndRender('/api/v1/fleet-management/1', 'fleetManagementData', data => renderService(data, 'fleet_management')),
                fetchAndRender('/api/v1/feature', 'featureData', renderFeatures),
                fetchAndRender('/api/v1/home_testimonial', 'fleetData', renderFleet)
            ]);

            initializeOwlCarousels();
        }

        function initializeOwlCarousels() {
            // Initialize hero slider
            $('.hero-slider').owlCarousel({
                items: 1,
                loop: true,
                nav: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 5000,
                smartSpeed: 1000,
                navText: ["<i class='far fa-long-arrow-left'></i>", "<i class='far fa-long-arrow-right'></i>"],
            });

            // Initialize fleet slider
            $('.testimonial-slider').owlCarousel({
                loop: true,
                margin: 30,
                nav: false,
                dots: true,
                autoplay: true,
                autoplayTimeout: 5000,
                smartSpeed: 1000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });
        }

        // Call the main function to load all data
        loadAllHomeData();
    </script>
    @endpush
@endsection