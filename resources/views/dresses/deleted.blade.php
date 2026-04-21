@extends('layouts.app')

@section('title', 'Recently Deleted Dresses')

@section('nav-actions')
<div style="display:flex; align-items:center; gap:10px;">
    <button
        type="button"
        class="pb-button pb-button-top home-button"
        onclick="window.location.href='{{ route('dresses.index') }}'">
        <span class="button-text">Dresses</span>
        <span class="pb-icon">
            <svg viewBox="0 0 20 20" aria-hidden="true" class="rotated-icon">
                <path d="M4.5 10h10M10.5 5l4.5 5-4.5 5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"/>
            </svg>
        </span>
    </button>
</div>
@endsection

@section('hero')
<div class="dresses-container">
    <div class="dresses-page-header">
        <div class="dresses-page-copy">
            <p class="dresses-page-kicker">Recently deleted</p>
            <h2>Deleted dresses</h2>
        </div>
    </div>

    <div class="dresses-grid">
        @forelse($deletedDresses as $dress)
            <div class="dress-card">
                <div class="dress-card-media">
                    @if ($dress->image_path)
                        <img src="{{ asset('storage/' . $dress->image_path) }}" alt="{{ $dress->name }}">
                    @else
                        <div
                            class="dress-card-image-placeholder"
                            aria-label="No image available for {{ $dress->name }}"
                        >
                            No image
                        </div>
                    @endif

                    <span class="dress-size-badge">{{ $dress->sizes ?: 'N/A' }}</span>
                </div>

                <div class="dress-card-body">
                    <div class="dress-card-copy">
                        <div class="dress-card-header">
                            <h3>{{ $dress->name }}</h3>

                            <div class="dress-card-actions" aria-label="Deleted dress actions">
                                <form method="POST" action="{{ route('dresses.restore', $dress->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="dress-card-action" aria-label="Restore {{ $dress->name }}" style="color: #48c264;">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <!-- Circular arrow -->
                                            <path d="M21 12a9 9 0 1 1-3-6.7" />
                                            <!-- Arrow head -->
                                            <path d="M21 3v6h-6" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <p>Category: {{ $dress->category->name ?? 'N/A' }}</p>
                        <p>Location: {{ $dress->location->name ?? 'N/A' }}</p>
                        <p>Brand: {{ $dress->brand ?: 'N/A' }}</p>
                        <p>Deleted: {{ optional($dress->deleted_at)->diffForHumans() ?? 'Recently' }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="dresses-empty-state">
                <p>No deleted dresses found.</p>
            </div>
        @endforelse
    </div>

    @if ($deletedDresses->hasPages())
        <div class="dresses-pagination-wrap">
            {{ $deletedDresses->onEachSide(1)->links('vendor.pagination.dresses') }}
        </div>
    @endif
</div>
@endsection

@section('hero-footer')
    @include('layouts.footer')
@endsection
