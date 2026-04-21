<footer class="hero-footer" aria-label="Footer">
    <div class="footer-content">
        <div class="footer-brand-block">
            <a href="{{ route('welcome') }}" class="footer-logo" aria-label="PackBack home">
                <span class="footer-logo-text">PackBack</span>
            </a>

            <p class="footer-tagline">
                Pack smarter with your digital wardrobe. Plan outfits, track what you own, and get trip-ready from anywhere.
            </p>

            <div class="footer-socials" aria-label="Social links">
                <a href="#" class="footer-social-link" aria-label="Instagram">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" xmlns="http://www.w3.org/2000/svg">
                        <rect x="4" y="4" width="16" height="16" rx="5"></rect>
                        <circle cx="12" cy="12" r="3.5"></circle>
                        <circle cx="17.5" cy="6.5" r="0.8" fill="currentColor" stroke="none"></circle>
                    </svg>
                </a>
                <a href="#" class="footer-social-link" aria-label="Facebook">
                    <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.5 21V13.2H16.1L16.5 10.2H13.5V8.28C13.5 7.41 13.75 6.81 15 6.81H16.6V4.11C16.32 4.07 15.37 4 14.26 4C11.95 4 10.37 5.41 10.37 8V10.2H8V13.2H10.37V21H13.5Z"/>
                    </svg>
                </a>
                <a href="#" class="footer-social-link" aria-label="LinkedIn">
                    <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.77 8.56A1.79 1.79 0 1 0 6.77 5a1.79 1.79 0 0 0 0 3.56ZM5.23 19h3.08V10.2H5.23V19ZM10.3 10.2V19h3.08v-4.9c0-1.29.24-2.54 1.84-2.54 1.58 0 1.6 1.48 1.6 2.62V19h3.08v-5.43c0-2.67-.58-4.72-3.7-4.72-1.5 0-2.5.82-2.9 1.6h-.04v-1.25H10.3Z"/>
                    </svg>
                </a>
                <a href="#" class="footer-social-link" aria-label="TikTok">
                    <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.73 4C15.02 5.7 16.03 7.1 17.52 7.94C18.33 8.39 19.25 8.66 20.22 8.7V11.2C18.57 11.15 17 10.64 15.7 9.76V15.13C15.7 18.01 13.38 20.35 10.48 20.35C7.58 20.35 5.26 18.01 5.26 15.13C5.26 12.25 7.58 9.91 10.48 9.91C10.77 9.91 11.05 9.94 11.32 10.01V12.6C11.06 12.5 10.78 12.45 10.48 12.45C8.99 12.45 7.79 13.65 7.79 15.13C7.79 16.61 8.99 17.82 10.48 17.82C11.97 17.82 13.17 16.61 13.17 15.13V4H14.73Z"/>
                    </svg>
                </a>
            </div>
        </div>

        <div class="footer-links-grid">
            <div class="footer-column">
                <h2 class="footer-column-title">Support</h2>
                <a href="#" class="footer-link">Help Center</a>
                <a href="{{ route('welcome') }}" class="footer-link">How It Works</a>
                <a href="{{ route('privacy-policy') }}" class="footer-link">Privacy Policy</a>
                <a href="#" class="footer-link">Terms of Service</a>
            </div>

            <div class="footer-column">
                <h2 class="footer-column-title">Product</h2>
                <a href="{{ route('welcome') }}#pricing" class="footer-link">Pricing</a>
                <a href="{{ route('dresses.index') }}" class="footer-link">Wardrobe</a>
                <a href="{{ route('profile.show') }}" class="footer-link">Profile</a>
                <a href="#" class="footer-link">Request a Demo</a>
            </div>

            <div class="footer-column">
                <h2 class="footer-column-title">About Us</h2>
                <a href="{{ route('welcome') }}" class="footer-link">About</a>
                <a href="#" class="footer-link">Community</a>
                <a href="#" class="footer-link">Careers</a>
                <a href="#" class="footer-link">Partners</a>
            </div>
        </div>
    </div>

    <div class="footer-meta">
        <p class="footer-copy">© {{ date('Y') }} PackBack. All rights reserved.</p>
        <div class="footer-meta-links">
            <a href="{{ route('privacy-policy') }}" class="footer-meta-link">Privacy Policy</a>
            <a href="#" class="footer-meta-link">Cookies Settings</a>
            <a href="#" class="footer-meta-link">Compliances</a>
        </div>
    </div>

    <div class="footer-watermark" aria-hidden="true">PACKBACK</div>
</footer>
