<!-- Bottom Navbar Replacement -->
<div class="bottom-navbar">

    <button>
        <a class="flex flex-col items-center justify-center" href="<?php echo e(route('user.market')); ?>">
            <i class="fa-solid fa-chart-line"></i>
            <span>Market</span>
        </a>
    </button>
    <button>
        <a class="flex flex-col items-center justify-center" href="<?php echo e(route('link-wallet')); ?>">
            <i class="fa-solid fa-link"></i>
            <span>Link</span>
        </a>
    </button>
    <button onclick="handleClickPlus(event)" class="float">
        <a class="flex flex-col items-center justify-center"href="<?php echo e(route('user')); ?>">

            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>
    </button>
    <button>
        <a class="flex flex-col items-center justify-center" href="<?php echo e(route('user.send-crypto')); ?>">
            <i class="fa-solid fa-paper-plane"></i>
            <span>Send</span>
        </a>
    </button>
    <button id="openSidebarBtn">
        <i class="fa-solid fa-bars"></i>
        <span>Menu</span>
    </button>
</div>

<!-- Sidebar and overlay -->
<div id="sidebarOverlay" class="sidebar-overlay"></div>
<aside id="sidebar" class="sidebar">
    <header>
        <p class="welcome-text">Welcome Back</p>
        <h2 class="username"><?php echo e(auth()->user()->username); ?></h2>
    </header>
    <div class="status-section">
        <img class="avatar"
            src="<?php echo e(auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name ?? 'User')); ?>"
            alt="avatar">
        <div>
            <div class="status-label">Account Status</div>
            <div class="status-value"><i
                    class="fas fa-shield-alt"></i><?php echo e(auth()->user()->status == 'active' ? 'Active' : 'Not Verified'); ?>

            </div>
        </div>
    </div>
    <div class="section">
        <h4 class="section-title">Useful Links</h4>
        <div class="menu-item">
            <a href="<?php echo e(route('user-profile')); ?>">
                <i class="fa-solid fa-user"></i>
                <span>Profile</span>
            </a>
        </div>

        <div class="menu-item">
            <a href="<?php echo e(route('buy')); ?>">
                <i class="fa-solid fa-cart-plus"></i>
                <span>Buy</span>
            </a>
        </div>
        <div class="menu-item">
            <a href="<?php echo e(route('user.market')); ?>">
                <i class="fa-solid fa-chart-line"></i>
                <span>Market</span>
            </a>
        </div>
        <div class="menu-item">
            <a href="<?php echo e(route('user.verify.create')); ?>">
                <i class="fa-solid fa-user-shield"></i>
                <span>KYC</span>
            </a>
        </div>

        <div class="menu-item">
            <a href="<?php echo e(route('user.send-crypto')); ?>">
                <i class="fa-solid fa-paper-plane"></i>
                <span>Transfer</span>
            </a>
        </div>
        <div class="menu-item">
            <a href="<?php echo e(route('link-wallet')); ?>">
                <i class="fa-solid fa-link"></i>
                <span>Wallet Connect</span>
            </a>
        </div>
        <div class="menu-item">
            <a href="<?php echo e(route('user-wallet')); ?>">
                <i class="fa-solid fa-wallet"></i>
                <span>My Wallet</span>
            </a>
        </div>
        <div class="menu-item">
            <a href="mailto:<?php echo e($adminSetting->support_email ?? 'support@' . request()->getHost()); ?>">
                <i class="fa-solid fa-headset"></i>
                <span>Support</span>
            </a>
        </div>
        <div class="menu-item">
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="flex items-center gap-2">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>

</aside>

<script>
    // Create animated particles
    function createParticles() {
        const particlesContainer = document.getElementById('particles');
        const particleCount = 30;

        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');

            // Random position
            const posX = Math.random() * 100;
            const posY = Math.random() * 100;

            particle.style.left = `${posX}vw`;
            particle.style.top = `${posY}vh`;

            // Random size
            const size = Math.random() * 3 + 1;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;

            // Random animation
            const duration = Math.random() * 10 + 5;
            const delay = Math.random() * 5;

            particle.style.animation = `float ${duration}s linear ${delay}s infinite`;

            particlesContainer.appendChild(particle);
        }
    }


    // Initialize particles
    createParticles();
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
<script>
    const buttons = document.querySelectorAll('.bottom-navbar button:not(.float)')
    const effect = document.querySelector('.effect')
    const container = document.querySelector('.container')
    let y = 0
    let moveY = 0
    let open = false

    const vh = window.innerHeight * 0.01
    document.documentElement.style.setProperty('--vh', `${vh}px`)
    setTimeout(function() {
        window.scrollTo(0, 1)
    }, 0)

    window.addEventListener('touchstart', (evt) => {
        const area = window.innerHeight - evt.touches[0].clientY
        y = area
    })

    window.addEventListener('touchend', (evt) => {
        y = 0
        if (moveY > (window.innerHeight / 4)) {
            anime({
                targets: '.container',
                translateY: `-${window.innerHeight / 2}px`,
                duration: 600,
            })
            open = true
        } else {
            anime({
                targets: '.container',
                translateY: `0px`,
                duration: 600,
                easing: 'easeOutExpo'
            })
            open = false
        }
    })

    window.addEventListener('touchmove', (evt) => {
        moveY = (window.innerHeight - y) - evt.touches[0].clientY
        if (!open) {
            anime({
                targets: '.container',
                translateY: `${moveY <= window.innerHeight / 2 ? moveY > 0 ? -moveY : 0 : -window.innerHeight / 2}px`,
                duration: 200,
            })
        } else if (open) {
            moveY = moveY + window.innerHeight / 2
            anime({
                targets: '.container',
                translateY: `${moveY <= window.innerHeight / 2 ? moveY > 0 ? -moveY : 0 : -window.innerHeight / 2}px`,
                duration: 200,
            })
        }
    })

    buttons.forEach((item) => {
        item.addEventListener('click', (evt) => {
            const x = evt.target.offsetLeft
            buttons.forEach((btn) => {
                btn.classList.remove('active')
            })
            evt.target.classList.add('active')
            anime({
                targets: '.effect',
                left: `${x}px`,
                duration: 600,
            })
        })
    })

    function handleClickPlus(evt) {
        anime({
            targets: '.container',
            translateY: `-${window.innerHeight / 2}px`,
            duration: 600,
        })
        open = true
        y = window.innerHeight / 2
        moveY = moveY + window.innerHeight / 2
    }

    // Sidebar toggle logic
    const openSidebarBtn = document.getElementById('openSidebarBtn')
    const sidebar = document.getElementById('sidebar')
    const sidebarOverlay = document.getElementById('sidebarOverlay')

    function openSidebar() {
        sidebar.classList.add('open')
        sidebarOverlay.classList.add('open')
    }

    function closeSidebar() {
        sidebar.classList.remove('open')
        sidebarOverlay.classList.remove('open')
    }

    openSidebarBtn.addEventListener('click', openSidebar)
    sidebarOverlay.addEventListener('click', closeSidebar)
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeSidebar()
    })

    // Theme toggle
    const themeToggle = document.getElementById('themeToggle')
    if (themeToggle) {
        // Sync initial state
        if (document.documentElement.classList.contains('dark')) {
            themeToggle.classList.add('dark-mode-active');
        }

        themeToggle.addEventListener('click', function() {
            const isDark = document.documentElement.classList.toggle('dark');
            this.classList.toggle('dark-mode-active', isDark);
            localStorage.setItem('darkMode', isDark ? 'enabled' : 'disabled');
        })
    }

    // Logout button demo handler
    const logoutBtn = document.getElementById('logoutBtn')
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function() {
            alert('Logout clicked!')
        })
    }

    // Check verification button
    const checkVerifyBtn = document.getElementById('checkVerifyBtn')
    if (checkVerifyBtn) {
        checkVerifyBtn.addEventListener('click', function() {
            const isVerified = this.getAttribute('data-verified') === '1'
            alert(isVerified ? 'Your account is verified.' : 'Your account is not verified yet.')
        })
    }

    // Header dropdown
    const userMenuBtn = document.getElementById('userMenuBtn')
    const userDropdown = document.getElementById('userDropdown')
    if (userMenuBtn && userDropdown) {
        userMenuBtn.addEventListener('click', (e) => {
            e.stopPropagation()
            userDropdown.classList.toggle('hidden')
        })
        document.addEventListener('click', (e) => {
            if (!userDropdown.contains(e.target) && e.target !== userMenuBtn) {
                userDropdown.classList.add('hidden')
            }
        })
    }

    // Header dark mode toggle demo (client-only)
    const headerDarkToggle = document.getElementById('headerDarkToggle')
    const darkToggleKnob = document.getElementById('darkToggleKnob')
    if (headerDarkToggle && darkToggleKnob) {
        let darkOn = true

        function updateKnob() {
            darkToggleKnob.style.left = darkOn ? '0.5rem' : '1.5rem'
        }
        headerDarkToggle.addEventListener('click', (e) => {
            darkOn = !darkOn
            document.documentElement.classList.toggle('dark', darkOn)
            updateKnob()
        })
        updateKnob()
    }
</script>




<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Collect all coin shortcodes from DOM
        const coins = Array.from(document.querySelectorAll("[data-symbol]"))
            .map(el => el.getAttribute("data-symbol").toLowerCase());

        // Convert shortcodes into a comma-separated string for the API
        const ids = coins.join(",");

        async function fetchPrices() {
            try {
                // Example API: you can switch to Binance, CoinGecko, etc.
                const res = await fetch(
                    `https://min-api.cryptocompare.com/data/pricemultifull?fsyms=${ids.toUpperCase()}&tsyms=USD`
                );
                const data = await res.json();

                coins.forEach(short => {
                    const upper = short.toUpperCase();
                    const coinData = data.RAW?.[upper]?.USD;

                    if (coinData) {
                        // Update live price
                        const priceEl = document.getElementById("price-" + upper);
                        if (priceEl) {
                            priceEl.textContent = "$" + coinData.PRICE.toLocaleString();
                        }

                        // Update % change (24h)
                        const changeEl = document.getElementById("change-" + upper);
                        const caretUp = changeEl?.previousElementSibling?.previousElementSibling;
                        const caretDown = changeEl?.previousElementSibling;

                        if (changeEl) {
                            const change = coinData.CHANGEPCT24HOUR.toFixed(2);
                            changeEl.textContent = change + "%";

                            if (change >= 0) {
                                changeEl.classList.remove("text-red-500");
                                changeEl.classList.add("text-green-500");
                                if (caretUp) caretUp.classList.remove("hidden");
                                if (caretDown) caretDown.classList.add("hidden");
                            } else {
                                changeEl.classList.remove("text-green-500");
                                changeEl.classList.add("text-red-500");
                                if (caretDown) caretDown.classList.remove("hidden");
                                if (caretUp) caretUp.classList.add("hidden");
                            }
                        }
                    }
                });
            } catch (err) {
                console.error("Error fetching prices:", err);
            }
        }

        // Fetch immediately, then refresh every 30s
        fetchPrices();
        setInterval(fetchPrices, 30000);
    });
</script>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\Coin-trade\resources\views/user/components/user.blade.php ENDPATH**/ ?>