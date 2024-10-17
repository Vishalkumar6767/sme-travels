@extends('frontend.layout')
@section('content')
    <main class="main">
        <div class="site-breadcrumb" style="background: url(collection/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Fleet</h2>
            </div>
        </div>
        <div class="related-taxi pb-120 pt-50">
            <div class="container">
                <div class="taxi-single-related">
                    <div class="row"id=fleetData>

                        {{-- Fleet data loaded Dynamically --}}
                    </div>
                </div>
            </div>
        </div>
    </main>
    @push('scripts')
        <script>
            async function fleet() {
                try {
                    const response = await fetch(`/api/v1/home_testimonial`);
                    if (!response.ok) {
                        throw new Error("Failed to fetch data");
                    }
                    const data = await response.json();
                    console.log(data);
                    const fleetData = document.querySelector('#fleetData');
                    const fleetsDeta = data.map(item => {
                        return `
                <div class="col-md-6 col-lg-4" >
                            <div class="taxi-item">
                                <div class="rate-item wow fadeInUp" data-wow-delay=".25s"
                                    style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                                    <div class="rate-header">
                                        <div class="rate-img">
                                            <img src="/storage/assets/${item.image}"  alt="">
                                        </div>
                                    </div>
                                    <div class="rate-header-content">
                                        <h5>${item.title}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    }).join('');
                    fleetData.innerHTML = fleetsDeta;
                } catch (error) {
                    console.error('Error:', error);
                }
            }
            fleet();
        </script>
    @endpush
@endsection
