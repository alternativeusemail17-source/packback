@extends('layouts.app')

@section('title', 'Privacy Policy | PackBack')

@section('nav-actions')
    @if(Auth::guest())
        <a href="{{ route('register') }}" class="pb-button pb-button-top">
            <span class="button-text">Register</span>
            <div class="pb-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </a>
    @endif
@endsection

@section('hero')
<div class="pb-layout pb-policy-wrapper">
    
    <div class="pb-policy-container">
        
        {{-- Main Hero Header --}}
        <header class="pb-policy-header">
            <p class="eyebrow">LEGAL & PRIVACY</p>
            <h1 class="pb-policy-title">Privacy Policy</h1>
            <p class="pb-policy-meta">Last Updated {{ date('M jS, Y') }}</p>
        </header>

        {{-- Two-Column Policy Grid --}}
        <div class="pb-policy-grid">
            
            {{-- Left Column: Main Content --}}
            <main class="pb-policy-main">
                <p class="pb-policy-intro">
                    This Privacy Policy will help you better understand how we collect, use, and share your personal information.
                </p>

                <h3 class="pb-policy-section-title">Overview</h3>
                
                <p class="pb-legal-content">
                    This privacy policy sets out how <strong>PackBack</strong> collects, uses, and discloses any personal information that you give us. We are committed to ensuring that your privacy is protected and that we remain transparent about our data practices.
                </p>

                <p class="pb-legal-content">
                    By using our website or Services, you consent to this Privacy Policy and the processing of your personal information it describes.
                </p>

                {{-- 1. What Personal Information we collect --}}
                <div id="collect" class="policy-anchor-offset">
                    <h3 class="pb-policy-section-title">1. What Personal Information we collect</h3>
                    <div class="pb-policy-card">
                        <p class="pb-legal-content">
                            To register for our Services, you provide your <strong>email address, name, and wardrobe details</strong>. If you use our advanced tracking features, we also collect:
                        </p>
                        <ul class="pb-legal-content">
                            <li>Images of clothing items and accessories uploaded to your digital closet.</li>
                            <li>Storage locations and organization preferences.</li>
                            <li>Usage history, including items worn and frequency of use.</li>
                            <li>Technical data such as IP addresses and browser types.</li>
                        </ul>
                    </div>
                </div>

                {{-- 2. What we do with the info we collect --}}
                <div id="usage" class="policy-anchor-offset">
                    <h3 class="pb-policy-section-title">2. What we do with the info we collect</h3>
                    <p class="pb-legal-content">
                        We use the information gathered to provide a personalized wardrobe management experience. Specific uses include:
                    </p>
                    <p class="pb-legal-content">
                        • Improving our application interface and user experience based on feedback.<br>
                        • Sending periodic emails regarding your account or new feature updates.<br>
                        • Providing statistical insights into your wardrobe value and wear-count.<br>
                        • Internal record keeping and security audits.
                    </p>
                </div>

                {{-- 3. When we Disclose Information --}}
                <div id="disclose" class="policy-anchor-offset">
                    <h3 class="pb-policy-section-title">3. When we Disclose Information</h3>
                    <p class="pb-legal-content">
                        PackBack does <strong>not</strong> sell, distribute, or lease your personal information to third parties unless we have your explicit permission or are required by law to do so. 
                    </p>
                    <p class="pb-legal-content">
                        We may share anonymized, aggregated data with partners for the purpose of analyzing fashion trends, but this data will never identify you personally.
                    </p>
                </div>

                {{-- 4. Security --}}
                <div id="security" class="policy-anchor-offset">
                    <h3 class="pb-policy-section-title">4. Security</h3>
                        <p class="pb-legal-content">
                            We are committed to ensuring that your information is secure. In order to prevent unauthorized access or disclosure, we have put in place suitable physical, electronic, and managerial procedures to safeguard and secure the information we collect online. This includes SSL encryption for all data transfers.
                        </p>
                </div>

                {{-- 5. Contact Us --}}
                <div id="contact" class="policy-anchor-offset">
                    <h3 class="pb-policy-section-title">5. Contact Us</h3>
                    <p class="pb-legal-content">
                        If you have any questions about this Privacy Policy, or if you would like to request access to or deletion of your data, please contact our privacy team at:
                    </p>
                    <p class="pb-legal-content" style="font-weight: 600;">
                        support@packback.app
                    </p>
                </div>
            </main>

            {{-- Right Column: Table of Contents --}}
            <aside class="pb-policy-sidebar">
                <h4 class="pb-toc-heading">Table of contents</h4>
                <ol class="pb-toc-list">
                    <li><a href="#collect" class="pb-toc-link">1. What Personal Information we collect</a></li>
                    <li><a href="#usage" class="pb-toc-link">2. What we do with the info we collect</a></li>
                    <li><a href="#disclose" class="pb-toc-link">3. When we Disclose Information</a></li>
                    <li><a href="#security" class="pb-toc-link">4. Security</a></li>
                    <li><a href="#contact" class="pb-toc-link">5. Contact Us</a></li>
                </ol>

                <div class="pb-back-to-top-wrapper">
                    <a href="#" class="pb-back-to-top">
                        Back to top <span>↑</span>
                    </a>
                </div>
            </aside>

        </div>
    </div>
</div>
@endsection

@section('hero-footer')
    @include('layouts.footer')
@endsection
