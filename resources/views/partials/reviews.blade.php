<section class="review-section review-section-intro">
    <div class="review-container">
        <div class="review-section-heading-wrapper">
            <div class="review-section-heading center">
                <p class="eyebrow">Top Reviews</p>
                <h2 class="pb-sideheading">Trusted by Our Users</h2>
                <p class="hero-copy">See how users review PackBack after using it to track outfits, keep closets organized, and make getting dressed faster.</p>
            </div>
        </div>
  
        <div class="review-wrapper">
            @foreach(($featuredReviews ?? collect()) as $review)
                <article class="review">
                    <div class="review-topline">
                        <span class="review-tag">{{ $review->created_at?->diffForHumans() ?? 'Recently' }}</span>
                    </div>
                    <div class="review-photo">
                        <img src="/images/profile/profile1.jpg" alt="{{ $review->author_name }}" />
                    </div>
                    <div class="review-content">
                        <h3>{{ $review->author_name }}</h3>
                        <p>"{{ $review->body }}"</p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
