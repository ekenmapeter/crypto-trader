<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="referrer" content="strict-origin-when-cross-origin">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QFSWORLD — Best Digital Asset Secure System</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
    <style>
        /* ── RESET & BASE ── */
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: #1a1a2e;
            background: #fff;
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: 'Poppins', sans-serif;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        img {
            max-width: 100%;
            display: block;
        }

        ul {
            list-style: none;
        }

        /* ── CSS VARIABLES ── */
        :root {
            --blue: #0a3d91;
            --blue2: #1258c4;
            --blue3: #062a6b;
            --gold: #f5a623;
            --green: #27ae60;
            --red: #e63946;
            --text: #1a1a2e;
            --text2: #4a5568;
            --text3: #718096;
            --bg: #ffffff;
            --bg2: #f7f9fc;
            --bg3: #eef2f9;
            --bd: #e2e8f0;
            --sh: 0 4px 24px rgba(10, 61, 145, .10);
            --sh2: 0 12px 48px rgba(10, 61, 145, .16);
            --r: 16px;
        }

        /* ── BUTTONS ── */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
            padding: 11px 24px;
            border-radius: 9px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: .875rem;
            cursor: pointer;
            transition: all .22s;
            border: none;
            line-height: 1;
        }

        .btn-blue {
            background: var(--blue);
            color: #fff;
        }

        .btn-blue:hover {
            background: var(--blue2);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(10, 61, 145, .3);
        }

        .btn-gold {
            background: var(--gold);
            color: #fff;
        }

        .btn-gold:hover {
            background: #e09418;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(245, 166, 35, .4);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--blue);
            color: var(--blue);
        }

        .btn-outline:hover {
            background: var(--blue);
            color: #fff;
        }

        .btn-ghost {
            background: rgba(255, 255, 255, .14);
            color: #fff;
            border: 1.5px solid rgba(255, 255, 255, .38);
        }

        .btn-ghost:hover {
            background: rgba(255, 255, 255, .26);
        }

        .btn-lg {
            padding: 14px 34px;
            font-size: 1rem;
            border-radius: 11px;
        }

        .btn-w {
            width: 100%;
            justify-content: center;
        }

        /* ── SECTION COMMON ── */
        .sec {
            padding: 88px 6%;
        }

        .sec-label {
            display: block;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: var(--blue);
            margin-bottom: .55rem;
        }

        .sec-h {
            font-family: 'Poppins', sans-serif;
            font-size: clamp(1.85rem, 3.2vw, 2.7rem);
            font-weight: 800;
            color: var(--text);
            line-height: 1.18;
            letter-spacing: -.02em;
            margin-bottom: .85rem;
        }

        .sec-h span {
            color: var(--blue);
        }

        .sec-p {
            color: var(--text2);
            line-height: 1.8;
            font-size: .96rem;
        }

        .bar {
            width: 52px;
            height: 4px;
            background: linear-gradient(90deg, var(--blue), var(--gold));
            border-radius: 2px;
            margin: 1rem 0 2rem;
        }

        .tc {
            text-align: center;
        }

        .tc .bar {
            margin: 1rem auto 2rem;
        }

        .tc .sec-p {
            max-width: 580px;
            margin: 0 auto;
        }

        .grid2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
        }

        .grid3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        /* ── NAVBAR ── */
        .nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 999;
            background: rgba(255, 255, 255, .97);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--bd);
            padding: 0 6%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 72px;
            box-shadow: 0 2px 14px rgba(10, 61, 145, .07);
        }

        .nav-logo {
            font-family: 'Poppins', sans-serif;
            font-weight: 900;
            font-size: 1.5rem;
            color: var(--blue);
            letter-spacing: -.02em;
        }

        .nav-logo span {
            color: var(--gold);
        }

        .nav-links {
            display: flex;
            gap: 1.75rem;
        }

        .nav-links a {
            color: var(--text2);
            font-size: .875rem;
            font-weight: 500;
            transition: color .2s;
        }

        .nav-links a:hover {
            color: var(--blue);
        }

        .nav-cta {
            display: flex;
            gap: .75rem;
        }

        /* ── HERO SLIDER ── */
        .hero {
            position: relative;
            height: 100vh;
            min-height: 620px;
            overflow: hidden;
            margin-top: 72px;
        }

        .slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity .9s ease;
            pointer-events: none;
        }

        .slide.on {
            opacity: 1;
            pointer-events: auto;
        }

        .slide-bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
        }

        .s1 .slide-bg {
            background-image: linear-gradient(135deg, rgba(6, 42, 107, .91) 0%, rgba(18, 88, 196, .70) 55%, rgba(10, 61, 145, .48) 100%), url('https://images.unsplash.com/photo-1639762681485-074b7f938ba0?w=1600&q=80');
        }

        .s2 .slide-bg {
            background-image: linear-gradient(135deg, rgba(6, 42, 107, .88) 0%, rgba(39, 130, 100, .62) 55%, rgba(10, 61, 145, .48) 100%), url('https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=1600&q=80');
        }

        .slide-body {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            align-items: center;
            padding: 0 8%;
        }

        .slide-inner {
            max-width: 680px;
        }

        .s-badge {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: rgba(255, 255, 255, .13);
            border: 1px solid rgba(255, 255, 255, .28);
            border-radius: 100px;
            padding: 6px 16px;
            font-size: .78rem;
            color: rgba(255, 255, 255, .92);
            margin-bottom: 1.25rem;
            backdrop-filter: blur(8px);
        }

        .slide-inner h1 {
            font-family: 'Poppins', sans-serif;
            font-size: clamp(2.6rem, 5.5vw, 4.4rem);
            font-weight: 900;
            color: #fff;
            line-height: 1.06;
            letter-spacing: -.035em;
            margin-bottom: 1.25rem;
        }

        .slide-inner h1 em {
            color: var(--gold);
            font-style: normal;
        }

        .slide-inner p {
            color: rgba(255, 255, 255, .84);
            font-size: 1.05rem;
            line-height: 1.78;
            margin-bottom: 2rem;
            max-width: 560px;
        }

        .slide-ctas {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .slider-arr {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 1.5rem;
            z-index: 10;
            pointer-events: none;
        }

        .arr {
            pointer-events: all;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .14);
            border: 1px solid rgba(255, 255, 255, .3);
            color: #fff;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all .2s;
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .arr:hover {
            background: rgba(255, 255, 255, .28);
        }

        .sdots {
            position: absolute;
            bottom: 1.75rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: .5rem;
            z-index: 10;
        }

        .sdot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .35);
            cursor: pointer;
            border: none;
            transition: all .3s;
        }

        .sdot.on {
            background: #fff;
            transform: scale(1.35);
        }

        /* ── TICKER ── */
        .ticker {
            background: var(--blue);
            padding: 10px 0;
            overflow: hidden;
        }

        .t-track {
            display: flex;
            animation: tick 36s linear infinite;
            white-space: nowrap;
        }

        .t-item {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: 0 2.5rem;
            color: rgba(255, 255, 255, .88);
            font-size: .8rem;
            font-weight: 500;
        }

        .t-item strong {
            color: #fff;
        }

        .up {
            color: #4ade80;
        }

        .dn {
            color: #f87171;
        }

        @keyframes tick {
            from {
                transform: translateX(0)
            }

            to {
                transform: translateX(-50%)
            }
        }

        /* ── ABOUT SECTION ── */
        .about-sec {
            background: var(--bg2);
        }

        /* video thumbnail box — always visible */
        .vid-thumb {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--sh2);
            cursor: pointer;
            display: block;
        }

        .vid-thumb .thumb-inner {
            width: 100%;
            aspect-ratio: 16/9;
            background: linear-gradient(135deg, #062a6b 0%, #1258c4 60%, #0a3d91 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 260px;
        }

        .thumb-inner svg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
        }

        .vid-thumb .play-ring {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(6, 30, 80, .22);
            transition: background .25s;
        }

        .vid-thumb:hover .play-ring {
            background: rgba(6, 30, 80, .38);
        }

        .play-btn {
            width: 76px;
            height: 76px;
            border-radius: 50%;
            background: var(--gold);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.75rem;
            box-shadow: 0 0 0 14px rgba(245, 166, 35, .2), 0 8px 30px rgba(245, 166, 35, .5);
            transition: transform .25s;
            padding-left: 6px;
        }

        .vid-thumb:hover .play-btn {
            transform: scale(1.1);
        }

        .float-badge {
            position: absolute;
            bottom: -1.4rem;
            right: -1.4rem;
            background: #fff;
            border-radius: 14px;
            padding: .9rem 1.2rem;
            box-shadow: var(--sh2);
            display: flex;
            align-items: center;
            gap: .7rem;
            z-index: 3;
        }

        .float-badge .fb-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .float-badge .fb-n {
            font-weight: 700;
            font-size: .86rem;
            color: var(--text);
        }

        .float-badge .fb-v {
            color: var(--green);
            font-size: .76rem;
            font-weight: 600;
        }

        .about-feats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-top: 1.6rem;
        }

        .af {
            display: flex;
            align-items: flex-start;
            gap: .75rem;
        }

        .af-ico {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--bg3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .95rem;
            flex-shrink: 0;
        }

        .af-t {
            font-weight: 600;
            font-size: .875rem;
            color: var(--text);
        }

        .af-d {
            color: var(--text3);
            font-size: .775rem;
            margin-top: .14rem;
            line-height: 1.5;
        }

        /* ── QFS CARD SECTION ── */
        .card-sec {
            background: #fff;
        }

        .card-visual {
            width: 100%;
            max-width: 400px;
            background: linear-gradient(135deg, #1a4fa0, #062a6b);
            border-radius: 22px;
            padding: 2.2rem;
            color: #fff;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .28);
            position: relative;
            overflow: hidden;
        }

        .card-visual::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .04);
        }

        .card-visual::after {
            content: '';
            position: absolute;
            bottom: -40px;
            left: -40px;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: rgba(245, 166, 35, .06);
        }

        .cv-chip {
            width: 42px;
            height: 30px;
            background: linear-gradient(135deg, #f5c542, #e0a800);
            border-radius: 6px;
            margin-bottom: 1.5rem;
        }

        .cv-num {
            font-family: 'Poppins', sans-serif;
            font-size: 1.05rem;
            letter-spacing: .14em;
            margin-bottom: 1.25rem;
            position: relative;
            z-index: 1;
        }

        .cv-bot {
            display: flex;
            justify-content: space-between;
            position: relative;
            z-index: 1;
        }

        .cv-bot .cl {
            font-size: .6rem;
            opacity: .5;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .cv-bot .cv {
            font-size: .82rem;
            font-weight: 600;
            margin-top: .2rem;
        }

        .card-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .card-caption {
            text-align: center;
            color: var(--text3);
            font-size: .8rem;
            margin-top: .5rem;
        }

        .steps-list {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .step-item {
            display: flex;
            gap: 1.25rem;
            align-items: flex-start;
        }

        .step-num {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: var(--blue);
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 14px rgba(10, 61, 145, .25);
        }

        .step-h {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin-bottom: .3rem;
            font-size: .975rem;
        }

        .step-p {
            color: var(--text2);
            font-size: .875rem;
            line-height: 1.68;
        }

        /* ── FLARE NETWORK ── */
        .flare-sec {
            background: var(--bg2);
        }

        .flare-top {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: start;
            margin-bottom: 3rem;
        }

        .yt-ch-link {
            display: flex;
            align-items: center;
            gap: .85rem;
            background: #fff;
            border: 1px solid var(--bd);
            border-radius: 14px;
            padding: 1rem 1.25rem;
            box-shadow: var(--sh);
            transition: all .22s;
            margin-top: 1.25rem;
        }

        .yt-ch-link:hover {
            border-color: var(--blue);
            box-shadow: var(--sh2);
            transform: translateY(-2px);
        }

        .yt-ico {
            width: 46px;
            height: 46px;
            border-radius: 9px;
            background: #ff0000;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .yt-ch-name {
            font-weight: 700;
            font-size: .9rem;
            color: var(--text);
        }

        .yt-ch-sub {
            color: var(--text3);
            font-size: .76rem;
        }

        /* channel image placeholder */
        .ch-banner {
            width: 100%;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: var(--sh);
            background: linear-gradient(135deg, #ff0000, #cc0000);
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            color: #fff;
            margin-top: 1rem;
        }

        .ch-banner-ico {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .18);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .ch-banner-name {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 1.1rem;
        }

        .ch-banner-sub {
            font-size: .78rem;
            opacity: .82;
            margin-top: .2rem;
        }

        /* 4-video grid */
        .vids-label {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.05rem;
            text-align: center;
            margin-bottom: 1.5rem;
            color: var(--text);
        }

        .vids4 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
        }

        .yt-box {
            border-radius: 14px;
            overflow: hidden;
            aspect-ratio: 16/9;
            position: relative;
            box-shadow: var(--sh);
            background: #000;
        }

        .yt-box iframe {
            width: 100%;
            height: 100%;
            border: none;
            display: block;
        }

        /* yt placeholder visible card */
        .yt-ph {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #0a1a3a, #0f3060);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: .7rem;
            text-align: center;
            padding: 1.25rem;
        }

        .yt-ph-play {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background: #ff0000;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.3rem;
            box-shadow: 0 4px 16px rgba(255, 0, 0, .4);
            padding-left: 4px;
            cursor: pointer;
            transition: transform .2s;
            flex-shrink: 0;
        }

        .yt-ph-play:hover {
            transform: scale(1.1);
        }

        .yt-ph strong {
            color: rgba(255, 255, 255, .9);
            font-size: .88rem;
            font-family: 'Poppins', sans-serif;
        }

        .yt-ph span {
            color: rgba(255, 255, 255, .55);
            font-size: .73rem;
        }

        .yt-ph code {
            color: rgba(255, 255, 255, .4);
            font-size: .68rem;
            background: rgba(255, 255, 255, .08);
            padding: 3px 8px;
            border-radius: 4px;
        }

        /* ── VIDEO BANNER SECTION (full-width background + big play btn) ── */
        .vid-banner {
            position: relative;
            background-image: linear-gradient(rgba(6, 30, 80, .78), rgba(6, 30, 80, .78)), url('https://images.unsplash.com/photo-1518770660439-4636190af475?w=1600&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 90px 6%;
            text-align: center;
        }

        .vid-banner h2 {
            font-family: 'Poppins', sans-serif;
            font-size: clamp(1.9rem, 3.5vw, 2.9rem);
            font-weight: 800;
            color: #fff;
            margin-bottom: .75rem;
        }

        .vid-banner p {
            color: rgba(255, 255, 255, .75);
            font-size: 1rem;
            margin-bottom: 2rem;
            max-width: 540px;
            margin-left: auto;
            margin-right: auto;
        }

        .big-play {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            background: var(--gold);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 2rem;
            box-shadow: 0 0 0 16px rgba(245, 166, 35, .2), 0 0 0 32px rgba(245, 166, 35, .1);
            cursor: pointer;
            transition: transform .25s;
            padding-left: 7px;
            border: none;
            margin-bottom: 2rem;
        }

        .big-play:hover {
            transform: scale(1.1);
        }

        /* embedded video container inside banner */
        .vid-embed {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            aspect-ratio: 16/9;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0, 0, 0, .5);
            background: #000;
            position: relative;
        }

        .vid-embed iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .vid-embed-ph {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #050e22, #0a2a5e);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: .85rem;
            text-align: center;
            padding: 2rem;
        }

        .vid-embed-ph .yt-ph-play {
            width: 68px;
            height: 68px;
            font-size: 1.6rem;
        }

        .vid-embed-ph strong {
            color: rgba(255, 255, 255, .88);
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
        }

        .vid-embed-ph span {
            color: rgba(255, 255, 255, .55);
            font-size: .82rem;
            max-width: 340px;
        }

        .vid-embed-ph code {
            color: rgba(255, 255, 255, .4);
            font-size: .72rem;
            background: rgba(255, 255, 255, .08);
            padding: 4px 10px;
            border-radius: 5px;
        }

        .vid-embed-ph a {
            color: #ff8888;
            font-size: .8rem;
            margin-top: .25rem;
        }

        /* ── HOW IT WORKS ── */
        .hiw-sec {
            background: #fff;
        }

        .xrp-banner {
            width: 100%;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--sh2);
        }

        .xrp-banner img {
            width: 100%;
            display: block;
        }

        .xrp-ph {
            width: 100%;
            aspect-ratio: 16/9;
            background: linear-gradient(135deg, #0a2040, #1a4fa0);
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: .75rem;
            text-align: center;
            padding: 2rem;
        }

        .xrp-ph .ico {
            font-size: 3.5rem;
        }

        .xrp-ph strong {
            color: rgba(255, 255, 255, .85);
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
        }

        .xrp-ph span {
            color: rgba(255, 255, 255, .5);
            font-size: .8rem;
        }

        .xrp-ph code {
            color: rgba(255, 255, 255, .4);
            font-size: .7rem;
            background: rgba(255, 255, 255, .08);
            padding: 3px 8px;
            border-radius: 4px;
        }

        /* ── FEATURES ── */
        .feat-sec {
            background: var(--bg2);
        }

        .feat-card {
            background: #fff;
            border: 1px solid var(--bd);
            border-radius: var(--r);
            padding: 2rem 1.75rem;
            transition: all .3s;
            position: relative;
            overflow: hidden;
        }

        .feat-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--blue), var(--gold));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .3s;
        }

        .feat-card:hover {
            box-shadow: var(--sh2);
            transform: translateY(-4px);
            border-color: transparent;
        }

        .feat-card:hover::after {
            transform: scaleX(1);
        }

        .fc-ico {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.45rem;
            margin-bottom: 1.2rem;
        }

        .feat-card h3 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.05rem;
            margin-bottom: .55rem;
            color: var(--text);
        }

        .feat-card p {
            color: var(--text2);
            font-size: .875rem;
            line-height: 1.72;
        }

        /* ── STATS ── */
        .stats-sec {
            background: linear-gradient(135deg, var(--blue3) 0%, var(--blue) 55%, var(--blue2) 100%);
            padding: 80px 6%;
            position: relative;
            overflow: hidden;
        }

        .stats-sec::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, .04) 0%, transparent 60%), radial-gradient(circle at 80% 20%, rgba(245, 166, 35, .07) 0%, transparent 50%);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            position: relative;
            z-index: 1;
        }

        .stat-box {
            text-align: center;
            padding: 2.5rem 1rem;
            border-right: 1px solid rgba(255, 255, 255, .1);
        }

        .stat-box:last-child {
            border-right: none;
        }

        .stat-val {
            font-family: 'Poppins', sans-serif;
            font-size: clamp(1.5rem, 2.8vw, 2.4rem);
            font-weight: 900;
            color: #fff;
            line-height: 1.1;
            margin-bottom: .4rem;
            word-break: break-all;
        }

        .stat-sep {
            width: 32px;
            height: 3px;
            background: var(--gold);
            border-radius: 2px;
            margin: .55rem auto;
        }

        .stat-lbl {
            color: rgba(255, 255, 255, .72);
            font-size: .9rem;
            font-weight: 500;
        }

        /* ── CONTACT BANNER ── */
        .contact-banner {
            background-image: linear-gradient(135deg, rgba(6, 30, 80, .90) 0%, rgba(10, 61, 145, .82) 100%), url('https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=1600&q=80');
            background-size: cover;
            background-position: center;
            padding: 90px 6%;
        }

        .cb-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
        }

        .cb-text h2 {
            font-family: 'Poppins', sans-serif;
            font-size: clamp(2rem, 3vw, 2.7rem);
            font-weight: 800;
            color: #fff;
            margin-bottom: .85rem;
        }

        .cb-text p {
            color: rgba(255, 255, 255, .75);
            font-size: .95rem;
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }

        /* credit card mockup image placeholder in contact section */
        .cb-card-ph {
            margin-top: 2rem;
        }

        .cb-card-img {
            width: 100%;
            max-width: 360px;
            background: linear-gradient(135deg, #1a4fa0, #062a6b);
            border-radius: 18px;
            padding: 2rem;
            color: #fff;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .35);
            position: relative;
            overflow: hidden;
        }

        .cb-card-img::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .04);
        }

        .cb-chip {
            width: 38px;
            height: 27px;
            background: linear-gradient(135deg, #f5c542, #e0a800);
            border-radius: 5px;
            margin-bottom: 1.4rem;
        }

        .cb-num {
            font-size: .95rem;
            letter-spacing: .13em;
            margin-bottom: 1.1rem;
        }

        .cb-bot {
            display: flex;
            justify-content: space-between;
        }

        .cb-bot .lbl {
            font-size: .58rem;
            opacity: .5;
            text-transform: uppercase;
            letter-spacing: .07em;
        }

        .cb-bot .val {
            font-size: .8rem;
            font-weight: 600;
            margin-top: .15rem;
        }

        .contact-card {
            background: #fff;
            border-radius: 20px;
            padding: 2.25rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .25);
        }

        .contact-card h3 {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            color: var(--text);
        }

        .fg {
            margin-bottom: 1rem;
        }

        .fg label {
            display: block;
            font-size: .8rem;
            font-weight: 600;
            color: var(--text2);
            margin-bottom: .4rem;
        }

        .fg input,
        .fg textarea,
        .fg select {
            width: 100%;
            border: 1.5px solid var(--bd);
            border-radius: 10px;
            padding: 11px 14px;
            color: var(--text);
            font-family: 'Inter', sans-serif;
            font-size: .875rem;
            outline: none;
            transition: border .2s;
            background: var(--bg2);
        }

        .fg input:focus,
        .fg textarea:focus,
        .fg select:focus {
            border-color: var(--blue);
            background: #fff;
        }

        .fg textarea {
            resize: vertical;
            min-height: 88px;
        }

        /* ── FAQ ── */
        .faq-sec {
            background: var(--bg3);
        }

        .faq-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: start;
        }

        .faq-list {
            display: flex;
            flex-direction: column;
            gap: .75rem;
        }

        .faq-item {
            background: #fff;
            border: 1px solid var(--bd);
            border-radius: 12px;
            overflow: hidden;
            transition: border-color .2s;
        }

        .faq-item:hover,
        .faq-item.open {
            border-color: var(--blue);
        }

        .faq-q {
            padding: 1.1rem 1.5rem;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: .9rem;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--text);
            user-select: none;
        }

        .faq-item.open .faq-q {
            color: var(--blue);
        }

        .faq-icon {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--bg3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .85rem;
            flex-shrink: 0;
            transition: all .2s;
            font-style: normal;
        }

        .faq-item.open .faq-icon {
            background: var(--blue);
            color: #fff;
            transform: rotate(45deg);
        }

        .faq-a {
            padding: 0 1.5rem 1.1rem;
            color: var(--text2);
            font-size: .875rem;
            line-height: 1.76;
            display: none;
        }

        .faq-item.open .faq-a {
            display: block;
        }

        .faq-right {
            background: linear-gradient(135deg, var(--blue3), var(--blue));
            border-radius: 20px;
            padding: 2.5rem;
            color: #fff;
        }

        .faq-right h3 {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 1.35rem;
            margin-bottom: .6rem;
        }

        .faq-right p {
            opacity: .82;
            font-size: .9rem;
            margin-bottom: 1.75rem;
            line-height: 1.72;
        }

        .faq-right input,
        .faq-right textarea {
            width: 100%;
            background: rgba(255, 255, 255, .1);
            border: 1px solid rgba(255, 255, 255, .22);
            border-radius: 10px;
            padding: 12px 14px;
            color: #fff;
            font-family: 'Inter', sans-serif;
            font-size: .875rem;
            outline: none;
            margin-bottom: 1rem;
        }

        .faq-right input::placeholder,
        .faq-right textarea::placeholder {
            color: rgba(255, 255, 255, .42);
        }

        .faq-right textarea {
            resize: vertical;
            min-height: 88px;
        }

        /* ── TESTIMONIALS ── */
        .testi-sec {
            background: #fff;
        }

        .testi-card {
            background: var(--bg2);
            border: 1px solid var(--bd);
            border-radius: var(--r);
            padding: 1.75rem;
            transition: all .3s;
        }

        .testi-card:hover {
            box-shadow: var(--sh2);
            transform: translateY(-3px);
            background: #fff;
        }

        .stars {
            color: #f59e0b;
            font-size: .9rem;
            margin-bottom: .85rem;
        }

        .testi-txt {
            color: var(--text2);
            font-size: .9rem;
            line-height: 1.78;
            margin-bottom: 1.25rem;
            font-style: italic;
        }

        .testi-auth {
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .t-av {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--blue), var(--gold));
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            color: #fff;
            font-size: .88rem;
            flex-shrink: 0;
        }

        .t-name {
            font-weight: 700;
            font-size: .88rem;
            color: var(--text);
        }

        .t-loc {
            color: var(--text3);
            font-size: .75rem;
        }

        .tp {
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            margin-top: .55rem;
            font-size: .7rem;
            font-weight: 700;
            color: #00b67a;
        }

        /* ── NEWS ── */
        .news-sec {
            background: var(--bg2);
        }

        .news-card {
            background: #fff;
            border: 1px solid var(--bd);
            border-radius: var(--r);
            overflow: hidden;
            transition: all .3s;
        }

        .news-card:hover {
            box-shadow: var(--sh2);
            transform: translateY(-3px);
        }

        .news-img {
            width: 100%;
            height: 188px;
            background: var(--bg3);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--text3);
            font-size: .8rem;
            gap: .4rem;
            text-align: center;
            overflow: hidden;
        }

        .news-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .news-ico {
            font-size: 2.6rem;
        }

        .news-body {
            padding: 1.25rem;
        }

        .news-tag {
            font-size: .7rem;
            font-weight: 700;
            color: var(--blue);
            text-transform: uppercase;
            letter-spacing: .1em;
            margin-bottom: .5rem;
        }

        .news-body h4 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: .95rem;
            line-height: 1.5;
            margin-bottom: .5rem;
            color: var(--text);
        }

        .news-body p {
            color: var(--text2);
            font-size: .825rem;
            line-height: 1.65;
        }

        .news-date {
            color: var(--text3);
            font-size: .74rem;
            margin-top: .75rem;
        }

        /* ── CTA ── */
        .cta-sec {
            background: var(--bg3);
            text-align: center;
        }

        .cta-sec h2 {
            font-family: 'Poppins', sans-serif;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            color: var(--text);
            margin-bottom: 1rem;
        }

        .cta-sec p {
            color: var(--text2);
            max-width: 520px;
            margin: 0 auto 2.25rem;
            line-height: 1.8;
        }

        .cta-btns {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* ── FOOTER ── */
        footer {
            background: #0e1c36;
            color: rgba(255, 255, 255, .9);
            padding: 4rem 6% 2rem;
        }

        .foot-grid {
            display: grid;
            grid-template-columns: 1.6fr 1fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .foot-logo {
            font-family: 'Poppins', sans-serif;
            font-weight: 900;
            font-size: 1.35rem;
            color: #fff;
            margin-bottom: .75rem;
        }

        .foot-logo span {
            color: var(--gold);
        }

        .foot-desc {
            color: rgba(255, 255, 255, .48);
            font-size: .845rem;
            line-height: 1.78;
        }

        .foot-col h4 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: .9rem;
            margin-bottom: 1.1rem;
            color: #fff;
        }

        .foot-col ul {
            display: flex;
            flex-direction: column;
            gap: .6rem;
        }

        .foot-col ul a {
            color: rgba(255, 255, 255, .48);
            font-size: .845rem;
            transition: color .2s;
        }

        .foot-col ul a:hover {
            color: var(--gold);
        }

        .foot-bottom {
            border-top: 1px solid rgba(255, 255, 255, .1);
            padding-top: 1.5rem;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            color: rgba(255, 255, 255, .35);
            font-size: .8rem;
        }

        /* ── MODALS ── */
        .overlay {
            position: fixed;
            inset: 0;
            background: rgba(6, 20, 50, .7);
            backdrop-filter: blur(7px);
            z-index: 2000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .overlay.show {
            display: flex;
        }

        .modal {
            background: #fff;
            border-radius: 20px;
            width: 100%;
            max-width: 440px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0, 0, 0, .28);
            animation: mIn .3s ease;
        }

        @keyframes mIn {
            from {
                opacity: 0;
                transform: translateY(22px)
            }

            to {
                opacity: 1;
                transform: none
            }
        }

        .m-head {
            background: linear-gradient(135deg, var(--blue3), var(--blue));
            padding: 1.75rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .m-head h3 {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 1.2rem;
            color: #fff;
        }

        .m-close {
            background: rgba(255, 255, 255, .15);
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .2s;
        }

        .m-close:hover {
            background: rgba(255, 255, 255, .28);
        }

        .m-body {
            padding: 1.75rem;
        }

        .mfg {
            margin-bottom: 1.1rem;
        }

        .mfg label {
            display: block;
            font-size: .8rem;
            font-weight: 600;
            color: var(--text2);
            margin-bottom: .4rem;
        }

        .mfg input,
        .mfg select {
            width: 100%;
            border: 1.5px solid var(--bd);
            border-radius: 10px;
            padding: 11px 14px;
            color: var(--text);
            font-family: 'Inter', sans-serif;
            font-size: .875rem;
            outline: none;
            transition: border .2s;
            background: var(--bg2);
        }

        .mfg input:focus,
        .mfg select:focus {
            border-color: var(--blue);
            background: #fff;
        }

        .m-foot {
            padding: 0 1.75rem 1.75rem;
        }

        .div-or {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin: 1rem 0;
            color: var(--text3);
            font-size: .78rem;
        }

        .div-or::before,
        .div-or::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--bd);
        }

        .tog-p {
            text-align: center;
            font-size: .83rem;
            color: var(--text2);
            margin-top: .75rem;
        }

        .tog-p a {
            color: var(--blue);
            font-weight: 600;
            cursor: pointer;
        }

        .frow {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .rem-row {
            display: flex;
            align-items: center;
            gap: .5rem;
            font-size: .82rem;
            color: var(--text2);
            cursor: pointer;
            margin-bottom: .85rem;
        }

        .rem-row input[type=checkbox] {
            width: 15px;
            height: 15px;
            accent-color: var(--blue);
        }

        .forgot {
            text-align: right;
            font-size: .78rem;
            color: var(--blue);
            margin-bottom: .85rem;
            cursor: pointer;
            display: block;
        }

        /* ── SCROLL TOP ── */
        #stb {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: var(--blue);
            color: #fff;
            border: none;
            font-size: 1rem;
            cursor: pointer;
            box-shadow: 0 4px 16px rgba(10, 61, 145, .3);
            z-index: 500;
            display: none;
            align-items: center;
            justify-content: center;
            transition: all .2s;
        }

        #stb.on {
            display: flex;
        }

        #stb:hover {
            background: var(--blue2);
            transform: translateY(-2px);
        }

        /* ── RESPONSIVE ── */
        @media(max-width:1100px) {

            .grid2,
            .flare-top,
            .cb-grid,
            .faq-grid {
                grid-template-columns: 1fr;
                gap: 2.5rem;
            }

            .grid3,
            .vids4 {
                grid-template-columns: repeat(2, 1fr);
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .foot-grid {
                grid-template-columns: 1fr 1fr;
                gap: 2rem;
            }

            .float-badge {
                display: none;
            }
        }

        @media(max-width:768px) {
            .nav-links {
                display: none;
            }

            .grid3,
            .vids4 {
                grid-template-columns: 1fr;
            }

            .foot-grid {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width:480px) {
            .nav-cta .btn-outline {
                display: none;
            }

            .frow {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }

            .stat-box {
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, .1);
            }
        }

        /* DARK MODE STYLES */
        html.dark body { background: #010409; color: #e6edf3; }
        html.dark .nav { background: rgba(1, 4, 9, 0.9); border-bottom: 1px solid rgba(255,255,255,0.05); }
        html.dark .sec { background: #010409; }
        html.dark .sec-h { color: white; }
        html.dark .sec-p, html.dark p { color: #8b949e; }
        html.dark .bar { background: var(--blue); }
        html.dark .card-wrap, html.dark .faq-container, html.dark .testimonial-container { background: #0d1117; border: 1px solid #30363d; }
        html.dark .faq-item { background: #161b22; border-bottom: 1px solid #30363d; }
        html.dark .faq-q { color: white; }
        html.dark .contact-form input, html.dark .contact-form textarea { background: #0d1117; border: 1px solid #30363d; color: white; }
        html.dark .nav-logo { color: white; }
        html.dark .nav-links li a { color: #8b949e; }
        html.dark .nav-links li a:hover { color: white; }
        html.dark .footer { background: #010409; border-top: 1px solid #30363d; }
        html.dark .news-card { background: #0d1117; border: 1px solid #30363d; }
        html.dark .news-h { color: white; }
    </style>
</head>

<body>

    <!-- ════════════════════ NAVBAR ════════════════════ -->
    <nav class="nav">
        <div class="nav-logo">QFS<span>WORLD</span></div>
        <ul class="nav-links">
            <li><a href="#about">About Us</a></li>
            <li><a href="#flare">The Flare Network</a></li>
            <li><a href="#hiw">How It Works</a></li>
            <li><a href="#faq">FAQ</a></li>
            <li><a href="#testimonials">Testimonials</a></li>
            <li><a href="#news">Recent News</a></li>
        </ul>
        <div class="nav-cta">
            <button id="lpThemeToggle" class="btn btn-icon" style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); color:white; width:40px; height:40px; border-radius:50%; display:flex; align-items:center; justify-center: center; cursor:pointer; margin-right:1rem;">
                <i class="fas fa-moon"></i>
            </button>
            <a href="{{ route('login') }}" class="btn btn-outline">Login</a>
            <a href="{{ route('register') }}" class="btn btn-blue">Register Now</a>
        </div>
    </nav>

    <!-- ════════════════════ HERO SLIDER ════════════════════ -->
    <div class="hero">
        <div class="slide s1 on">
            <div class="slide-bg"></div>
            <div class="slide-body">
                <div class="slide-inner">
                    <div class="s-badge">⚡ Quantum-Secured Digital Finance</div>
                    <h1>QUANTUM<br>FINANCIAL<br><em>SYSTEM</em></h1>
                    <p>QFSWORLD gives your digital assets the full immunity they deserve — completely protected against
                        cyber attacks and bad market fluctuations. The future of finance is here.</p>
                    <div class="slide-ctas">
                        <a href="{{ route('register') }}" class="btn btn-gold btn-lg">REGISTER
                            NOW</a>
                        <a href="{{ route('login') }}" class="btn btn-ghost btn-lg">LOGIN
                            NOW</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide s2">
            <div class="slide-bg"></div>
            <div class="slide-body">
                <div class="slide-inner">
                    <div class="s-badge">🌍 Trusted in 118+ Countries Worldwide</div>
                    <h1>SECURE YOUR<br><em>DIGITAL</em><br>ASSETS NOW</h1>
                    <p>QFSWORLD (QFS) gives your assets the protection they truly deserve. Never miss this opportunity —
                        synchronize your wallets now for maximum security and swift transactions.</p>
                    <div class="slide-ctas">
                        <a href="#" class="btn btn-gold btn-lg" onclick="openM('register');return false;">REGISTER
                            NOW</a>
                        <a href="#" class="btn btn-ghost btn-lg" onclick="openM('login');return false;">LOGIN
                            NOW</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider-arr">
            <button class="arr" onclick="chSlide(-1)">&#8592;</button>
            <button class="arr" onclick="chSlide(1)">&#8594;</button>
        </div>
        <div class="sdots">
            <button class="sdot on" onclick="goSlide(0)"></button>
            <button class="sdot" onclick="goSlide(1)"></button>
        </div>
    </div>

    <!-- TICKER -->
    <div class="ticker">
        <div class="t-track">
            <span class="t-item">🟡 <strong>BTC</strong> $67,240 <span class="up">▲2.4%</span></span>
            <span class="t-item">🔵 <strong>ETH</strong> $3,512 <span class="up">▲1.8%</span></span>
            <span class="t-item">🔵 <strong>XRP</strong> $0.621 <span class="dn">▼0.9%</span></span>
            <span class="t-item">🟢 <strong>USDT</strong> $1.00 <span class="up">▲0.0%</span></span>
            <span class="t-item">🔴 <strong>SOL</strong> $178.30 <span class="up">▲5.1%</span></span>
            <span class="t-item">🟣 <strong>BNB</strong> $412.00 <span class="up">▲1.2%</span></span>
            <span class="t-item">🔵 <strong>ADA</strong> $0.482 <span class="dn">▼1.3%</span></span>
            <span class="t-item">🟠 <strong>LTC</strong> $86.40 <span class="up">▲0.7%</span></span>
            <span class="t-item">🟡 <strong>BTC</strong> $67,240 <span class="up">▲2.4%</span></span>
            <span class="t-item">🔵 <strong>ETH</strong> $3,512 <span class="up">▲1.8%</span></span>
            <span class="t-item">🔵 <strong>XRP</strong> $0.621 <span class="dn">▼0.9%</span></span>
            <span class="t-item">🟢 <strong>USDT</strong> $1.00 <span class="up">▲0.0%</span></span>
            <span class="t-item">🔴 <strong>SOL</strong> $178.30 <span class="up">▲5.1%</span></span>
            <span class="t-item">🟣 <strong>BNB</strong> $412.00 <span class="up">▲1.2%</span></span>
            <span class="t-item">🔵 <strong>ADA</strong> $0.482 <span class="dn">▼1.3%</span></span>
            <span class="t-item">🟠 <strong>LTC</strong> $86.40 <span class="up">▲0.7%</span></span>
        </div>
    </div>

    <!-- ════════════════════ ABOUT SECTION ════════════════════ -->
    <section class="sec about-sec" id="about">
        <div class="grid2">

            <!-- LEFT: VIDEO THUMBNAIL with play button — always fully visible -->
            <div style="position:relative;">
                <!--
        ╔══════════════════════════════════════════════════════════╗
        ║  ABOUT VIDEO THUMBNAIL                                   ║
        ║  • This box is always fully visible (no external images) ║
        ║  • To use YOUR OWN thumbnail: replace the <div.vid-thumb>║
        ║    with: <a href="qfs.mp4" class="vid-thumb">            ║
        ║              <img src="your-thumbnail.jpg">              ║
        ║              <div class="play-ring">                     ║
        ║                <div class="play-btn">▶</div>             ║
        ║              </div>                                      ║
        ║           </a>                                           ║
        ╚══════════════════════════════════════════════════════════╝
      -->
                <a href="videos/your-video.mp4" class="vid-thumb" target="_blank">
                    <img src="{{ asset('images/about-qfs.png') }}" alt="About QFSWORLD"
                        style="width:100%;height:100%;object-fit:cover;">

                    <!-- Play button overlay -->
                    <div class="play-ring">
                        <div class="play-btn">▶</div>
                    </div>
                </a>
                <!-- Floating badge -->
                <div class="float-badge">
                    <div class="fb-icon">🛡️</div>
                    <div>
                        <div class="fb-n">100% Secure</div>
                        <div class="fb-v">✓ Quantum Encrypted</div>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Text content -->
            <div>
                <span class="sec-label">About QFSWORLD</span>
                <h2 class="sec-h">About the Quantum <span>Financial System</span></h2>
                <div class="bar"></div>
                <p style="color:var(--text2);line-height:1.82;margin-bottom:1.1rem;font-size:.96rem;">
                    Little is it known that this new system has been designed in preparation for the takeover of the
                    Central Bank Monetary Debt System — to end financial slavery and control over the populace. The
                    Alliance gave President Trump the means of taking over the old banking system without dismantling
                    it.
                </p>
                <p style="color:var(--text2);line-height:1.82;margin-bottom:1.75rem;font-size:.96rem;">
                    Humanity does not have the technology to fight the Deep State's financial system. In Quantum
                    Computers, intelligence is embedded without 3D limitations. No ordinary creation is able to replace
                    the power of a living being. QFSWORLD consistently exceeds customer expectations by providing
                    value-adding digital banking solutions.
                </p>
                <div class="about-feats">
                    <div class="af">
                        <div class="af-ico">💡</div>
                        <div>
                            <div class="af-t">Easy to Work With</div>
                            <div class="af-d">QFS consistently exceeds expectations with value-adding banking
                                solutions for all users</div>
                        </div>
                    </div>
                    <div class="af">
                        <div class="af-ico">🎁</div>
                        <div>
                            <div class="af-t">Outstanding Offers</div>
                            <div class="af-d">QFS returns outstanding value through a wide range of products and
                                services worldwide</div>
                        </div>
                    </div>
                    <div class="af">
                        <div class="af-ico">🔒</div>
                        <div>
                            <div class="af-t">Quantum Security</div>
                            <div class="af-d">Full immunity against cyber attacks and bad market fluctuations —
                                always protected</div>
                        </div>
                    </div>
                    <div class="af">
                        <div class="af-ico">🌍</div>
                        <div>
                            <div class="af-t">118+ Countries</div>
                            <div class="af-d">Shop, send, and transact freely in over 118 countries worldwide with
                                your QFS card</div>
                        </div>
                    </div>
                </div>
                <div style="margin-top:2rem;display:flex;gap:1rem;flex-wrap:wrap;">
                    <a href="#" class="btn btn-blue" onclick="openM('register');return false;">Register Now</a>
                    <a href="https://www.qfs1776.com/_files/ugd/a16bfe_46e53371c3924d10a587d58fb9e5a0e1.pdf"
                        target="_blank" class="btn btn-outline">QFSWORLD Manual →</a>
                </div>
            </div>

        </div>
    </section>

    <!-- ════════════════════ QFS CARD SECTION ════════════════════ -->
    <section class="sec card-sec">
        <div class="grid2">

            <!-- LEFT: Card visual -->
            <div class="card-wrap">
                <!--
        Replace the card-visual div below with:
        <img src="assets/img/Credit-Card.jpg" alt="QFS Credit Card" style="border-radius:20px;box-shadow:var(--sh2);">
      -->
                <img src="{{ asset('images/Credit-Card.png') }}" alt="QFS Credit Card"
                    style="width:100%;max-width:420px;border-radius:20px;
               box-shadow:0 12px 48px rgba(10,61,145,0.16);">
            </div>

            <!-- RIGHT: Steps -->
            <div>
                <span class="sec-label">QFS Cards</span>
                <h2 class="sec-h">Get Access to QFS Cards —<br><span>Shop in 118+ Countries</span></h2>
                <div class="bar"></div>
                <p style="color:var(--text2);font-size:.96rem;line-height:1.8;margin-bottom:2rem;">
                    Sign up to synchronize your digital wallets with QFS for maximum cyber security and swift funding
                    and transfer of your assets using the Quantum Finance Credit Card — accepted in over 118 countries
                    worldwide.
                </p>
                <div class="steps-list">
                    <div class="step-item">
                        <div class="step-num">1</div>
                        <div>
                            <div class="step-h">Sign Up</div>
                            <p class="step-p">Sign up for onboarding on QFS, then verify your identity through our
                                quick and secure KYC process.</p>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-num">2</div>
                        <div>
                            <div class="step-h">Wait for Approval</div>
                            <p class="step-p">Once your KYC submission is approved, proceed to sync your wallet with
                                KYC. You can also apply for a Humanitarian Project.</p>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-num">3</div>
                        <div>
                            <div class="step-h">Get Your QFS Card</div>
                            <p class="step-p">Receive your QFS Cards now to access Quantum Med-beds, Quantum Computers,
                                Q-phones, and shop freely in over 118 countries.</p>
                        </div>
                    </div>
                </div>
                <div style="margin-top:2rem;">
                    <a href="#" class="btn btn-blue" onclick="openM('register');return false;">Get Started
                        Today</a>
                </div>
            </div>

        </div>
    </section>

    <!-- ════════════════════ FLARE NETWORK ════════════════════ -->
    <section class="sec flare-sec" id="flare">

        <!-- TOP: text left + channel link right -->
        <div class="flare-top">
            <div>
                <span class="sec-label">The Flare Network</span>
                <h2 class="sec-h">XRP End Game — <span>New World Reserve</span> Cryptocurrency Incoming!</h2>
                <div class="bar"></div>
                <p style="color:var(--text2);line-height:1.82;margin-bottom:.75rem;font-size:.96rem;"><strong>Powered
                        by Ripple (XRP)</strong></p>
                <p style="color:var(--text2);line-height:1.82;margin-bottom:.75rem;font-size:.96rem;">A new world
                    reserve cryptocurrency is incoming. The Flare Network brings smart contract capabilities to XRP,
                    creating an entirely new financial ecosystem built for billions of people worldwide.</p>
                <p style="color:var(--text2);line-height:1.82;font-size:.96rem;">Interview with Mark Philips. Follow
                    our latest developments and innovations on our dedicated YouTube channel —
                    <strong>XRPQFSTeam1</strong> — for the most current updates and breakthroughs in quantum finance.
                </p>
            </div>
            <div>
                <!-- YouTube Channel Link -->
                <a href="https://www.youtube.com/channel/UCHACcQVpw_p0n03zZdSt4fg/videos" target="_blank"
                    class="yt-ch-link">
                    <div class="yt-ico">▶</div>
                    <div>
                        <div class="yt-ch-name">Follow Us on YouTube</div>
                        <div class="yt-ch-sub">XRPQFSTeam1 — Subscribe for latest updates</div>
                    </div>
                </a>
                <!--
        Channel banner image — replace this div with:
        <img src="assets/img/channel.png" alt="YouTube Channel" style="width:100%;border-radius:14px;margin-top:1rem;">
      -->
                <img src="images/channel.png" alt="XRPQFSTeam1 YouTube Channel"
                    style="width:100%;border-radius:14px;margin-top:1rem;
               box-shadow:0 4px 24px rgba(10,61,145,0.10);">
            </div>
        </div>

        <!-- 4 YouTube video containers -->
        <div class="vids-label">Watch Our Latest Videos for Better Innovation</div>
        <div class="vids4">

            <!-- VIDEO 1 -->
            <div class="yt-box">
                <iframe src="https://www.youtube-nocookie.com/embed/sFX1d7Si3mA"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    `allowfullscreen referrerpolicy="strict-origin-when-cross-origin"
                    title="QFS Video`
      width="100%" height="100%" style="border:none;">
                </iframe>
            </div>

            <!-- VIDEO 2 — paste your real video ID below -->
            <div class="yt-box">
                <iframe src="https://www.youtube-nocookie.com/embed/yLeji6EidI8"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    `allowfullscreen referrerpolicy="strict-origin-when-cross-origin"
                    title="QFS Video`
      width="100%" height="100%" style="border:none;">
                </iframe>
            </div>

            <!-- VIDEO 3 — paste your real video ID below -->
            <div class="yt-box">
                <iframe src="https://www.youtube-nocookie.com/embed/juUgJwBwgWk"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    `allowfullscreen referrerpolicy="strict-origin-when-cross-origin"
                    title="QFS Video`
      width="100%" height="100%" style="border:none;">
                </iframe>
            </div>
        </div>
    </section>

    <!-- ════════════════════ "WATCH LATEST VIDEO" FULL-WIDTH BANNER ════════════════════ -->
    <!--
  Full-width dark image background section with large play button + video embed below.
  Replace the background image by editing the CSS .vid-banner background-image url.
-->
    <div class="vid-banner">
        <h2>Watch Our Latest Video For Better Innovation</h2>
        <p>Stay informed with the most current breakthroughs, updates, and insights from the QFSWORLD team. New videos
            every week.</p>
        <a href="https://www.youtube.com/channel/UCHACcQVpw_p0n03zZdSt4fg/videos" target="_blank">
            <button class="big-play" title="Watch on YouTube">▶</button>
        </a>
        <!-- Full-width embedded video below the play button -->
        <div class="vid-embed">
            <iframe src="https://www.youtube-nocookie.com/embed/TSFhBVaI7RQ" allowfullscreen
                title="QFSWORLD Featured Video"></iframe>
        </div>
        <strong>Featured YouTube Video Embed</strong>
        <span>Uncomment the &lt;iframe&gt; above and replace YOUR_VIDEO_ID with your actual YouTube video ID to display
            the video inline here</span>
        <code>youtube.com/embed/YOUR_VIDEO_ID</code>
        <a href="https://www.youtube.com/channel/UCHACcQVpw_p0n03zZdSt4fg/videos" target="_blank">▶ Open YouTube
            Channel</a>
    </div>
    </div>
    </div>

    <!-- ════════════════════ HOW IT WORKS ════════════════════ -->
    <section class="sec hiw-sec" id="hiw">
        <div class="grid2">

            <!-- LEFT: Text + steps -->
            <div>
                <span class="sec-label">The System</span>
                <h2 class="sec-h">How It Works!</h2>
                <div class="bar"></div>
                <p style="color:var(--text2);line-height:1.82;margin-bottom:1.1rem;font-size:.96rem;">
                    With the activation of the QFS, the Alliance will have completely destroyed the Rothschild Central
                    Banking system designed by Meyer Amschel Rothschild (1744–1812) to control the world economy and put
                    the global population into debt slavery.
                </p>
                <p style="color:var(--text2);line-height:1.82;margin-bottom:1.75rem;font-size:.96rem;">
                    The QFS has been running in parallel with the Central Banking System for some time and has countered
                    many hacking attempts by the Cabal. This powerful quantum computer system can assign a digital
                    number to every fiat dollar, euro, and yen across every bank account worldwide — monitoring in
                    real-time exactly where every payment went and who sent it.
                </p>
                <div class="steps-list">
                    <div class="step-item">
                        <div class="step-num" style="background:var(--gold);">1</div>
                        <div>
                            <div class="step-h">Sign Up</div>
                            <p class="step-p">Register a free account and take your very first step toward fully
                                securing your digital assets.</p>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-num" style="background:var(--green);">2</div>
                        <div>
                            <div class="step-h">Secure Your Asset</div>
                            <p class="step-p">Connect your wallet to the QFSWORLD vault to protect your assets from
                                market fluctuations and crypto fraud.</p>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-num" style="background:var(--blue);">3</div>
                        <div>
                            <div class="step-h">Loans & Mortgages</div>
                            <p class="step-p">QFSWORLD guides you to make the right loan and mortgage choices that are
                                absolutely suited to your financial needs.</p>
                        </div>
                    </div>
                </div>
                <div style="margin-top:2rem;">
                    <a href="#" class="btn btn-blue" onclick="openM('login');return false;">Learn More →</a>
                </div>
            </div>

            <!-- RIGHT: XRP Banner image placeholder -->
            <div>
                <!--
        XRP Banner Image — replace this div with:
        <img src="assets/img/xrp-banner.jpeg" alt="XRP Banner" style="width:100%;border-radius:20px;box-shadow:var(--sh2);">
      -->
                <img src="images/xrp-banner.jpeg" alt="XRP Banner"
                    style="width:100%;border-radius:20px;
               box-shadow:0 12px 48px rgba(10,61,145,0.16);">

            </div>
    </section>

    <!-- ════════════════════ FEATURES / SERVICES ════════════════════ -->
    <section class="sec feat-sec">
        <div class="tc">
            <span class="sec-label">Our Services</span>
            <h2 class="sec-h">Everything You Need in <span>One Place</span></h2>
            <div class="bar"></div>
            <p class="sec-p">QFSWORLD brings together digital currency protection, wallet security, and seamless
                banking — all under one quantum-secured roof available 24/7.</p>
        </div>
        <div class="grid3" style="margin-top:3rem;">
            <div class="feat-card">
                <div class="fc-ico" style="background:#eff6ff;">💸</div>
                <h3>Send & Receive Crypto</h3>
                <p>Transfer any cryptocurrency to anyone in the world instantly — zero borders, ultra-low fees, and
                    lightning-fast confirmations on every single transaction.</p>
            </div>
            <div class="feat-card">
                <div class="fc-ico" style="background:#f0fdf4;">🛒</div>
                <h3>Buy Crypto Instantly</h3>
                <p>Purchase over 50 cryptocurrencies using your bank card, debit card, or direct bank transfer. Simple,
                    fast, and completely secure checkout experience.</p>
            </div>
            <div class="feat-card">
                <div class="fc-ico" style="background:#fffbeb;">🎁</div>
                <h3>Gift Card Trading</h3>
                <p>Trade Amazon, iTunes, Steam, Google Play, and many other gift cards for cryptocurrency at highly
                    competitive rates with fast verified payouts.</p>
            </div>
            <div class="feat-card">
                <div class="fc-ico" style="background:#f5f3ff;">🔗</div>
                <h3>Connect Your Wallet</h3>
                <p>Link your existing MetaMask, Trust Wallet, or any decentralized wallet using your seed phrase or
                    WalletConnect protocol — done in seconds.</p>
            </div>
            <div class="feat-card">
                <div class="fc-ico" style="background:#fff1f2;">🛡️</div>
                <h3>Digital Currency Protection</h3>
                <p>Protect your crypto wallet and digital assets from bad market fluctuations and crypto fraud with our
                    quantum-grade vault security system running 24/7.</p>
            </div>
            <div class="feat-card">
                <div class="fc-ico" style="background:#f0fdfa;">🏦</div>
                <h3>Banking at Your Fingertips</h3>
                <p>Full banking capabilities available anytime, anywhere. Link your bank card, manage your portfolio,
                    and transact freely across 118+ countries worldwide.</p>
            </div>
        </div>
    </section>

    <!-- ════════════════════ STATS ════════════════════ -->
    <section class="stats-sec">
        <div class="stats-grid">
            <div class="stat-box">
                <div class="stat-val">8,698,958,943,561</div>
                <div class="stat-sep"></div>
                <div class="stat-lbl">Secured Assets</div>
            </div>
            <div class="stat-box">
                <div class="stat-val">87,764,312</div>
                <div class="stat-sep"></div>
                <div class="stat-lbl">Satisfied Users</div>
            </div>
            <div class="stat-box">
                <div class="stat-val">170,294</div>
                <div class="stat-sep"></div>
                <div class="stat-lbl">Global Awards</div>
            </div>
            <div class="stat-box">
                <div class="stat-val">88,764,316</div>
                <div class="stat-sep"></div>
                <div class="stat-lbl">Registered Users</div>
            </div>
        </div>
    </section>

    <!-- ════════════════════ CONTACT BANNER ════════════════════ -->
    <div class="contact-banner" id="contact">
        <div class="cb-grid">

            <!-- LEFT: Text + card mockup image -->
            <div class="cb-text">
                <h2>Make an Enquiry</h2>
                <p>Have a question about QFSWORLD or need help getting started? Our dedicated support team is always
                    ready to assist you — reach out and we will respond promptly.</p>
                <!--
        Credit Card Mockup image
        Replace this div with: <img src="assets/img/Credit-Card-Mockup.png" alt="QFS Card Mockup" style="width:100%;max-width:360px;border-radius:18px;margin-top:1.5rem;">
      -->
                <img src="images/Credit-Card-Mockup.png" alt="QFS Card Mockup"
                    style="width:100%;max-width:360px;border-radius:18px;
               margin-top:1.5rem;
               box-shadow:0 20px 50px rgba(0,0,0,0.35);">
            </div>

            <!-- RIGHT: Contact form -->
            <div class="contact-card">
                <h3>Send Us a Message</h3>
                <form id="contactFormMain" class="contact-form">
                    @csrf
                    <div class="fg"><label>Full Name</label><input type="text" name="name" placeholder="Your full name" required></div>
                    <div class="fg"><label>Email Address</label><input type="email" name="email" placeholder="you@example.com" required></div>
                    <div class="fg"><label>Subject</label><input type="text" name="subject" placeholder="How can we help you?" required></div>
                    <div class="fg"><label>Message</label>
                        <textarea name="message" placeholder="Write your message here..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-blue btn-w">Send Message →</button>
                    <div class="form-status mt-2 hidden"></div>
                </form>
            </div>

        </div>
    </div>

    <!-- ════════════════════ FAQ ════════════════════ -->
    <section class="sec faq-sec" id="faq">
        <div class="faq-grid">

            <!-- LEFT: FAQ accordion -->
            <div>
                <span class="sec-label">FAQ</span>
                <h2 class="sec-h">Frequently Asked <span>Questions</span></h2>
                <div class="bar"></div>
                <p class="sec-p" style="margin-bottom:1.75rem;">Possible questions you might have about QFS Ledger
                    Security. For more clarifications contact support at: <a href="mailto:support@qfsworld.com"
                        style="color:var(--blue);">support@qfsworld.com</a></p>
                <div class="faq-list">
                    <div class="faq-item open">
                        <div class="faq-q" onclick="tFaq(this)">What is QFS Ledger Security? <i
                                class="faq-icon">+</i></div>
                        <div class="faq-a">QFSWORLD is a wallet and digital asset secure system, which gives full
                            immunity against cyber attacks and bad market fluctuations. It is the most advanced
                            financial protection platform ever created for everyday users.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-q" onclick="tFaq(this)">Does it matter if I am new to crypto? <i
                                class="faq-icon">+</i></div>
                        <div class="faq-a">Not at all. We have a dedicated support system that will guide you through
                            how to manage risk and make the absolute best use of your digital assets — no prior
                            experience required whatsoever.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-q" onclick="tFaq(this)">Is sign-up free? <i class="faq-icon">+</i></div>
                        <div class="faq-a">Yes! Register a completely free account with QFSWORLD and take your first
                            step toward securing your crypto wallet and digital assets. There are no hidden fees —
                            sign-up is always free.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-q" onclick="tFaq(this)">How do I get started? <i class="faq-icon">+</i>
                        </div>
                        <div class="faq-a">First, register a free account and verify it. Then log in to your user
                            dashboard, click on "Secure Wallet/Asset," and follow the simple step-by-step instructions
                            to fully secure your wallet and assets.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-q" onclick="tFaq(this)">How can QFSWORLD improve my financial status? <i
                                class="faq-icon">+</i></div>
                        <div class="faq-a">QFSWORLD is a crypto wallet and digital asset vault which protects your
                            holdings from bad market fluctuations and crypto fraud, ensuring your wealth remains safe,
                            accessible, and growing at all times.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-q" onclick="tFaq(this)">When do I get my payout? <i class="faq-icon">+</i>
                        </div>
                        <div class="faq-a">QFSWORLD payouts and all transactions are seamless and processed
                            automatically by the system. Most transfers are instant or completed within minutes
                            depending on specific network conditions at the time.</div>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Mini contact form -->
            <div class="faq-right">
                <img src="{{ asset('images/support-enquiry.png') }}" alt="Make Enquiry" style="width:100%; border-radius:14px; margin-bottom:1.5rem; box-shadow: var(--sh);">
                <h3>Make an Enquiry</h3>
                <p>Send us a message and our dedicated support team will get back to you within 24 hours, any day of the week.</p>
                <form id="enquiryForm" class="contact-form">
                    @csrf
                    <input type="text" name="name" placeholder="Your Full Name" required class="w-full mb-3 p-3 border rounded">
                    <input type="email" name="email" placeholder="Your Email Address" required class="w-full mb-3 p-3 border rounded">
                    <input type="text" name="subject" placeholder="Subject" required class="w-full mb-3 p-3 border rounded">
                    <textarea name="message" placeholder="Your message..." required class="w-full mb-3 p-3 border rounded h-32"></textarea>
                    <button type="submit" class="btn btn-gold btn-w">Send Message →</button>
                    <div class="form-status mt-2 hidden"></div>
                </form>
            </div>

        </div>
    </section>

    <!-- ════════════════════ TESTIMONIALS ════════════════════ -->
    <section class="sec testi-sec" id="testimonials">
        <div class="tc">
            <span class="sec-label">Testimonials</span>
            <h2 class="sec-h">What People Say</h2>
            <div class="bar"></div>
        </div>
        <div class="grid3">
            <div class="testi-card">
                <div class="stars">★★★★★</div>
                <p class="testi-txt">"All thanks to QFSWORLD my crypto wallet is now fully safe — no more losses from
                    bad market fluctuations. This platform has completely transformed how I protect and manage my
                    digital assets."</p>
                <div class="testi-auth">
                    <div class="t-av">L</div>
                    <div>
                        <div class="t-name">Luck</div>
                        <div class="t-loc">🇺🇸 United States</div>
                        <div class="tp">★ Trustpilot Verified</div>
                    </div>
                </div>
            </div>
            <div class="testi-card">
                <div class="stars">★★★★★</div>
                <p class="testi-txt">"Je n'ai jamais cru aux systèmes sécurisés jusqu'à ce que je découvre QFSWORLD. Ce
                    coffre-fort est tout simplement le meilleur — je le recommande à tous sans la moindre hésitation."
                </p>
                <div class="testi-auth">
                    <div class="t-av">E</div>
                    <div>
                        <div class="t-name">Elise</div>
                        <div class="t-loc">🇫🇷 France</div>
                        <div class="tp">★ Trustpilot Verified</div>
                    </div>
                </div>
            </div>
            <div class="testi-card">
                <div class="stars">★★★★★</div>
                <p class="testi-txt">"This new innovation from QFSWORLD is simply top notch. Now I don't have to be
                    afraid of crypto fluctuations like before. I feel completely in full control of my financial future
                    once again."</p>
                <div class="testi-auth">
                    <div class="t-av">C</div>
                    <div>
                        <div class="t-name">Charlotte</div>
                        <div class="t-loc">🇬🇧 England</div>
                        <div class="tp">★ Trustpilot Verified</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ════════════════════ RECENT NEWS ════════════════════ -->
    <section class="sec news-sec" id="news">
        <div class="tc">
            <span class="sec-label">Recent News</span>
            <h2 class="sec-h">Latest from <span>QFSWORLD</span></h2>
            <div class="bar"></div>
        </div>
        <div class="grid3">
            <div class="news-card">
                <div class="news-body">
                    <div class="news-tag">Crypto Security</div>
                    <h4>QFSWORLD Surpasses 87 Million Protected Users Worldwide</h4>
                    <p>QFSWORLD continues its global expansion, onboarding millions of new users seeking protection from
                        digital asset volatility and crypto fraud.</p>
                    <div class="news-date">March 2026</div>
                </div>
            </div>
            <div class="news-card">
                <div class="news-body">
                    <div class="news-tag">XRP / Flare</div>
                    <h4>Flare Network Integration Unlocks Smart Contracts for XRP Holders</h4>
                    <p>The partnership between QFSWORLD and the Flare Network opens a new era of decentralized finance
                        powered entirely by Ripple's XRP token.</p>
                    <div class="news-date">February 2026</div>
                </div>
            </div>
            <div class="news-card">
                <div class="news-body">
                    <div class="news-tag">Awards</div>
                    <h4>QFSWORLD Recognized with 170,294 Global Digital Finance Innovation Awards</h4>
                    <p>QFSWORLD has been globally recognized for its revolutionary approach to quantum-secured digital
                        asset management and protection.</p>
                    <div class="news-date">January 2026</div>
                </div>
            </div>
        </div>
        <div style="text-align:center;margin-top:2.5rem;">
            <a href="https://cryptopanic.com/" target="_blank" class="btn btn-outline">View All Recent News →</a>
        </div>
    </section>

    <!-- ════════════════════ CTA ════════════════════ -->
    <section class="sec cta-sec">
        <span class="sec-label" style="display:block;text-align:center;">Get Started Today</span>
        <h2>Ready to Secure Your Digital Future?</h2>
        <p>Join over 87 million satisfied users already protecting their wealth with QFSWORLD. Registration is
            completely free — get started in under 60 seconds.</p>
        <div class="cta-btns">
            <a href="#" class="btn btn-blue btn-lg" onclick="openM('register');return false;">Register Now —
                It's Free</a>
            <a href="#" class="btn btn-outline btn-lg" onclick="openM('login');return false;">Login to
                Dashboard</a>
        </div>
    </section>

    <!-- ════════════════════ FOOTER ════════════════════ -->
    <footer>
        <div class="foot-grid">
            <div>
                <div class="foot-logo">QFS<span>WORLD</span></div>
                <p class="foot-desc">The QUANTUM FINANCIAL SYSTEM has no comparison to anything ever introduced to the
                    world before. It has no peer; it reigns supreme in the technology it applies, accomplishing one
                    hundred percent financial security and transparency for all currency account holders worldwide.</p>
            </div>
            <div class="foot-col">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#about">About QFS</a></li>
                    <li><a href="#" onclick="openM('register');return false;">Register</a></li>
                    <li><a href="#" onclick="openM('login');return false;">Login</a></li>
                    <li><a href="#faq">FAQ</a></li>
                    <li><a href="#flare">The Flare Network</a></li>
                </ul>
            </div>
            <div class="foot-col">
                <h4>Our Services</h4>
                <ul>
                    <li><a href="#">Digital Currency Protection</a></li>
                    <li><a href="#">Wallet Security System</a></li>
                    <li><a href="#">Banking at Your Fingertips</a></li>
                    <li><a href="#">Gift Card Trading</a></li>
                    <li><a href="#">Send & Receive Crypto</a></li>
                </ul>
            </div>
            <div class="foot-col">
                <h4>Contacts</h4>
                <ul>
                    <li><a href="mailto:support@qfsworld.com">Email: support@qfsworld.com</a></li>
                    <li><a href="mailto:support@qfsworld.com">Support: support@qfsworld.com</a></li>
                    <li><a href="https://www.youtube.com/channel/UCHACcQVpw_p0n03zZdSt4fg/videos"
                            target="_blank">YouTube: XRPQFSTeam1</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>
        </div>
        <div class="foot-bottom">
            <span>Copyright ©2018–2026 @ QFSWORLD. All Rights Reserved.</span>
            <span>support@qfsworld.com</span>
        </div>
    </footer>

    <!-- Scroll to top -->
    <button id="stb" onclick="window.scrollTo({top:0,behavior:'smooth'})">↑</button>



    <!-- ════════════════════ SCRIPTS ════════════════════ -->
    <script>
        // HERO SLIDER
        let cur = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.sdot');
        let timer = setInterval(() => chSlide(1), 5500);

        function goSlide(n) {
            slides[cur].classList.remove('on');
            dots[cur].classList.remove('on');
            cur = n;
            slides[cur].classList.add('on');
            dots[cur].classList.add('on');
        }

        function chSlide(d) {
            clearInterval(timer);
            goSlide((cur + d + slides.length) % slides.length);
            timer = setInterval(() => chSlide(1), 5500);
        }

        // MODALS
        function openM(t) {
            document.getElementById('modal-' + t).classList.add('show');
        }

        function closeM(t) {
            document.getElementById('modal-' + t).classList.remove('show');
        }

        function swM(a, b) {
            closeM(a);
            setTimeout(() => openM(b), 240);
        }
        document.querySelectorAll('.overlay').forEach(o => o.addEventListener('click', function(e) {
            if (e.target === this) this.classList.remove('show');
        }));
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') document.querySelectorAll('.overlay.show').forEach(m => m.classList.remove(
                'show'));
        });

        // FAQ
        function tFaq(el) {
            const item = el.parentElement,
                isOpen = item.classList.contains('open');
            document.querySelectorAll('.faq-item').forEach(i => {
                i.classList.remove('open');
                i.querySelector('.faq-icon').textContent = '+';
            });
            if (!isOpen) {
                item.classList.add('open');
                item.querySelector('.faq-icon').textContent = '−';
            }
        }
        const fo = document.querySelector('.faq-item.open .faq-icon');
        if (fo) fo.textContent = '−';

        // SCROLL TOP
        const stb = document.getElementById('stb');
        window.addEventListener('scroll', () => stb.classList.toggle('on', window.scrollY > 500));
        // Form submission handling
        document.querySelectorAll('.contact-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const btn = this.querySelector('button');
                const status = this.querySelector('.form-status');
                const originalBtnContent = btn.innerHTML;
                
                btn.disabled = true;
                btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Sending...';
                status.classList.remove('hidden', 'text-red-500', 'text-green-500');
                status.innerHTML = '';

                fetch('{{ route("contact-submit") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: new FormData(this)
                })
                .then(response => response.json())
                .then(data => {
                    btn.innerHTML = originalBtnContent;
                    btn.disabled = false;
                    status.classList.remove('hidden');
                    if (data.status === 'success') {
                        status.classList.add('text-green-500');
                        status.innerHTML = data.message;
                        form.reset();
                    } else {
                        status.classList.add('text-red-500');
                        status.innerHTML = 'Something went wrong. Please try again.';
                    }
                })
                .catch(error => {
                    btn.innerHTML = originalBtnContent;
                    btn.disabled = false;
                    status.classList.remove('hidden');
                    status.classList.add('text-red-500');
                    status.innerHTML = 'Failed to connect. Please check your internet.';
                });
            });
        });
    </script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/69c5ab7a92329d1c3229c49e/1jkm2bm2t';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
    <script>
        // Theme toggle logic
        const lpThemeToggle = document.getElementById('lpThemeToggle');
        const icon = lpThemeToggle.querySelector('i');
        
        function updateTheme(isDark) {
            if (isDark) {
                document.documentElement.classList.add('dark');
                icon.className = 'fas fa-sun';
            } else {
                document.documentElement.classList.remove('dark');
                icon.className = 'fas fa-moon';
            }
        }

        lpThemeToggle.addEventListener('click', () => {
            const isDark = !document.documentElement.classList.contains('dark');
            updateTheme(isDark);
            localStorage.setItem('darkMode', isDark ? 'enabled' : 'disabled');
        });

        // Initialize theme
        const savedTheme = localStorage.getItem('darkMode');
        if (savedTheme === 'enabled' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            updateTheme(true);
        }
    </script>
</body>

</html>
