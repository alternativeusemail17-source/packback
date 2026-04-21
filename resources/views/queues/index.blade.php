@extends('layouts.app')

@section('title', 'Queues')

@section('nav-actions')
<a href="{{ route('dresses.index') }}" class="pb-button pb-button-top" style="text-decoration: none;">
    <span class="button-text">View Dresses</span>
</a>
@endsection

@section('hero')
<div class="queue-page">
    <section class="queue-panel queue-panel-form">
        <div class="queue-panel-header">
            <p class="queue-kicker">Travel planning</p>
            <h2>Create a new dress queue.</h2>
            <p>Set the route first, then keep adding dresses you plan to carry.</p>
        </div>

        <form method="POST" action="{{ route('queues.store') }}" class="queue-form">
            @csrf

            <label class="queue-field">
                <span>Queue name</span>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    maxlength="100"
                    placeholder="Weekend trip"
                >
            </label>

            <div class="queue-field-grid">
                <label class="queue-field">
                    <span>From</span>
                    <select name="from_location_id" required>
                        <option value="">Choose source</option>
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}" @selected((string) old('from_location_id') === (string) $location->id)>
                                {{ $location->name }}
                            </option>
                        @endforeach
                    </select>
                </label>

                <label class="queue-field">
                    <span>To</span>
                    <select name="to_location_id" required>
                        <option value="">Choose destination</option>
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}" @selected((string) old('to_location_id') === (string) $location->id)>
                                {{ $location->name }}
                            </option>
                        @endforeach
                    </select>
                </label>
            </div>

            @if ($errors->any())
                <div class="queue-form-errors">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="queue-form-actions">
                <button type="submit" class="pb-button pb-button-top">Create Queue</button>
            </div>
        </form>
    </section>

    <section class="queue-panel">
        <div class="queue-panel-header">
            <p class="queue-kicker">Your queues</p>
            <h2>Move plans at a glance.</h2>
            <p>Open any queue to review or update the dresses packed for that route.</p>
        </div>

        <div class="queue-list">
            @forelse ($queues as $queue)
            <div class="queue-card">
                <div class="queue-card-top">
                    <a href="{{ route('queues.show', $queue) }}" style="text-decoration:none; color:inherit; flex:1;">
                        <div>
                            <strong>{{ $queue->name ?: 'Untitled queue' }}</strong>
                            <span>{{ $queue->fromLocation->name }} → {{ $queue->toLocation->name }}</span>
                        </div>
                    </a>
            
                    <div style="display:flex; align-items:center; gap:8px;">
                        <span class="queue-count">{{ $queue->dresses_count }} dresses</span>
            
                        <form method="POST" action="{{ route('queues.destroy', $queue) }}" onsubmit="return confirm('Delete this queue?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="queue-delete-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 6h18"></path>
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            
                <p class="queue-card-meta">
                    Created {{ optional($queue->created_at)->diffForHumans() ?? 'recently' }}
                </p>
            </div>
            @empty
                <div class="queue-empty-state">
                    <p>No queues yet. Create your first route to start tracking dresses for travel.</p>
                </div>
            @endforelse
        </div>
    </section>
</div>
@endsection

@section('hero-footer')
    @include('layouts.footer')
@endsection
