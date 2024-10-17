@extends('frontend.layout')
@section('content')
<main class="main" id= "fleetManagementContainer">
   
 </main>
@push('scripts')
<script>
     async function loadData(){
      try{
         const response = await fetch(`/api/v1/fleet-management/1`);
         if(!response.ok){
            throw new Error('Failed to fetch data');
         }
         const data = await response.json();
         const fleetData = `
          <div class="site-breadcrumb" style="background: url(storage/assets/${data.image})">
       <div class="container">
          <h2 class="breadcrumb-title">Fleet Management</h2>
       </div>
    </div>
    <div class="taxi-single pt-120 pb-100">
       <div class="container">
          <div class="taxi-single-wrapper">
             <div class="row">
                <div class="col-lg-5">
                   <div class="taxi-single-img">
                      <img src="storage/assets/${data.image}" alt="${data.name}">
                   </div>
                </div>
                <div class="col-lg-7">
                   <div class="about-right wow fadeInRight" data-wow-delay=".25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInRight;">
                      <div class="site-heading mb-3">
                         <h2 class="site-title">
                           ${data.name}
                         </h2>
                      </div>
                      <div class="about-text text-justify">
                         <p> ${data.description1} </p>
                         <p>${data.description2}</p>
                         <p>${data.description3}</p>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
         `;
         document.querySelector('#fleetManagementContainer').innerHTML = fleetData;

      }catch(error){
         console.log('Error',error);

      }

  }
  loadData();

</script>
   
@endpush
@endsection