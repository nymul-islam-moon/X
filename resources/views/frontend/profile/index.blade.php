@extends('layouts.frontend.app')

@section('frontend_content')
<!-- Hero Section Begin -->
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All departments</span>
                    </div>
                    <ul>
                        <li><a href="#">Fresh Meat</a></li>
                        <li><a href="#">Vegetables</a></li>
                        <li><a href="#">Fruit & Nut Gifts</a></li>
                        <li><a href="#">Fresh Berries</a></li>
                        <li><a href="#">Ocean Foods</a></li>
                        <li><a href="#">Butter & Eggs</a></li>
                        <li><a href="#">Fastfood</a></li>
                        <li><a href="#">Fresh Onion</a></li>
                        <li><a href="#">Papayaya & Crisps</a></li>
                        <li><a href="#">Oatmeal</a></li>
                        <li><a href="#">Fresh Bananas</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <!-- Keep your search/phone blocks here if needed -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>My Profile</h2>
                    <div class="breadcrumb__option">
                        <a href="">Home</a>
                        <span>Profile</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Profile Section Begin -->
<section class="profile spad">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-8">
                <div class="contact__form__title mb-4 text-center">
                    <h2>Your Profile Details</h2>
                </div>

                @if(session('success'))
                    <div class="alert alert-success rounded-pill">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger rounded-pill">{{ session('error') }}</div>
                @endif

                <div class="d-flex flex-column flex-md-row align-items-center mb-5 gap-4">
                    {{-- User Avatar --}}
                    <div class="profile-avatar rounded-circle overflow-hidden shadow" style="width:120px; height:120px; flex-shrink:0;">
                        <img 
                            src="{{ auth()->user()->profile_photo_url ?? asset('frontend/img/default-avatar.png') }}" 
                            alt="User Avatar" 
                            style="width:100%; height:100%; object-fit:cover;">
                    </div>

                    {{-- User Name and Email --}}
                    <div class="profile-info">
                        <h3 class="mb-1">{{ auth()->user()->name }}</h3>
                        <p class="text-muted mb-0"><i class="fa fa-envelope"></i> {{ auth()->user()->email }}</p>
                        @if(auth()->user()->phone)
                            <p class="text-muted"><i class="fa fa-phone"></i> {{ auth()->user()->phone }}</p>
                        @endif
                    </div>
                </div>

                <form action="" method="POST" class="profile-form">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold">First Name</label>
                            <input 
                                type="text" 
                                name="first_name" 
                                id="first_name" 
                                class="form-control form-control-lg @error('first_name') is-invalid @enderror" 
                                value="{{ old('first_name', auth()->user()->first_name) }}" 
                                placeholder="Enter your first name"
                                required>
                            @error('first_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="last_name" class="form-label fw-semibold">Last Name</label>
                            <input 
                                type="text" 
                                name="last_name" 
                                id="last_name" 
                                class="form-control form-control-lg @error('last_name') is-invalid @enderror" 
                                value="{{ old('last_name', auth()->user()->last_name) }}" 
                                placeholder="Enter your last name"
                                required>
                            @error('last_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                value="{{ old('email', auth()->user()->email) }}" 
                                placeholder="Enter your email address"
                                required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label fw-semibold">Phone Number</label>
                            <input 
                                type="text" 
                                name="phone" 
                                id="phone" 
                                class="form-control form-control-lg @error('phone') is-invalid @enderror" 
                                value="{{ old('phone', auth()->user()->phone ?? '') }}" 
                                placeholder="Enter your phone number">
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="col-md-6">
                            <label for="password" class="form-label fw-semibold">New Password <small class="text-muted">(Leave blank if no change)</small></label>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                placeholder="********">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                id="password_confirmation" 
                                class="form-control form-control-lg" 
                                placeholder="********">
                        </div>

                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="site-btn px-5 py-3 fw-bold">
                                Update Profile
                            </button>
                        </div>
                    </div>
                </form>

                <hr class="my-5">

                <div class="d-flex justify-content-between flex-wrap gap-3">
                    <form action="" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger px-4 py-2 fw-semibold rounded-pill">
                            <i class="fa fa-sign-out me-2"></i> Logout
                        </button>
                    </form>

                    <form action="" method="POST" 
                        onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');"
                        class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger px-4 py-2 fw-semibold rounded-pill">
                            <i class="fa fa-trash me-2"></i> Delete Account
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Profile Section End -->

<style>
    /* Add subtle shadow and border radius to inputs */
    .profile-form .form-control {
        border-radius: 8px;
        box-shadow: inset 0 2px 6px rgba(0,0,0,0.05);
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .profile-form .form-control:focus {
        border-color: #ff6f61;
        box-shadow: 0 0 8px rgba(255,111,97,0.5);
    }
    .profile-avatar img {
        border-radius: 50%;
        border: 3px solid #ff6f61;
        transition: transform 0.3s ease;
    }
    .profile-avatar img:hover {
        transform: scale(1.1);
    }
    .site-btn {
        background-color: #ff6f61;
        border: none;
        border-radius: 50px;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }
    .site-btn:hover {
        background-color: #e55a4e;
    }
    .btn-danger, .btn-outline-danger {
        border-radius: 50px;
        font-weight: 600;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    .btn-danger:hover {
        background-color: #d94a3a !important;
        border-color: #d94a3a !important;
    }
    .btn-outline-danger:hover {
        background-color: #d94a3a !important;
        color: #fff !important;
        border-color: #d94a3a !important;
    }
</style>
@endsection
