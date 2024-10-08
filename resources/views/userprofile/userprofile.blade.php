<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/homepage.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    
    @include('homepage.homenav.homenav')    
   
    
    <div class="main-panel" style="padding-top: 125px">
    
    
        
            <div class="row" style="padding: 75px">
                <div class="col-xl-4">
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Profile Picture</div>
                        <div class="card-body text-center">
                            <img class="img-account-profile rounded-circle mb-2"
                                 src="{{ asset('storage/' . Auth::user()->image) }}" 
                                 class="avatar-img rounded-circle" 
                                 style="width: 50%" alt="">
        
                            <div class=" font-italic text-muted mb-4">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} </div>
                        </div>
                    </div>
                </div>
        
                <div class="col-xl-8">
                    <div class="card mb-4">
                        <div class="card-header">Account Details</div>
                        <div class="card-body">
                            <!-- Merged Form for both Profile Picture and User Details -->
                            <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
        
                                <!-- Image Upload Input -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="image">Profile Picture</label>
                                    <input type="file" name="image" class="form-control mb-3">
                                </div>
        
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
                                    <div class="col-md-6">
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
</body>
</html>
    
 