@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row" style="margin-top: 10px;">
        {{-- 左侧分类 --}}
        <div class="col-md-2">
            <div class="list-group">
                <a href="{{ route('showAdp') }}" 
                    class="list-group-item list-group-item-action {{ !request('species') ? 'active' : '' }}">
                    All Categories
                </a>
                <a href="{{ route('showAdp', ['species' => 'cat']) }}" 
                    class="list-group-item list-group-item-action {{ request('species') === 'cat' ? 'active' : '' }}">
                    Cat
                </a>
                <a href="{{ route('showAdp', ['species' => 'dog']) }}" 
                    class="list-group-item list-group-item-action {{ request('species') === 'dog' ? 'active' : '' }}">
                    Dog
                </a>
                <a href="{{ route('showAdp', ['species' => 'other']) }}" 
                    class="list-group-item list-group-item-action {{ request('species') === 'other' ? 'active' : '' }}">
                    Other
                </a>
            </div>
            <br>
        </div>

        <div class="col-md-1"></div>

        {{-- 宠物列表 --}}
        <div class="col-md-8">
            <div class="card border-0">
                <h5 class="title1 card-title">Pets for Adoption</h5>
                <div class="row">
                    @forelse($pets as $pet)
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="pet-title">{{ $pet->name }}</h5>
                                    @if($pet->photos && count($pet->photos) > 0)
                                        <img src="{{ Storage::url($pet->photos[0]) }}" 
                                            class="pet-img card-img-bottom" 
                                            alt="{{ $pet->name }}"
                                            style="height: 200px; object-fit: cover;">
                                    @endif
                                    <div class="row mt-3">
                                        <div class="col-7">
                                            <div class="card-heading">
                                                <p class="mb-1"><strong>Age:</strong> {{ $pet->age }} years</p>
                                                <p class="mb-1"><strong>Species:</strong> {{ ucfirst($pet->species) }}</p>
                                                <p class="mb-1"><strong>Breed:</strong> {{ ucfirst($pet->breed) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-5 text-end">
                                            <a href="{{ route('pets.show', $pet->id) }}" 
                                                class="btn btn-danger btn-sm">
                                                See Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info">
                                No pets available for adoption at the moment.
                            </div>
                        </div>
                    @endforelse
                </div>

                {{-- 分页 --}}
                <div class="d-flex justify-content-end">
                    {{ $pets->links() }}
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>


@endsection