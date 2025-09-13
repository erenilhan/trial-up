@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <!-- Header -->
            <div class="text-center mb-4">
                <h2 class="display-6 fw-bold text-dark mb-3">Join Our Database</h2>
                <p class="lead text-muted">Share your story and become part of our talent community</p>
            </div>

            <!-- Form Card -->
            <div class="card">
                <div class="card-body p-4">
                    
                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="alert-heading">Please correct the following errors:</h6>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Form -->
                    <form action="{{ route('actors.store') }}" method="POST">
                        @csrf

                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="bi bi-envelope me-2"></i>Email Address
                            </label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   placeholder="your.email@example.com" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description Field -->
                        <div class="mb-3">
                            <label for="description" class="form-label">
                                <i class="bi bi-chat-text me-2"></i>Tell Us About Yourself
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="6" 
                                      placeholder="Hi! I'm John Doe and I live at 123 Main Street, Springfield, IL 62704. I'm passionate about acting and have been performing for..." 
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <!-- Info Box -->
                            <div class="alert alert-info mt-3" role="alert">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-info-circle-fill"></i>
                                    </div>
                                    <div class="ms-3">
                                        <p class="mb-0 small">
                                            <strong>Required Information:</strong> Please include your <strong>first name</strong>, <strong>last name</strong>, and <strong>complete address</strong> in your description. Our AI will extract this information automatically.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-send me-2"></i>
                                Submit Your Information
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Back Link -->
            <div class="text-center mt-4">
                <a href="{{ route('actors.table') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>
                    Back to Database
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
