@extends('layouts.app')

@section('content')
<div class="container py-5">
    
    <!-- Header -->
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-dark mb-3">Actor Database</h1>
        <p class="lead text-muted">Discover amazing talent in our community</p>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h2 class="display-5 fw-bold text-primary mb-2">{{ $actors->count() }}</h2>
                    <p class="card-text text-muted mb-0">Total Actors</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h2 class="display-5 fw-bold text-success mb-2">{{ $actors->whereNotNull('gender')->count() }}</h2>
                    <p class="card-text text-muted mb-0">With Details</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card bg-primary text-white text-center h-100">
                <div class="card-body d-flex flex-column justify-content-center">
                    <a href="{{ route('actors.form') }}" class="text-white text-decoration-none">
                        <h2 class="display-5 fw-bold mb-2">
                            <i class="bi bi-plus-circle"></i>
                        </h2>
                        <p class="card-text mb-0">Add New Actor</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Actors Table -->
    @if ($actors->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Height</th>
                        <th>Weight</th>
                        <th>Age</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($actors as $actor)
                        <tr>
                            <td>{{ $actor->first_name }} {{ $actor->last_name }}</td>
                            <td>{{ $actor->email }}</td>
                            <td>{{ $actor->address }}</td>
                            <td>
                                @if($actor->gender)
                                    <span class="badge bg-success">{{ $actor->gender }}</span>
                                @else
                                    <span class="badge bg-secondary">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if($actor->height)
                                    <span class="badge bg-info">{{ $actor->height }}</span>
                                @else
                                    <span class="badge bg-secondary">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if($actor->weight)
                                    <span class="badge bg-warning text-dark">{{ $actor->weight }}</span>
                                @else
                                    <span class="badge bg-secondary">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if($actor->age)
                                    <span class="badge bg-danger">{{ $actor->age }}</span>
                                @else
                                    <span class="badge bg-secondary">N/A</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="bi bi-people display-1 text-muted"></i>
            </div>
            <h3 class="mb-3">No actors yet</h3>
            <p class="text-muted mb-4">Get started by adding the first actor to the database.</p>
            <a href="{{ route('actors.form') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-plus-circle me-2"></i>
                Add First Actor
            </a>
        </div>
    @endif
</div>
@endsection
