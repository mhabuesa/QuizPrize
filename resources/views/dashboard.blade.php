<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=SolaimanLipi&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <style>
        /* =========================
       FONT
    ========================= */
        @import url('https://fonts.googleapis.com/css2?family=SolaimanLipi&display=swap');

        * {
            font-family: 'SolaimanLipi', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            min-height: 100vh;
            overflow: hidden;
        }

        /* =========================
       PARTICLES
    ========================= */
        .particle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh);
                opacity: 0;
            }

            10%,
            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100vh);
                opacity: 0;
            }
        }

        /* =========================
       BUTTON GLOW
    ========================= */
        .button-glow {
            box-shadow:
                0 0 20px rgba(0, 255, 170, 0.7),
                0 0 40px rgba(0, 200, 120, 0.6),
                0 0 80px rgba(0, 255, 200, 0.5);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            50% {
                box-shadow:
                    0 0 30px rgba(0, 255, 170, 1),
                    0 0 60px rgba(0, 200, 120, 0.9),
                    0 0 120px rgba(0, 255, 200, 0.8);
            }
        }

        /* =========================
       NUMBER SHUFFLE
    ========================= */
        .number-shuffle {
            font-size: 3rem;
            font-weight: bold;
            background: linear-gradient(45deg, #00ffcc, #00ff88, #aaffaa, #00ffaa);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shake 0.1s infinite, gradient 2s ease infinite;
        }

        @keyframes shake {
            0% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            50% {
                transform: translateX(5px);
            }

            75% {
                transform: translateX(-5px);
            }

            100% {
                transform: translateX(0);
            }
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* =========================
       LINK CARD ANIMATION
    ========================= */
        .link-card {
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.9);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* =========================
       RIPPLE EFFECT
    ========================= */
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple-effect 0.6s ease-out;
            pointer-events: none;
        }

        @keyframes ripple-effect {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* =========================
       HEADINGS
    ========================= */
        h1 {
            font-weight: bold;
            line-height: 1.2;
        }

        h2 {
            font-weight: bold;
            line-height: 1.3;
        }

        /* =========================
       RESPONSIVE TEXT
    ========================= */
        .text-responsive-xl {
            font-size: 1.25rem;
            /* small base */
        }

        @media (min-width: 640px) {
            .text-responsive-xl {
                font-size: 1.5rem;
            }
        }

        @media (min-width: 768px) {
            .text-responsive-xl {
                font-size: 1.75rem;
            }
        }

        @media (min-width: 1024px) {
            .text-responsive-xl {
                font-size: 2rem;
            }
        }

        @media (min-width: 1280px) {
            .text-responsive-xl {
                font-size: 2.25rem;
            }
        }

        .text-responsive-lg {
            font-size: 0.9rem;
        }

        @media (min-width: 640px) {
            .text-responsive-lg {
                font-size: 1rem;
            }
        }

        @media (min-width: 768px) {
            .text-responsive-lg {
                font-size: 1.25rem;
            }
        }

        @media (min-width: 1024px) {
            .text-responsive-lg {
                font-size: 1.5rem;
            }
        }

        @media (min-width: 1280px) {
            .text-responsive-lg {
                font-size: 1.75rem;
            }
        }
    </style>

</head>

<body class="flex items-center justify-center">

    <div id="particles"></div>

    <div class="relative z-10 text-center">

        <div id="headerText">
            <p class="text-white/80 text-xl mb-4">
                লাইলাতুল ই'লান শরীফ উপলক্ষে আয়োজিত বিশেষ প্রতিযোগিতা</p>
            <h2 class="text-white text-3xl md:text-3xl font-bold mb-4 ">
                পুরুষ্কার প্রস্তুত!
            </h2>
            <p class="text-white/80 text-xl mb-12">
                কাঙ্ক্ষিত পুরুষ্কারটি লটারির মাধ্যমে নিশ্চিত করুন। </p>
        </div>

        <!-- GREEN BUTTON -->
        <div id="buttonContainer" class="mb-8">
            <!-- BUTTON WITH CIRCULAR PROGRESS -->
            <div id="buttonContainer" class="mb-8 relative w-64 h-64 md:w-80 md:h-80 mx-auto">
                <button id="mainButton"
                    class="w-full h-full rounded-full
        bg-gradient-to-br from-green-400 via-emerald-500 to-cyan-500
        text-white text-2xl md:text-4xl font-bold shadow-2xl
        transition-all duration-300 hover:scale-110 active:scale-95
        button-glow relative overflow-hidden flex items-center justify-center">
                    <span id="buttonText">চাপুন</span>

                    <!-- circular progress overlay -->
                    <svg id="progressCircle" class="absolute top-0 left-0 w-full h-full transform -rotate-90"
                        viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="45" stroke="rgba(255,255,255,0.3)" stroke-width="10"
                            fill="none" />
                        <circle cx="50" cy="50" r="45" stroke="#fff" stroke-width="10" fill="none"
                            stroke-dasharray="282.6" stroke-dashoffset="282.6" />
                    </svg>
                </button>
            </div>

        </div>

        <!-- RESULT -->
        <div id="linkContainer" class="hidden">
            <div
                class="link-card bg-black/30 backdrop-blur-xl border border-white/10 rounded-3xl p-10 shadow-2xl max-w-xl mx-auto">
                <h2 class="text-white text-3xl font-bold mb-4">✨🌙 মুবারকবাদ! 🌙✨!</h2>
                <p class="text-white/80 mb-6">লাইলাতুল ই’লান শরীফ উপলক্ষে আয়োজিত অনলাইন ফাল-ইয়াফরাহু প্রতিযোগিতায় -
                    <span class="block"> 🌸 আপনি সু-নছীবের সঙ্গে উত্তীর্ণ হয়েছেন। 🌸</span>
                </p>
                <p class="text-white/80 mb-6">🤍 খলীফাজী-মুজীরাজী আপনাকে অনন্তকালের জন্য কবুল করুন। আমীন।</p>
                <p class="text-white/80 mb-6">🎁✨ আপনার জন্য আমাদের পক্ষ থেকে বিশেষ উপহার ✨🎁</p>

                <a id="generatedLink" href="#"
                    class="inline-block bg-gradient-to-r from-green-400 to-emerald-500
   text-white font-bold py-4 px-10 rounded-full text-lg
   shadow-lg transition-all hover:scale-105">
                    লিংকে যান →
                </a>

            </div>
        </div>

    </div>

    <script>
        /* =========================
           PARTICLES
        ========================= */
        function createParticles() {
            const p = document.getElementById('particles');
            for (let i = 0; i < 50; i++) {
                const d = document.createElement('div');
                d.className = 'particle';
                d.style.width = d.style.height = Math.random() * 8 + 4 + 'px';
                d.style.left = Math.random() * 100 + '%';
                d.style.background = 'rgba(255,255,255,0.5)';
                d.style.animation = `float ${Math.random() * 10 + 10}s linear infinite`;
                p.appendChild(d);
            }
        }
        createParticles();

        /* =========================
           ELEMENTS
        ========================= */
        const mainButton = document.getElementById('mainButton');
        const buttonText = document.getElementById('buttonText');
        const progressCircle = document.querySelector('#progressCircle circle:nth-child(2)');
        const buttonContainer = document.getElementById('buttonContainer');
        const linkContainer = document.getElementById('linkContainer');
        const headerText = document.getElementById('headerText');
        const generatedLink = document.getElementById('generatedLink');

        /* =========================
           CONSTANTS
        ========================= */
        const TOTAL_TIME = 9000; // 9 seconds
        const FULL_OFFSET = 282.6;

        /* =========================
           STATE
        ========================= */
        let backendResponse = null;
        let spinning = false;

        /* =========================
           RIPPLE EFFECT
        ========================= */
        function createRipple(e) {
            const ripple = document.createElement('span');
            ripple.className = 'ripple';

            const rect = mainButton.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);

            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = e.clientX - rect.left - size / 2 + 'px';
            ripple.style.top = e.clientY - rect.top - size / 2 + 'px';

            mainButton.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        }

        /* =========================
           DEVICE FINGERPRINT
        ========================= */
        function getDeviceFingerprint() {
            return btoa([
                navigator.userAgent,
                screen.width,
                screen.height,
                screen.colorDepth,
                navigator.language,
                navigator.platform
            ].join('||'));
        }

        /* =========================
           SPINNER (9 sec fixed)
        ========================= */
        function startSpinner() {
            const start = performance.now();
            spinning = true;

            function animate(now) {
                if (!spinning) return;

                const elapsed = now - start;
                const progress = Math.min(elapsed / TOTAL_TIME, 1);

                progressCircle.style.strokeDashoffset =
                    FULL_OFFSET - FULL_OFFSET * progress;

                if (elapsed < TOTAL_TIME) {
                    requestAnimationFrame(animate);
                } else {
                    spinning = false;
                    progressCircle.style.strokeDashoffset = 0;
                    finishFlow();
                }
            }

            requestAnimationFrame(animate);
        }

        /* =========================
           BUTTON CLICK
        ========================= */
        mainButton.addEventListener('click', function(e) {
            createRipple(e);
            backendResponse = null;

            buttonText.textContent = 'প্রস্তুত হচ্ছে...';
            progressCircle.style.strokeDashoffset = FULL_OFFSET;

            startSpinner();

            setTimeout(() => buttonText.textContent = 'লটারি হচ্ছে...', 3000);
            setTimeout(() => buttonText.textContent = 'আর কিছুক্ষণ...', 6000);

            fetchReward(getDeviceFingerprint());
        });

        /* =========================
           FETCH BACKEND
        ========================= */
        function fetchReward(device_id) {
            fetch('/quiz/shuffle', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: new URLSearchParams({
                        device_id
                    })
                })
                .then(res => {
                    if (!res.ok) throw new Error('Server error');
                    return res.json();
                })
                .then(data => {
                    backendResponse = data;
                })
                .catch(err => {
                    console.error(err);
                    alert('Server error');
                    resetButton();
                });
        }


        /* =========================
           FINISH FLOW
        ========================= */
        function finishFlow() {
            if (!backendResponse) {
                alert('Server slow, আবার চেষ্টা করুন');
                resetButton();
                return;
            }

            showResult(backendResponse.link, backendResponse.name);
        }

        /* =========================
           SHOW RESULT
        ========================= */
        function showResult(link, name) {
            buttonContainer.classList.add('hidden');
            headerText.classList.add('hidden');
            linkContainer.classList.remove('hidden');

            generatedLink.href = link;
            generatedLink.setAttribute('download', name);
        }

        /* =========================
           RESET
        ========================= */
        function resetButton() {
            spinning = false;
            buttonText.textContent = 'চাপুন';
            progressCircle.style.strokeDashoffset = FULL_OFFSET;
        }
    </script>








</body>

</html>
