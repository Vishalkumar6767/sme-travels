@extends('sme_Cpanel.layout')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Testimonial</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/index') }}">Home</a></li>
                <li class="breadcrumb-item active">Edit Testimonial</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Update Activity</h5>
                       
                        <!-- Vertical Form -->
                        <form class="row g-3" method="POST" action="{{ route('activity.update', $activity->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="col-12">
                                <label for="inputName" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="inputName" value="{{ $activity->name }}" required>
                            </div>
                            <div class="col-12">
                                <label for="descp" class="form-label">Message</label>
                                <textarea name="message" rows="5" id="descp" class="form-control" required>{{ $activity->description }}</textarea>
                            </div>
                            <br>
                            <div>
                                <img src="{{ asset('storage/assets/' . $activity->image) }}" width="100" alt="{{ $activity->name }} Image">
                            </div>
                            <div class="col-12">
                                <label for="descp" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" id="imageUpload" required accept="image/jpg, image/jpeg, image/png" onchange="return fileValidation(this)">{{ $activity->image }}</input>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form><!-- End Vertical Form -->

                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection
