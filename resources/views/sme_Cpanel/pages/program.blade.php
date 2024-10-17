@extends('sme_Cpanel.layout')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>{{ $program->name }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Home</a></li>
                <li class="breadcrumb-item">{{  $program->name }}</li>

            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">


            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{  $program->name }}</h5>
                                                <!-- Vertical Form -->
                        <div class="row">
                            <div class="col-md-12">
                               
                                
                                <a href="{{ route('program.edit', ['id' => 1]) }}">
                                    <button class="btn btn-primary " style="">Pre-Nursery</button></a>
                                <a href="{{ route('program.edit', ['id' => 2]) }}">
                                    <button class="btn btn-primary " style="">Primary School</button></a>
                                <a href="{{ route('program.edit', ['id' => 3]) }}">
                                    <button class="btn btn-primary " style="">Middle School</button></a>
                                <a href="{{ route('program.edit', ['id' => 4]) }}">
                                    <button class="btn btn-primary " style="">High School</button></a>
                            
                            </div>


                        </div>
                        <br>
                        <form class="row g-3" method="POST" action="{{ route('program.update', $program->id) }}" enctype="multipart/form-data">
                            @csrf
    @method('PUT')

                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Image</label>
                                <input type="file" name="image"
                                       class="form-control"
                                       accept="image/jpg, image/jpeg, image/png"
                                       id="imageUpload" onchange="return fileValidation(this)" >
                            </div>
							
							 <div class="col-12">
                                <label for="inputNanme4" class="form-label">Name</label>
                                <input type="text" class="form-control"
                                       name="title" value="{{ old('name', $program->name) }}"
                                       id="inputNanme4" required>
                            </div>
							<div class="col-12">
                                <label for="inputNanme4" class="form-label">Year</label>
                                <input type="text" class="form-control"
                                       name="title2" value="{{ old('year', $program->year) }}"
                                       id="inputNanme4" >
                            </div>
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Description</label>
                                <textarea name="descp" rows="5" id="descp" class="form-control">
                                    {{ old('description', $program->description) }}
</textarea>
                            </div>

<div class="col-12">
                                <label for="inputNanme4" class="form-label">Curriculum Highlights</label>
                                <textarea name="descp2" rows="5" id="descp2" class="form-control">
                                    {{ old('curriculum_highlights', $program->curriculum_highlights) }}
</textarea>
                            </div>
                            <div class="col-4">
                                <img src="{{ asset('storage/assets/' . $program->image) }}" height="300" width="300">
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
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script type="text/javascript">
    CKEDITOR.replace('descp');
   CKEDITOR.replace('descp2');
</script>
@endsection