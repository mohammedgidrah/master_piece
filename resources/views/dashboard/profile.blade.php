@extends('dashboard.maindasboard')

@section('content')

    <!-- Container for the profile section -->
    <div class="row" style="padding: 100px">
        <!-- Profile Picture Column -->
        <div class="col-xl-4">
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <img class="img-account-profile rounded-circle mb-2" src="{{ asset('storage/' . Auth::user()->image) }}"
                        alt="Profile Image" style="width: 60%; height: auto;" />
                    <div class="font-italic text-muted mb-4">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                </div>
            </div>
        </div>

        <!-- Account Details Column -->
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    <!-- Merged Form for both Profile Picture and User Details -->
                    <form action="{{ route('profile.update', Auth::user()->id) }}" id="profileForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Image Upload Input -->
                        <div class="mb-3">
                            <label class="small mb-1" for="image">Profile Picture</label>
                            <input type="file" name="image" class="form-control mb-3">
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">First name</label>
                                <input class="form-control" id="inputFirstName" name="first_name" type="text"
                                    placeholder="Enter your first name"
                                    value="{{ old('first_name', Auth::user()->first_name) }}">
                                @error('first_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Last name</label>
                                <input class="form-control" id="inputLastName" name="last_name" type="text"
                                    placeholder="Enter your last name"
                                    value="{{ old('last_name', Auth::user()->last_name) }}">
                                @error('last_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                <input class="form-control" id="inputEmailAddress" name="email" type="email"
                                    placeholder="Enter your email address"
                                    value="{{ old('email', Auth::user()->email) }}">
                                <div class="text-danger" id="emailError"></div> <!-- Added error element here -->
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLocation">Location</label>
                                <input class="form-control" id="inputLocation" name="address" type="text"
                                    placeholder="Enter your address"
                                    value="{{ old('address', Auth::user()->address) }}">
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                <input class="form-control" id="inputPhone" name="phone" type="tel"
                                    placeholder="Enter your phone number"
                                    value="{{ old('phone', Auth::user()->phone) }}">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1" for="password">Password</label>
                                <input class="form-control" id="password" name="password" type="password"
                                    placeholder="Enter your new password">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for validation -->
    <script>
        @if (session('success'))
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Your work has been saved",
                showConfirmButton: false,
                timer: 1500
            });
        @endif

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('profileForm');
            const emailInput = document.getElementById('inputEmailAddress');
            const emailErrorElement = document.getElementById('emailError'); // Reference to the error element

            form.addEventListener('submit', function(event) {
                let isValid = true; // Flag to check if all validations pass

                // Clear previous error messages
                emailErrorElement.textContent = ''; // Clear error message

                // Email validation
                const emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/; // Updated regex pattern
                if (!emailPattern.test(emailInput.value)) {
                    emailErrorElement.textContent = 'Please enter a valid email address ending with @gmail.com.';
                    isValid = false;
                }

                // If all validations fail, prevent form submission
                if (!isValid) {
                    event.preventDefault(); // Prevent the default form submission
                }
            });

            // Clear error message when the user starts typing
            emailInput.addEventListener('input', function() {
                emailErrorElement.textContent = ''; // Clear error message
            });
        });
    </script>
@endsection
