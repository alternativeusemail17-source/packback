@extends('layouts.app')

@section('title', 'Dresses')

@section('hero')
<div class="dresses-container">
    <div class="dresses-page-header">
        <div class="dresses-page-copy">
            <p class="dresses-page-kicker">Add your dresses</p>
            <h2>Build your wardrobe board.</h2>
        </div>

        <div class="dresses-page-actions">
            <a href="{{ route('dresses.deleted') }}" class="dresses-page-delete-link" aria-label="Recently deleted dresses">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="24" height="24">
                    <path d="M3 6h18" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M8 6V4h8v2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M19 6l-1 14H6L5 6" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M10 11v6" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M14 11v6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>

            <button type="button" class="pb-button pb-button-top" onclick="window.location.href='{{ route('dresses.create') }}'">
                <span class="button-text">Add Dress</span>
                <div class="pb-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </button>
        </div>
    </div>

    <div class="dresses-grid">
        @forelse($dresses as $dress)
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

                            <div class="dress-card-actions" aria-label="Dress actions">
                                <a href="{{ route('dresses.edit', $dress) }}" class="dress-card-action" aria-label="Edit {{ $dress->name }}" style="color: #48c264;">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                        <path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg>
                                </a>

                                <form method="POST" action="{{ route('dresses.destroy', $dress) }}" id="delete-dress-form-{{ $dress->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="button"
                                        class="dress-card-action dress-card-action-delete"
                                        aria-label="Delete {{ $dress->name }}"
                                        data-delete-confirm-trigger
                                        data-dress-name="{{ $dress->name }}"
                                        data-form-id="delete-dress-form-{{ $dress->id }}">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M3 6h18" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M8 6V4h8v2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M19 6l-1 14H6L5 6" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M10 11v6" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M14 11v6" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        {{-- <p>Category: {{ $dress->category->name ?? 'N/A' }}</p>
                        <p>Location: {{ $dress->location->name ?? 'N/A' }}</p>
                        <p>Brand: {{ $dress->brand ?: 'N/A' }}</p>
                        <p>Description: {{ $dress->description ?: 'N/A' }}</p> --}}
                    </div>
                </div>
            </div>
        @empty
            <div class="dresses-empty-state">
                {{-- TODO --}}
                {{-- <svg class="dresses-empty-arrow" viewBox="0 0 520 220" aria-hidden="true">
                    <!-- Very long smooth curve -->
                    <path d="M18 160C100 160 160 130 220 90C280 50 360 25 480 10" />
                
                    <!-- Arrow head at far end -->
                    <path d="M455 0L480 10L460 35" />
                </svg> --}}
                <p>No dresses found. Add your first dress!</p>
            </div>
        @endforelse
    </div>

    @if ($dresses->hasPages())
        <div class="dresses-pagination-wrap">
            {{ $dresses->onEachSide(1)->links('vendor.pagination.dresses') }}
        </div>
    @endif

    <dialog class="dress-delete-dialog" data-delete-confirm-dialog>
        <form method="dialog" class="dress-delete-dialog-card">
            <p class="dress-delete-dialog-title">Confirm delete</p>
            <p class="dress-delete-dialog-copy">
                Delete <span data-delete-dress-name>this dress</span>?
            </p>
            <div class="dress-delete-dialog-actions">
                <button type="button" class="pb-button pb-button-red" data-delete-cancel>Cancel</button>
                <button type="button" class="pb-button pb-button-top" data-delete-submit>Delete</button>
            </div>
        </form>
    </dialog>
</div>
@endsection

@section('hero-footer')
    @include('layouts.footer')
@endsection
