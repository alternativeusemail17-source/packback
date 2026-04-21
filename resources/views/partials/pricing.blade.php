<section class="pricing-section" id="pricing">
    <div class="pricing-section-heading">
        <p class="eyebrow">Pricing</p>
        <h2 class="pb-sideheading">Pricing Plans</h2>
        <p class="hero-copy">Simple plans for keeping your wardrobe organized, searchable,and ready for daily styling.</p>
    </div>

    <div class="pricing-grid">
        <article class="pricing-card">
            <div class="pricing-card-header">
                <h3>Starter</h3>
                <p>Everything you need to begin tracking your wardrobe.</p>
            </div>

            <div class="pricing-price-row">
                <strong>Free</strong>
                <span>/ Forever</span>
            </div>

            <ul class="pricing-feature-list">
                <li>Personal dress dashboard</li>
                <li>Upload photos for each item</li>
                <li>Track category and closet location</li>
                <li>Basic wardrobe organization tools</li>
                <li>Access from any device</li>
            </ul>

            <button type="button" class="pricing-button pricing-button-muted" onclick="window.location.href='{{ route('register') }}'">
                Get Started
            </button>
        </article>

        <article class="pricing-card pricing-card-featured">
            <span class="pricing-badge">Most Popular</span>

            <div class="pricing-card-header">
                <h3>Basic</h3>
                <p>For users who want stronger planning and outfit visibility.</p>
            </div>

            <div class="pricing-price-row">
                <strong>$11</strong>
                <span>/ Monthly</span>
            </div>

            <ul class="pricing-feature-list">
                <li>Everything in Starter</li>
                <li>Unlimited dress entries</li>
                <li>Smart filters and search</li>
                <li>Recently worn tracking</li>
                <li>Priority product updates</li>
            </ul>

            <button type="button" class="pricing-button" onclick="window.location.href='{{ route('register') }}'">
                Get Started
            </button>
        </article>

        <article class="pricing-card">
            <div class="pricing-card-header">
                <h3>Institutional</h3>
                <p>Tailored support for stylists, teams, and shared wardrobe workflows.</p>
            </div>

            <div class="pricing-price-row pricing-price-row-custom">
                <strong>Custom price</strong>
            </div>

            <ul class="pricing-feature-list">
                <li>Multi-user access</li>
                <li>Shared wardrobe libraries</li>
                <li>Custom onboarding support</li>
                <li>Priority assistance and setup</li>
                <li>Flexible collaboration workflows</li>
            </ul>

            <button type="button" class="pricing-button pricing-button-muted" onclick="window.location.href='{{ route('register') }}'">
                Request a Demo
            </button>
        </article>
    </div>
</section>