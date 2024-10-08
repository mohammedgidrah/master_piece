@extends('dashboard.maindasboard')

@section('content')
    {{-- <div class="container-xl px-4 mt-4"  style="padding-top: 75px"> --}}
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show bg-light" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show bg-light" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
        <div class="row" style="padding: 75px">
            <div class="col-xl-4">
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Picture</div>
                    <div class="card-body text-center">
                        <img class="img-account-profile rounded-circle mb-2"
                            src="{{ Auth::user()->image}} " class="avatar-img rounded-circle" style="width: 50%" alt="">

                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>

                        <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="file" name="image" class="form-control mb-3">
                            <button class="btn btn-primary" type="submit">Upload new image</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputFirstName">First name</label>
                                    <input class="form-control" id="inputFirstName" name="first_name" type="text"
                                        placeholder="Enter your first name" value="{{ Auth::user()->first_name }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Last name</label>
                                    <input class="form-control" id="inputLastName" name="last_name" type="text"
                                        placeholder="Enter your last name" value="{{ Auth::user()->last_name }}">
                                </div>
                            </div>

                            <div class="row gx-3 mb-3">
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                    <input class="form-control" id="inputEmailAddress" name="email" type="email"
                                        placeholder="Enter your email address" value="{{ Auth::user()->email }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLocation">Location</label>
                                    <input class="form-control" id="inputLocation" name="address" type="text"
                                        placeholder="Enter your address" value="{{ Auth::user()->address }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Phone number</label>
                                    <input class="form-control" id="inputPhone" name="phone" type="tel"
                                        placeholder="Enter your phone number" value="{{ Auth::user()->phone }}">
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
