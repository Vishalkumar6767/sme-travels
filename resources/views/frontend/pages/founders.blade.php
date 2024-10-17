@extends('frontend.layout')
@section('content')
<main class="main" id="founderContainerData">
   
</main>
@push('scripts')
<script>
   async function loadData(){
      try{
         const response = await fetch (`/api/v1/founder/1`);
         if(!response.ok){
            throw new Error("Failed to fetch data");
         }
         const data = await response.json();
         const founderData =` <div class="site-breadcrumb" style="background: url(collection/img/breadcrumb/01.jpg)">
       <div class="container">
          <h2 class="breadcrumb-title">Founders</h2>
       </div>
    </div>
    <div class="team-single py-120">
       <div class="container">
          <div class="team-single-wrapper">
             <div class="row align-items-center">
                <div class="col-lg-5">
                   <div class="team-single-img">
                      <img src="storage/assets/${data.image}" alt="${data.name}">
                   </div>
                </div>
                <div class="col-lg-7">
                   <div class="team-single-content">
                      <div class="team-single-name">
                         <h3>${data.name}</h3>
                         <p>Founder</p>
                      </div>
                      <div class="team-single-detail">
                         <p>${data.description}</p>
                      </div>
                      <div class="team-single-info">
                         <ul>
                            <li>
                               <span class="team-single-info-left"><i class="far fa-phone"></i> Phone:</span>
                               <span class="team-single-info-right"> +91 ${data.mobile }</span>
                            </li>
                            <li>
                               <span class="team-single-info-left"><i class="far fa-envelope"></i> Email:</span>
                               <span class="team-single-info-right"><a href="mailto:${data.email}" class="__cf_email__" >${data.email}</a></span>
                            </li>
                         </ul>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div> `;

         document.querySelector('#founderContainerData').innerHTML = founderData;


      }catch(error){
         console.error('Error',error);
      }
   }
   loadData();
</script>

   
@endpush
@endsection