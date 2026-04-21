<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password OTP</title>

    <style>
        /* Base body styles */
        body {
            font-family: 'Outfit', ui-sans-serif, system-ui, sans-serif;
            background: #f9fafb;
            color: #163129;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
        }

        /* Container for the main content */
        .container {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            max-width: 480px;
            width: 100%;
            text-align: center;
        }

        /* Headings */
        h1 {
            font-size: 2rem;
            font-weight: 500;
            margin-bottom: 12px;
        }

        h2 {
            font-size: 1.25rem;
            font-weight: 500;
            margin-bottom: 20px;
        }

        /* Paragraphs */
        p {
            font-size: 1rem;
            color: rgba(24, 49, 31, 0.72);
            margin-bottom: 20px;
        }

        /* OTP display styling */
        .otp {
            display: inline-block;
            font-family: monospace;
            font-size: 1.5rem;
            font-weight: 600;
            letter-spacing: 4px;
            padding: 12px 20px;
            background: #d1fae5; /* green-ish background */
            color: #065f46; /* dark green */
            border-radius: 8px;
            margin-bottom: 20px;
        }

        /* OTP expiry text */
        .expiry {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 32px;
        }

        /* Footer styling */
        .footer {
            text-align: center;
            font-size: 0.875rem;
            color: rgba(24, 49, 31, 0.72);
            margin-top: 40px;
        }

        /* Footer links */
        .footer a {
            color: #48bb78;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Main content container -->
    <div class="container">
        <h1>PackBack</h1>
        <h2>Reset Your Password</h2>
        <p>You requested a password reset. Use the following OTP to proceed:</p>

        <!-- OTP code -->
        <span class="otp">{{ $otp }}</span>

        <!-- OTP expiry info -->
        <p class="expiry">This OTP expires in 5 minutes.</p>
    </div>

    <!-- Footer section -->
    <div class="footer">
        <p>If you did not request a password reset, you can safely ignore this email.</p>
        <p>Need help? <a href="mailto:support@packback.com">Contact Support</a></p>
    </div>

</body>
</html>