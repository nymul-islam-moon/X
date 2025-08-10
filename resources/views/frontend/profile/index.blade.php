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
                    <!-- Optional search/phone here -->
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
                        <a href="#">Home</a>
                        <span>Profile</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Profile Tabs Section Begin -->
<section class="profile spad">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="profile-tabs card shadow-sm p-4 rounded-4 bg-white">

                    <!-- Tab Buttons -->
                    <ul class="nav nav-tabs mb-4" id="profileTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active fw-bold" id="view-tab" data-bs-toggle="tab" data-bs-target="#view" type="button" role="tab" aria-controls="view" aria-selected="true">
                                Profile Overview
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-bold" id="edit-tab" data-bs-toggle="tab" data-bs-target="#edit" type="button" role="tab" aria-controls="edit" aria-selected="false">
                                Edit Profile
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Contents -->
                    <div class="tab-content" id="profileTabContent">

                        <!-- Profile Overview Tab -->
                        <div class="tab-pane fade show active" id="view" role="tabpanel" aria-labelledby="view-tab">
                            <div class="d-flex flex-column flex-md-row align-items-center gap-4 mb-4">

                                {{-- Avatar --}}
                                <div class="profile-avatar rounded-circle overflow-hidden shadow" style="width:130px; height:130px;">
                                    <img 
                                        src="{{ auth()->user()->profile_photo_url ?? asset('frontend/img/default-avatar.png') }}" 
                                        alt="User Avatar" 
                                        style="width:100%; height:100%; object-fit:cover;">
                                </div>

                                {{-- User info --}}
                                <div class="flex-grow-1">
                                    <h3 class="mb-1">{{ auth()->user()->name }}</h3>
                                    <p class="text-muted mb-2"><i class="fa fa-envelope me-2"></i>{{ auth()->user()->email }}</p>
                                    @if(auth()->user()->phone)
                                        <p class="text-muted mb-2"><i class="fa fa-phone me-2"></i>{{ auth()->user()->phone }}</p>
                                    @endif
                                    <p class="text-muted mb-0"><i class="fa fa-calendar-alt me-2"></i>Joined on {{ auth()->user()->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div>
                                <h5 class="mb-3 fw-semibold border-bottom pb-2">Account Details</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <strong>Full Name:</strong> <br> {{ auth()->user()->name }}
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Email:</strong> <br> {{ auth()->user()->email }}
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Phone:</strong> <br> {{ auth()->user()->phone ?? 'Not set' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Profile Tab -->
                        <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                            @if(session('success'))
                                <div class="alert alert-success rounded-pill">{{ session('success') }}</div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger rounded-pill">{{ session('error') }}</div>
                            @endif

                            <form action="" method="POST" class="profile-form">
                                @csrf
                                @method('PUT')

                                <div class="row g-4">

                                    <div class="col-md-6">
                                        <label for="name" class="form-label fw-semibold">Full Name</label>
                                        <input 
                                            type="text" 
                                            name="name" 
                                            id="name" 
                                            class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                            value="{{ old('name', auth()->user()->name) }}" 
                                            placeholder="Your full name"
                                            required>
                                        @error('name')
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
                                            placeholder="Your email address"
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
                                            placeholder="Your phone number">
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6"></div>

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
                                        <button type="submit" class="site-btn px-5 py-3 fw-semibold">
                                            Update Profile
                                        </button>
                                    </div>

                                </div>
                            </form>

                            <hr class="my-5">

                            <div class="d-flex justify-content-center gap-3 flex-wrap">
                                <form action="" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger px-4 py-2 fw-semibold rounded-pill">
                                        <i class="fa fa-sign-out me-2"></i> Logout
                                    </button>
                                </form>

                                <form action="" method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');" class="d-inline">
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

            </div>
        </div>
    </div>
</section>
<!-- Profile Tabs Section End -->

<style>
    .profile-tabs {
        background-color: #fff;
    }
    .profile-avatar img {
        border-radius: 50%;
        border: 3px solid #ff6f61;
        width: 130px;
        height: 130px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .profile-avatar img:hover {
        transform: scale(1.1);
    }
    .site-btn {
        background: linear-gradient(90deg, #ff6f61, #ff3b2e);
        color: #fff;
        border: none;
        border-radius: 50px;
        font-weight: 600;
        transition: background 0.3s ease;
    }
    .site-btn:hover {
        background: linear-gradient(90deg, #ff3b2e, #ff6f61);
        color: #fff;
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
    /* Bootstrap 5 override for active tab font-weight */
    .nav-tabs .nav-link.active {
        color: #ff3b2e;
        border-color: #ff3b2e #ff3b2e #fff;
    }
    .form-label {
        font-weight: 600;
    }
</style>

<!-- Make sure Bootstrap 5 JS is loaded for tabs to work -->
@endsection
