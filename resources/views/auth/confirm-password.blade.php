<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QFSWORLD | Confirm Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background: #f7f9fc;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        .glow {
            box-shadow: 0 4px 24px rgba(10, 61, 145, 0.10);
        }

        .input-glow {
            box-shadow: 0 2px 10px rgba(10, 61, 145, 0.05);
        }

        .crypto-grid {
            position: relative;
        }

        .crypto-grid::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                linear-gradient(rgba(10, 61, 145, 0.08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(10, 61, 145, 0.08) 1px, transparent 1px);
            background-size: 20px 20px;
            z-index: -1;
            pointer-events: none;
        }

        .gradient-bg {
            background: #ffffff;
        }

        .gradient-border {
            position: relative;
            border: 1px solid transparent;
            background-clip: padding-box;
        }

        .gradient-border::after {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #0a3d91, #f5a623, #0a3d91, #f5a623);
            z-index: -1;
            border-radius: inherit;
        }

        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background-color: rgba(10, 61, 145, 0.3);
            border-radius: 50%;
        }

        @keyframes float {
            0% {
                transform: translateY(0) translateX(0);
                opacity: 0;
            }

            50% {
                opacity: 0.5;
            }

            100% {
                transform: translateY(-100vh) translateX(20px);
                opacity: 0;
            }
        }
    </style>
</head>

<body class="min-h-screen text-[#1a1a2e] flex items-center justify-center p-4 crypto-grid">
    <div class="particles" id="particles"></div>

    <div class="absolute top-5 right-5 flex items-center space-x-2">
        <span class="text-sm text-[#4a5568]">Secure Connection</span>
        <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
    </div>

    <div class="w-full max-w-md mt-10">
        <!-- Logo & Header -->
        <div class="text-center mb-8">
            <div class="flex justify-center items-center mb-4">
                <div
                    class="w-12 h-12 rounded-full bg-gradient-to-r from-[#0a3d91] to-[#1258c4] flex items-center justify-center mr-3">
                    <i class="fas fa-coins text-white text-xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-[#0a3d91]">QFS<span class="font-light text-[#f5a623]">WORLD</span>
                </h1>
            </div>
            <p class="text-[#4a5568]">Advanced cryptocurrency portfolio management</p>
        </div>

        <div class="gradient-bg rounded-xl p-8 glow gradient-border">
            <h2 class="text-2xl font-bold mb-2">Confirm Password</h2>
            <p class="text-[#4a5568] mb-8">This is a secure area of the application. Please confirm your password before
                continuing.</p>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                @if ($errors->count() > 0)
                    <div id="ERROR_COPY" style="display:none;">
                        @foreach ($errors->all() as $error)
                            {{ $error }} <br />
                        @endforeach
                    </div>
                @endif

                <div class="mb-6">
                    <label class="block text-[#4a5568] text-sm font-medium mb-2" for="password">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="far fa-lock text-[#718096]"></i>
                        </div>
                        <input
                            class="w-full bg-[#ffffff] appearance-none border border-[#e2e8f0] rounded-lg py-3 px-10 text-[#1a1a2e] leading-tight focus:outline-none focus:border-[#0a3d91] input-glow"
                            id="password" type="password" name="password" autocomplete="current-password"
                            placeholder="Password" required />
                    </div>
                </div>

                <div class="mb-2 text-center mt-6">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-[#0a3d91] to-[#1258c4] hover:from-[#1258c4] hover:to-[#0a3d91] text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-300">
                        Confirm Password
                    </button>
                </div>
            </form>
        </div>

        <div class="text-center mt-8 text-[#4a5568] text-xs">
            <p>© 2023 QFSWORLD. All rights reserved. | <a href="#" class="hover:text-[#718096]">Privacy Policy</a>
            </p>
        </div>
    </div>

    <!-- Error Popup handling via SweetAlert -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 50;
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                const posX = Math.random() * 100;
                const posY = Math.random() * 100;
                particle.style.left = `${posX}vw`;
                particle.style.top = `${posY}vh`;
                const size = Math.random() * 3 + 1;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                const duration = Math.random() * 10 + 5;
                const delay = Math.random() * 5;
                particle.style.animation = `float ${duration}s linear ${delay}s infinite`;
                particlesContainer.appendChild(particle);
            }
        }
        document.querySelector('form').addEventListener('submit', function(e) {
            const btn = this.querySelector('button[type="submit"]');
            btn.innerHTML = '<i class="fas fa-circle-notch animate-spin"></i> Confirming...';
            btn.disabled = true;
        });
        createParticles();
        AOS.init();
        document.addEventListener('DOMContentLoaded', function() {
            const errorCopy = document.getElementById('ERROR_COPY');
            if (errorCopy) {
                const errorContent = errorCopy.innerHTML;
                if (errorContent.trim() !== '') {
                    swal("Error", errorContent, "error");
                }
            }
        });
    </script>
</body>

</html>
