@extends('frontend.layout')
@section('content')
    <main class="main">
        <div class="site-breadcrumb" id="breadcrumb">
            <div class="container">
                <h2 class="breadcrumb-title">About Us</h2>
            </div>
        </div>
        <div class="about-area py-120" id="aboutData">
            {{-- Dynamically loaded About Us data --}}
        </div>

        <div class="team-area bg py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <h2 class="site-title">Our Vision & Mission</h2>
                            <div class="heading-divider"></div>
                        </div>
                    </div>
                </div>
                <div class="row" id="visionMission">
                   {{-- Dynamically loaded Vision Mission --}}
                </div>
            </div>
        </div>

        <div class="faq-area py-120">
            <div class="container">
                <div class="row" id="whyChooseUsData">
                    {{-- Why Choose Us Data Loaded Automatically --}}
                </div>
            </div>
        </div>
    </main>

    @push('scripts')
    <script>
        async function fetchData(url) {
            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error('Failed to fetch data');
                }
                return await response.json();
            } catch (error) {
                console.error('Error:', error);
                return null; // Return null on error
            }
        }

        async function aboutUs() {
            const data = await fetchData('/api/v1/about/1');
            if (!data) return; // Exit if there's an error

           
            document.getElementById('breadcrumb').style.background = `url('storage/assets/${data.image}')`;

            const aboutUsData = `
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="about-left wow fadeInLeft" data-wow-delay=".25s">
                                <div class="about-img">
                                    <img src="storage/assets/${data.image}" alt="${data.title}">
                                </div>
                                <div class="about-experience">
                                    <div class="about-experience-icon">
                                        <img src="collection/img/icon/taxi-booking.svg" alt="Taxi Booking Icon">
                                    </div>
                                    <b>Smart Corporate <br> Travel Solutions</b>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="about-right wow fadeInRight" data-wow-delay=".25s">
                                <div class="site-heading mb-3">
                                    <span class="site-title-tagline justify-content-start">
                                        <i class="flaticon-drive"></i> About Us
                                    </span>
                                    <h2 class="site-title">${data.title}</h2>
                                </div>
                                <div class="about-text text-justify">
                                    <p>${data.description1}</p>
                                    <p>${data.description2}</p>
                                    <p>${data.description3}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
            document.querySelector("#aboutData").innerHTML = aboutUsData;
        }

        async function loadVision() {
            const data = await fetchData('/api/v1/vision-mission');
            if (!data) return; // Exit if there's an error

            const visionMissionHTML = data.map(item => `
                <div class="col-md-6 col-lg-6">
                    <div class="team-item wow fadeIn${item.id % 2 === 0 ? 'Up' : 'Down'}" data-wow-delay=".25s">
                        <div class="team-content">
                            <div>
                                <img src="/storage/assets/${item.image}" alt="${item.title}" width="100">
                            </div>
                            <div class="team-bio">
                                <h5><a>${item.title}</a></h5>
                                <p>${item.description}</p>
                            </div>
                        </div>
                    </div>
                </div>`).join('');

            document.querySelector('#visionMission').innerHTML = visionMissionHTML;
        }

        async function whyChooseUs() {
            const data = await fetchData('/api/v1/home_why/1');
            if (!data) return; // Exit if there's an error

            const whyChooseUsData = `
                <div class="col-lg-6">
                    <div class="faq-right">
                        <div class="site-heading mb-3">
                            <span class="site-title-tagline justify-content-start">Why Us</span>
                            <h2 class="site-title my-3">Why <span>Choose</span> Us</h2>
                        </div>
                        <p class="about-text">${data.description}</p>
                        <div class="faq-img mt-3">
                            <img src="/storage/assets/${data.image}" alt="Why Choose Us Image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="accordion" id="accordionExample">
                        ${[...Array(5)].map((_, i) => `
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading${i + 1}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse${i + 1}" aria-expanded="false"
                                        aria-controls="collapse${i + 1}">
                                        <span><i class="far fa-question"></i></span> ${i + 1}. ${data[`title${i + 1}`]}
                                    </button>
                                </h2>
                                <div id="collapse${i + 1}" class="accordion-collapse collapse"
                                    aria-labelledby="heading${i + 1}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                       ${data[`description${i + 1}`]}
                                    </div>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>`;
            document.querySelector("#whyChooseUsData").innerHTML = whyChooseUsData;
        }

        loadVision();
        aboutUs();
        whyChooseUs();
    </script>
    @endpush

@endsection
