@extends('frontend.layout')
@section('content')
    <main class="main">
        <div class="site-breadcrumb" style="background: url(collection/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Corporate Hire</h2>
            </div>
        </div>
        <div class="taxi-single pt-120 pb-100">
            <div class="container">
                <div class="taxi-single-wrapper">
                    <div class="row " id="corporateHireData">
                        
                    </div>
                </div>
            </div>
        </div>
    </main>
    @push('scripts')
    <script>
        async function loadData() {
            try {
                const response = await fetch('/api/v1/corporate-hire/1');
                if (!response.ok) {
                    throw new Error('Failed to fetch data');
                }
                const item  = await response.json();
               //  const item = data[0];
                console.log(item);

                // Create the HTML structure with the fetched data
                const solutionData = `
                    <div class="col-lg-5">
                        <div class="taxi-single-img">
                            <img src="/storage/assets/${item.image}" alt="${item.name}">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="about-right wow fadeInRight" data-wow-delay=".25s" 
                             style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInRight;">
                            <div class="site-heading mb-3">
                                <h2 class="site-title">${item.name}</h2>
                            </div>
                            <div class="about-text text-justify">
                                <p>${item.description1}</p>
                                <p>${item.description2}</p>
                                <p>${item.description3}</p>
                            </div>
                        </div>
                    </div>`;

                // Update the inner HTML of the target element
                document.querySelector('#corporateHireData').innerHTML = solutionData;

            } catch (error) {
                console.error('Error:', error);
            }
        }

        // Load the data when the script is executed
        loadData();
    </script>
@endpush

@endsection
