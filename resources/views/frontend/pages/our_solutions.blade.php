@extends('frontend.layout')

@section('content')
<main class="main">
    <div class="site-breadcrumb" style="background: url(collection/img/breadcrumb/01.jpg)">
        <div class="container">
            <h2 class="breadcrumb-title">Our Solutions</h2>
        </div>
    </div>
    <div class="taxi-single pt-120 pb-100">
        <div class="container">
            <div class="taxi-single-wrapper" id="solutionsData">
                <!-- Dynamic content will be inserted here -->
            </div>
        </div>
    </div>
</main>

@push('scripts')
<script>
    async function loadData() {
        try {
            const response = await fetch(`/api/v1/our-solution`);
            if (!response.ok) {
                throw new Error('Failed to fetch data');
            }
            const data = await response.json();
            const solutionData = document.querySelector('#solutionsData');

            // Create HTML structure for each solution and populate data
            const tableData = data.map(item => {
                if (item.id % 2 === 0) { // Even ID
                    return `
                        <div class="row pt-50 pb-30">
                            <div class="col-lg-8">
                                <div class="taxi-single-overview">
                                    <h4 class="mb-3">${item.name}</h4>
                                    <div class="mb-4">
                                        <p>${item.description}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="taxi-single-img taxi-single-img2">
                                    <img src="/storage/assets/${item.image}" alt="${item.name}">
                                </div>
                            </div>
                        </div>`;
                } else { // Odd ID
                    return `
                        <div class="row pb-30">
                            <div class="col-lg-4">
                                <div class="taxi-single-img taxi-single-img2">
                                    <img src="/storage/assets/${item.image}" alt="${item.name}">
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="taxi-single-overview">
                                    <h4 class="mb-3">${item.name}</h4>
                                    <div class="mb-4">
                                        <p>${item.description}</p>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                }
            }); 

            solutionData.innerHTML = tableData;
        } catch (error) {
            console.error('Error:', error);
        }
    }

    // Call loadData when the page loads
    loadData();
</script>
@endpush
@endsection
