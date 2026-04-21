@extends('layouts.app')

@section('title', $queue->name ?: 'Queue')

@section('nav-actions')
<a href="{{ route('queues.index') }}" class="pb-button pb-button-top" style="text-decoration: none;">
    <span class="button-text">All Queues</span>
</a>
@endsection

@section('hero')
<div class="queue-page">
    <section class="queue-panel queue-panel-detail">
        <div class="queue-panel-header">
            <p class="queue-kicker">Queue details</p>
            <h2>{{ $queue->name ?: 'Untitled queue' }}</h2>
            <p>{{ $queue->fromLocation->name }} → {{ $queue->toLocation->name }}</p>
        </div>

        <form method="POST" action="{{ route('queues.dresses.store', $queue) }}" class="queue-form queue-add-form">
            @csrf
        
            <div class="queue-dress-grid queue-select-grid">
                @foreach ($availableDresses as $dress)
                <label 
                    class="queue-dress-card queue-dress-card-compact queue-select-card"
                    draggable="true"
                    data-dress-id="{{ $dress->id }}"
                >
    
                    <input 
                        type="checkbox" 
                        name="dress_ids[]" 
                        value="{{ $dress->id }}"
                        class="queue-select-checkbox"
                    >
                
                    <!-- 👇 SAME STRUCTURE as right side -->
                    <div class="queue-dress-media">
                        @if ($dress->image_url)
                            <img src="{{ $dress->image_url }}" alt="{{ $dress->name }}">
                        @else
                            <div class="queue-dress-placeholder">No image</div>
                        @endif
                    </div>
                
                    <div class="queue-dress-footer">
                        <span class="queue-dress-title">{{ $dress->name }}</span>
                    </div>
                
                </label>
                @endforeach
            </div>
        
            <div class="queue-form-actions">
                <button type="submit" class="pb-button pb-button-top" @disabled($availableDresses->isEmpty())>
                    Add Selected Dresses
                </button>
            </div>
        </form>

        @if ($availableDresses->isEmpty())
            <p class="queue-helper-copy">All of your dresses are already assigned to this queue, or you have not added dresses yet.</p>
        @endif
    </section>

    <section class="queue-panel">
        <div class="queue-panel-header">
            <p class="queue-kicker">Queued dresses</p>
            <h2>{{ $queue->dresses->count() }} dresses in this route.</h2>
            <p>Remove dresses here if your travel plan changes.</p>
        </div>

        <div 
            class="queue-dress-list queue-dress-grid"
            id="queue-drop-zone"
            data-queue-id="{{ $queue->id }}"
        >
            @forelse ($queue->dresses as $dress)
            <article class="queue-dress-card queue-dress-card-compact">
                <div class="queue-dress-media">
                    @if ($dress->image_url)
                        <img src="{{ $dress->image_url }}" alt="{{ $dress->name }}">
                    @else
                        <div class="queue-dress-placeholder">No image</div>
                    @endif
                </div>
            
                <div class="queue-dress-footer">
                    <span class="queue-dress-title">{{ $dress->name }}</span>
            
                    <form method="POST" action="{{ route('queues.dresses.destroy', [$queue, $dress]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="queue-delete-btn" title="Remove">
                            ✕
                        </button>
                    </form>
                </div>
            </article>
            @empty
                <div class="queue-empty-state">
                    <p>No dresses in this queue yet. Add one from the form above.</p>
                </div>
            @endforelse
        </div>
    </section>
</div>
@endsection

@section('hero-footer')
    @include('layouts.footer')
@endsection
