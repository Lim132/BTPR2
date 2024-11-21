@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <h2>Pets Pending Verification</h2>
        </div>
    </div>

    @if($unverifiedPets->isEmpty())
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            No pets pending verification at the moment.
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($unverifiedPets as $pet)
            <div class="col">
                <div class="card h-100">
                    @if($pet->photos && count($pet->photos) > 0)
                        <img src="{{ Storage::url($pet->photos[0]) }}" 
                            class="card-img-top" alt="Pet Photo"
                            style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $pet->name }}</h5>
                        <p class="card-text">
                            <small class="text-muted">Added by: {{ $pet->user->name }}</small>
                        </p>
                        <ul class="list-unstyled">
                            <li><strong>Species:</strong> {{ ucfirst($pet->species) }}</li>
                            <li><strong>Breed:</strong> {{ ucfirst($pet->breed) }}</li>
                            <li><strong>Age:</strong> {{ $pet->age }}</li>
                            <li><strong>Gender:</strong> {{ ucfirst($pet->gender) }}</li>
                            <li><strong>Health Status:</strong> 
                                @foreach($pet->healthStatus as $status)
                                    <span class="badge bg-info">{{ $status }}</span>
                                @endforeach
                            </li>
                        </ul>
                        <p class="card-text">{{ Str::limit($pet->description, 100) }}</p>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="button" class="btn btn-primary btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#petModal{{ $pet->id }}">
                                View Details
                            </button>
                            <div>
                                <form action="{{ route('pets.verify', $pet->id) }}" 
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-check me-1"></i>Verify
                                    </button>
                                </form>
                                <form action="{{ route('pets.reject', $pet->id) }}" 
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-times me-1"></i>Reject
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="petModal{{ $pet->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $pet->name }} - Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    @if($pet->photos && count($pet->photos) > 0)
                                        <div id="petCarousel{{ $pet->id }}" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach($pet->photos as $index => $photo)
                                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                        <img src="{{ Storage::url($photo) }}" 
                                                            class="d-block w-100" alt="Pet Photo">
                                                    </div>
                                                @endforeach
                                            </div>
                                            @if(count($pet->photos) > 1)
                                                <button class="carousel-control-prev" type="button" 
                                                    data-bs-target="#petCarousel{{ $pet->id }}" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon"></span>
                                                </button>
                                                <button class="carousel-control-next" type="button" 
                                                    data-bs-target="#petCarousel{{ $pet->id }}" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon"></span>
                                                </button>
                                            @endif
                                        </div>
                                    @endif
                                    @if($pet->videos)
                                        @foreach($pet->videos as $video)
                                            <video controls class="w-100 mt-2">
                                                <source src="{{ Storage::url($video) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <h6>Basic Information</h6>
                                    <ul class="list-unstyled">
                                        <li><strong>Species:</strong> {{ ucfirst($pet->species) }}</li>
                                        <li><strong>Breed:</strong> {{ ucfirst($pet->breed) }}</li>
                                        <li><strong>Age:</strong> {{ $pet->age }}</li>
                                        <li><strong>Gender:</strong> {{ ucfirst($pet->gender) }}</li>
                                        <li><strong>Color:</strong> {{ ucfirst($pet->color) }}</li>
                                        <li><strong>Size:</strong> {{ ucfirst($pet->size) }}</li>
                                        <li><strong>Vaccinated:</strong> 
                                            <span class="badge {{ $pet->vaccinated ? 'bg-success' : 'bg-warning' }}">
                                                {{ $pet->vaccinated ? 'Yes' : 'No' }}
                                            </span>
                                        </li>
                                    </ul>
                                    <h6>Health Status</h6>
                                    <div class="mb-3">
                                        @foreach($pet->healthStatus as $status)
                                            <span class="badge bg-info">{{ $status }}</span>
                                        @endforeach
                                    </div>
                                    <h6>Description</h6>
                                    <p>{{ $pet->description }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection