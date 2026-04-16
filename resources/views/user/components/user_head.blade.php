<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QFSWORLD | {{ $title ?? 'Dashboard' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Check local storage or system preference
        if (localStorage.getItem('darkMode') === 'enabled' || (!localStorage.getItem('darkMode') && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

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
            background: #0a3d91;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        .glow {
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
        }

        .crypto-grid {
            position: relative;
        }



        .gradient-bg {
            background: linear-gradient(135deg, #0a0a0a 0%, #000000 100%);
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
            background: linear-gradient(45deg, #333, #000, #333, #000);
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
            background-color: rgba(255, 255, 255, 0.5);
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

        .action-card {
            @apply flex flex-col items-center justify-center w-16 h-16 bg-gray-900 rounded-xl shadow-lg cursor-pointer hover:bg-blue-700 transition-all duration-300;
        }

        .crypto-card {
            @apply flex justify-between items-center p-4 bg-gray-900 rounded-xl shadow-lg mb-3 border border-gray-800;
        }

        .price-up {
            color: #10b981;
        }

        .price-down {
            color: #ef4444;
        }

        .online-indicator {
            width: 12px;
            height: 12px;
            background-color: #10b981;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }

        /* Bottom navbar replacement styles */
        .container {
            position: fixed;
            top: calc(var(--vh, 1vh) * 100);
            width: 100%;
            height: calc(var(--vh, 1vh) * 50);
            background: #fff;
            border-radius: 30px 30px 0px 0px;
            padding-top: 40px;
            box-sizing: border-box;
            box-shadow: 0px 0px 30px 0px rgba(0, 0, 0, .05);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .container::after {
            content: '';
            left: 50%;
            top: -14px;
            width: 45px;
            height: 4px;
            background: rgba(0, 0, 0, .2);
            position: absolute;
            transform: translate(-50%);
            border-radius: 20px;
        }

        .container p {
            width: 70%;
            padding-top: 20px;
            font-size: .8rem;
            text-align: center;
            font-weight: 500;
            opacity: .7;
        }

        .container img {
            width: 75%;
        }

        .container button {
            padding: 12px 30px;
            background: rgb(232, 76, 79);
            color: #fff;
            border: 0px;
            margin-top: 20px;
            border-radius: 17px;
        }

        .container::before {
            content: '';
            left: 0px;
            bottom: -150px;
            width: 100%;
            height: 150px;
            background: #fff;
            position: absolute;
        }

        .bottom-navbar {
            position: fixed;
            bottom: 0px;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            width: 100%;
            background: linear-gradient(135deg, #0a3d91 0%, #1e40af 100%);
            border-radius: 30px 30px 0px 0px;
            padding: 10px 0px;
            box-shadow: 0px -4px 20px rgba(255, 255, 255, 0.15), 0px -1px 0px rgba(255, 255, 255, 0.2) inset;
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            z-index: 30;
        }

        .bottom-navbar button {
            width: 60px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            border: 0px;
            background: transparent;
            border-radius: 20px;
            transition: all .25s ease;
            color: rgba(255, 255, 255, 0.6);
        }

        .bottom-navbar button:active:not(.float) {
            transform: scale(1.2);
        }

        .bottom-navbar button.float {
            margin-top: -50px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: #ffffff;
            border-radius: 25px;
            height: 60px;
            box-shadow: 0px 10px 20px 0px rgba(37, 99, 235, 0.4);
        }

        .bottom-navbar button.active {
            color: #ffffff;
        }

        .bottom-navbar button i {
            font-size: 1.5rem;
            pointer-events: none;
        }

        .bottom-navbar button span {
            font-size: .65rem;
            font-weight: bold;
            margin-top: 4px;
            white-space: nowrap;
        }

        .con-effect {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0px;
            left: 0px;
            overflow: hidden;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .effect {
            background: rgba(255, 255, 255, 0.15);
            width: 60px;
            height: 50px;
            position: absolute;
            left: 13px;
            border-radius: 18px;
        }

        /* Sidebar styles */
        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transition: opacity .25s ease, visibility .25s ease;
            z-index: 40;
        }

        .sidebar-overlay.open {
            opacity: 1;
            visibility: visible;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 290px;
            background: linear-gradient(165deg, #0f172a 0%, #1e293b 100%);
            color: #ffffff;
            transform: translateX(-100%);
            transition: transform .3s ease;
            z-index: 50;
            box-shadow: 2px 0 20px rgba(0, 0, 0, .5);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .sidebar.open {
            transform: translateX(0);
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: linear-gradient(45deg, #3b82f6, #6366f1);
            opacity: 0.1;
            z-index: 0;
        }

        .sidebar::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            background: linear-gradient(45deg, #8b5cf6, #ec4899);
            opacity: 0.1;
            z-index: 0;
        }

        .sidebar header {
            padding: 20px 16px 12px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            z-index: 1;
        }

        .sidebar .section {
            padding: 2px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            position: relative;
            z-index: 1;
        }

        .sidebar .section h4,
        .section-title {
            font-size: .7rem;
            color: #9ca3af;
            margin-bottom: 7px;
            text-transform: uppercase;
            letter-spacing: .04em;
            padding-left: .4rem;
            border-left: 3px solid #6366f1;
        }

        .sidebar .menu-item {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: .65rem 1rem;
            color: #d1d5db;
            border-radius: 8px;
            margin-bottom: .2rem;
            background: rgba(30, 41, 59, 0.3);
            transition: all .3s ease;
        }

        .sidebar .menu-item:hover {
            background: linear-gradient(90deg, rgba(79, 70, 229, 0.2), rgba(99, 102, 241, 0.1));
            color: #ffffff;
            transform: translateX(5px);
        }

        .sidebar .menu-item i {
            width: 20px;
            text-align: center;
            color: #6366f1;
        }

        .sidebar .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(99, 102, 241, 0.5);
        }

        .welcome-text {
            font-size: .85rem;
            color: #9ca3af;
            margin-bottom: .25rem;
        }

        .username {
            font-size: 1.25rem;
            font-weight: 700;
            background: linear-gradient(90deg, #e2e8f0, #cbd5e1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .status-section {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: .5rem;
            background: linear-gradient(90deg, rgba(30, 41, 59, 0.7), rgba(30, 41, 59, 0.4));
            border-radius: 12px;
            margin: 16px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .status-label {
            font-weight: 600;
            font-size: .9rem;
            color: #d1d5db;
        }

        .status-value {
            font-size: .85rem;
            color: #ef4444;
            display: flex;
            align-items: center;
            gap: .25rem;
        }

        .status-value.verified {
            color: #10b981;
        }

        .theme-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
        }

        .toggle-switch {
            width: 40px;
            height: 20px;
            background: #4b5563;
            border-radius: 20px;
            position: relative;
            transition: all .3s ease;
        }

        .toggle-switch::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            background: #fff;
            border-radius: 50%;
            top: 2px;
            left: 2px;
            transition: all .3s ease;
        }

        .dark-mode-active .toggle-switch {
            background: #6366f1;
        }

        .dark-mode-active .toggle-switch::after {
            left: 22px;
        }

        .logout-btn {
            color: #ef4444 !important;
        }

        .logout-btn i {
            color: #ef4444 !important;
        }

        .badge {
            font-size: .7rem;
            padding: .2rem .5rem;
            border-radius: 20px;
            background: rgba(79, 70, 229, 0.2);
            color: #818cf8;
            margin-left: auto;
        }

        /* Top actions styled like bottom navbar */
        .top-actions {
            margin: 16px;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            width: calc(100% - 32px);
            background: #fff;
            border-radius: 30px;
            padding: 10px 0px;
            box-shadow: 0px 0px 30px 0px rgba(0, 0, 0, .05);
        }

        .top-actions button {
            width: 60px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            border: 0px;
            background: transparent;
            border-radius: 20px;
            transition: all .25s ease;
            color: #000;
        }

        .top-actions button:active {
            transform: scale(1.2);
        }

        .top-actions button.active {
            color: rgb(0, 0, 0);
        }

        .top-actions button i {
            font-size: 1.5rem;
            pointer-events: none;
        }

        .top-actions button span {
            font-size: .65rem;
            margin-top: 4px;
            white-space: nowrap;
        }
    </style>
</head>

<body class="min-h-screen text-white crypto-grid pb-20">
    @include('sweetalert::alert')
    <!-- Animated particles -->
    <div class="particles" id="particles"></div>
