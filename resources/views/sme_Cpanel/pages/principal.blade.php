@extends('sme_Cpanel.layout')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Principal Message</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Home</a></li>
                <li class="breadcrumb-item">Principal Message</li>

            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">


            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Principal Message</h5>
                                                <!-- Vertical Form -->
                        <form class="row g-3" method="post" enctype="multipart/form-data">

                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Image</label>
                                <input type="file" name="image"
                                       class="form-control"
                                       accept="image/jpg, image/jpeg, image/png"
                                       id="imageUpload" onchange="return fileValidation(this)">
                            </div>
							 <div class="col-12">
                                <label for="inputNanme4" class="form-label">Name</label>
                                <input type="text" class="form-control"
                                       name="title" value="Thippe Rudraiah"
                                       id="inputNanme4">
                            </div>
							
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Description</label>
                                <textarea name="descp" rows="5" id="descp" class="form-control">
                                    <p>As the Principal of New Horizon Public School, I am proud to share our educational philosophy and vision for the future. Since our establishment in 1991, we have been dedicated to fostering an environment that nurtures holistic development, ensuring that every student not only excels academically but also grows in character and values.</p>
<p>At New Horizon Public School, we believe that education is more than just imparting knowledge. It is about inspiring curiosity, encouraging creativity, and instilling a sense of responsibility in our students. Our dedicated faculty is committed to creating a supportive and dynamic learning environment where each student can explore their unique talents and potential.</p>
<p>We emphasize the importance of lifelong learning, critical thinking, and adaptability, especially in today's rapidly changing world. Our curriculum is designed to be student-centered, focusing on experiential learning and problem-solving skills, which are essential for success in the 21st century.</p>
<p>We also place great value on community and collaboration. By working closely with parents, teachers, and students, we strive to create a strong support system that helps every student thrive. Together, we aim to prepare our students not only for academic success but for life beyond the classroom, where they can contribute positively to society.</p>
<p>I invite you to join us on this journey of learning and growth, where every day brings new opportunities to make a difference.</p>
<p>Warm regards,<br />Thippe Rudraiah<br />Principal, New Horizon Public School</p></textarea>
                            </div>

                           
<div class="row">
                                <div class="col-md-12">
                                    <img src="images/about/STE1725369453.jpg" height="300" width="300">
                                </div>
                            </div>

                            <div class="text-left">
                                <button type="submit" name="submit" class="btn btn-primary">Update</button>

                            </div>
                        </form><!-- Vertical Form -->


                   

    
						
				
						
                    </div>
                </div>



            </div>
        </div>



    </section>

</main><!-- End #main -->
@endsection