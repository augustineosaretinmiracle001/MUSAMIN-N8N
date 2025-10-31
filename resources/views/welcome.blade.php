<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Musamin - AI Script Generator</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body class="bg-gray-50 font-sans antialiased">
    <!-- Header -->
    <header>
        <div class="header-container">
            <div class="logo">Musamin</div>
            <nav>
                <a href="#features">Features</a>
                <a href="#how-it-works">How it Works</a>
                <a href="{{ route('login') }}" class="btn-primary">Login</a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="hero-container">
            <h2>AI-Powered Script Generator</h2>
            <p>Generate custom scripts instantly with the power of artificial intelligence</p>
            <div class="hero-buttons">
                <a href="{{ route('register') }}" class="btn-white">Get Started Free</a>
                <a href="#how-it-works" class="btn-outline">Learn More</a>
            </div>
        </div>
    </section>

    <section id="features" class="features">
        <div class="features-container">
            <h3>Powerful Features</h3>
            <p class="features-subtitle">Everything you need to generate and manage scripts</p>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon blue">⚡</div>
                    <h4>Instant Generation</h4>
                    <p>Generate scripts in seconds with AI-powered automation</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon green">✓</div>
                    <h4>Custom Preferences</h4>
                    <p>Personalize scripts based on your specific requirements</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon purple">📁</div>
                    <h4>Easy Management</h4>
                    <p>Organize and manage all your generated scripts in one place</p>
                </div>
            </div>
        </div>
    </section>

    <section id="how-it-works" class="how-it-works">
        <div class="how-it-works-container">
            <h3>How It Works</h3>
            <p class="how-it-works-subtitle">Simple steps to get your scripts generated</p>
            
            <div class="steps-grid">
                <div class="step">
                    <div class="step-number">1</div>
                    <h4>Set Your Preferences</h4>
                    <p>Configure your script requirements and preferences in your dashboard</p>
                </div>

                <div class="step">
                    <div class="step-number">2</div>
                    <h4>Generate Scripts</h4>
                    <p>Click generate and let our AI create custom scripts based on your needs</p>
                </div>

                <div class="step">
                    <div class="step-number">3</div>
                    <h4>Download & Use</h4>
                    <p>Download your generated scripts and use them in your projects</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-container">
            <h4>Musamin</h4>
            <p class="footer-subtitle">AI-Powered Script Generator</p>
            <div class="footer-links">
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            </div>
        </div>
    </footer>
</body>
</html>