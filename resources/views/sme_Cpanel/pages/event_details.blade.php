@extends('sme_Cpanel.layout')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>{{ $eventsCategory->name }} - Events </h1> 
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Home</a></li>
                <li class="breadcrumb-item">{{ $eventsCategory->name }} - Events </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $eventsCategory->name }} - Events</h5>
                        <!-- Vertical Form -->
                        <form class="row g-3" method="post" action="{{ route('event.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
            
                            <div class="col-6">
                                <label for="imageUpload" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" id="imageUpload" required accept="image/jpg, image/jpeg, image/png" onchange="return fileValidation(this)">
                            </div>
                            <div class="col-6" style="display:none">
                                <label for="categoryId" class="form-label">Category ID</label>
                                <input type="text" class="form-control" name="events_categories_id" id="categoryId" value="{{ $eventsCategory->id }}" readonly>
                            </div>

                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Events Gallery</h5>
                        @if ($events->isEmpty())
                            <p>No events found.</p>
                        @else
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Add Events</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $event)
                                        <tr>
                                            <td>{{ $event->id }}</td>
                                            <td>{{ $event->name }}</td>
                                            <td>
                                                <!-- Assuming you have a method to get image URL -->
                                                <img src="{{ asset('storage/assets/' . $event->image) }}" alt="{{ $event->name }}" width="100">
                                            </td>
                                            <td>
                                                <a href="{{ route('event_details.create', ['event' => $event->id]) }}">
                                                    <button data-toggle="tooltip" title="Add Events" class="btn btn-green btn-xs">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('event.edit', ['event' => $event->id]) }}">
                                                    <button data-toggle="tooltip" title="Edit" class="btn btn-green btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </a>
                                            </td>
                                            <td>
                                                <form method="POST" action="{{ route('event.destroy', ['event' => $event->id]) }}" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-xs">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection
