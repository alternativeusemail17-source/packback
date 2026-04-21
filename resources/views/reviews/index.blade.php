@extends('layouts.app')

@section('title', 'Reviews | PackBack')
@section('body-class', 'pb-reviews-page')

@section('nav-actions')
    <a href="{{ route('register') }}" class="pb-button pb-button-top">
        <span class="button-text">Get Started</span>
        <span class="pb-icon">
            <svg viewBox="0 0 20 20" aria-hidden="true">
                <path d="M4.5 10h10M10.5 5l4.5 5-4.5 5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"/>
            </svg>
        </span>
    </a>
@endsection

@section('hero')
<div class="pb-reviews-shell">
    <section class="pb-reviews-header">
        <div>
            <p class="eyebrow">Community feedback</p>
            <h1 class="pb-reviews-title">See how people use PackBack to manage what they wear.</h1>
            <p class="pb-reviews-intro">
                Reviews stay easy to scan, and each one can now carry direct follow-up replies inside the same flow.
            </p>
        </div>

        <form method="GET" action="{{ route('reviews.index') }}" class="pb-reviews-search">
            <label for="reviews-search" class="pb-reviews-search-label">Search reviews</label>
            <div class="pb-reviews-search-row">
                <input
                    id="reviews-search"
                    type="search"
                    name="search"
                    value="{{ $filters['search'] }}"
                    placeholder="Search feedback, topics, or categories"
                >
                <button type="submit" class="pb-button pb-button-top">Search</button>
            </div>
        </form>
    </section>

    <section class="pb-reviews-list" aria-label="User reviews">
        @forelse($reviews as $review)
            <article class="pb-review-card" id="review-{{ $review->id }}">
                <div class="pb-review-card-top">
                    <div class="pb-review-author">
                        <img src="/images/profile/profile1.jpg" alt="{{ $review->author_name }}">
                        <div>
                            <strong>{{ $review->author_name }}</strong>
                            <span>
                                {{ $review->author_role ?: 'PackBack user' }}
                                ·
                                {{ $review->created_at?->diffForHumans() ?? 'Recently' }}
                            </span>
                        </div>
                    </div>

                    <div class="pb-review-tags">
                        @if($review->category)
                            <span class="pb-review-pill">{{ $review->category }}</span>
                        @endif
                        @if($review->issue)
                            <span class="pb-review-pill">{{ $review->issue }}</span>
                        @endif
                        @if($review->sentiment)
                            <span class="pb-review-pill is-{{ \Illuminate\Support\Str::slug($review->sentiment) }}">{{ $review->sentiment }}</span>
                        @endif
                    </div>
                </div>

                <div class="pb-review-copy">
                    <h2>{{ $review->headline }}</h2>
                    <p>{{ $review->body }}</p>
                </div>

                <section class="pb-review-replies" aria-label="Replies">
                    <div class="pb-review-replies-head">
                        <h3>Replies</h3>
                        <span>{{ $review->replies->count() }}</span>
                    </div>

                    @forelse($review->replies as $reply)
                        <article class="pb-review-reply">
                            <div class="pb-review-reply-meta">
                                <strong>{{ $reply->user->name }}</strong>
                                <span>{{ $reply->created_at?->diffForHumans() ?? 'Recently' }}</span>
                            </div>
                            <p>{{ $reply->body }}</p>
                        </article>
                    @empty
                        <p class="pb-review-replies-empty">No replies yet.</p>
                    @endforelse

                    @auth
                        <form method="POST" action="{{ route('reviews.replies.store', $review) }}" class="pb-review-reply-form">
                            @csrf
                            <input type="hidden" name="search" value="{{ $filters['search'] }}">
                            <label for="reply-{{ $review->id }}">Reply to this review</label>
                            <textarea
                                id="reply-{{ $review->id }}"
                                name="body"
                                rows="3"
                                placeholder="Write a reply"
                            >{{ old('body') }}</textarea>
                            @error('body')
                                <p class="pb-review-form-error">{{ $message }}</p>
                            @enderror
                            <button type="submit" class="pb-button pb-button-top">Post reply</button>
                        </form>
                    @else
                        <p class="pb-review-login-note">
                            <a href="{{ route('login') }}">Sign in</a> to reply to this review.
                        </p>
                    @endauth
                </section>
            </article>
        @empty
            <div class="pb-reviews-empty">
                <h2>No reviews found.</h2>
                <p>Once reviews are added through the database, they will appear here.</p>
                <a href="{{ route('reviews.index') }}" class="pb-button pb-button-top">Clear search</a>
            </div>
        @endforelse
    </section>
</div>
@endsection

@section('hero-footer')
    @include('layouts.footer')
@endsection
