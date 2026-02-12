<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wow Food | Bareilly's Finest</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <style>
        html { scroll-behavior: smooth; }

        /* --- 1. Pre-loader & Special Animations --- */
        #preloader { transition: opacity 0.8s ease; }
        .loader-hide { opacity: 0 !important; pointer-events: none; }
        
        @keyframes bounce-gentle { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }
        .whatsapp-float { animation: bounce-gentle 2s infinite ease-in-out; }

        /* --- 2. Button & Hover Effects --- */
        .category-btn.active { 
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important; 
            color: white !important; border: none !important;
            box-shadow: 0 10px 15px -3px rgba(239, 68, 68, 0.4);
            animation: pulse-red 2s infinite;
        }

        @keyframes pulse-red {
            0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); }
            100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
        }

        .category-btn { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden; }
        @keyframes slowZoom { 0% { transform: scale(1); } 100% { transform: scale(1.15); } }
        .animate-slow-zoom { animation: slowZoom 20s linear infinite alternate; }
        .food-card { transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .food-card:hover { transform: translateY(-10px) scale(1.02); box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1); }
        .food-card img { transition: transform 0.5s ease; }
        .food-card:hover img { transform: scale(1.08) rotate(2deg); }

        .reveal-item { animation: fadeInUp 0.6s ease forwards; opacity: 0; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }

        /* Social Proof Style */
        #social-proof { position: fixed; bottom: 100px; left: 20px; z-index: 90; display: none; }
        @keyframes slide-up-proof { from { opacity: 0; transform: translateY(50px); } to { opacity: 1; transform: translateY(0); } }
        .animate-proof { animation: slide-up-proof 0.5s ease forwards; }

        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-gray-50 font-sans overflow-x-hidden text-gray-900">

    <div id="preloader" class="fixed inset-0 z-[500] bg-white flex flex-col items-center justify-center">
        <div class="w-16 h-16 border-4 border-gray-100 border-t-red-600 rounded-full animate-spin mb-4"></div>
        <p class="text-gray-400 font-bold italic tracking-tighter animate-pulse">Bareilly ka swaad pack ho raha hai...</p>
    </div>

    <div id="auth-modal" class="fixed inset-0 z-[400] flex items-center justify-center hidden p-4">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-md" onclick="toggleAuth()"></div>
        <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl relative z-10 overflow-hidden reveal-item">
            <div class="flex border-b border-gray-100">
                <button onclick="switchTab('login')" id="login-tab" class="w-1/2 py-6 font-black italic text-sm tracking-tighter border-b-4 border-red-600 text-red-600 bg-white">LOGIN</button>
                <button onclick="switchTab('signup')" id="signup-tab" class="w-1/2 py-6 font-black italic text-sm tracking-tighter border-b-4 border-transparent text-gray-400 hover:text-gray-600">SIGNUP</button>
            </div>
            <div class="p-10">
                <form id="login-form" action="login_process.php" method="POST" class="space-y-4">
                    <h3 class="text-2xl font-black italic tracking-tighter mb-6">Welcome Back!</h3>
                    <input type="email" name="email" placeholder="Email Address" required class="w-full p-4 rounded-2xl bg-gray-50 border border-gray-100 outline-none focus:border-red-600 transition text-sm font-medium">
                    <input type="password" name="password" placeholder="Password" required class="w-full p-4 rounded-2xl bg-gray-50 border border-gray-100 outline-none focus:border-red-600 transition text-sm font-medium">
                   
                    <button type="submit" class="w-full bg-red-600 text-white py-4 rounded-2xl font-black shadow-lg hover:bg-black transition active:scale-95 text-sm tracking-widest uppercase mt-4">Login to Wow</button>
                </form>
                <form id="signup-form" action="signup_process.php" method="POST" class="space-y-4 hidden">
                    <h3 class="text-2xl font-black italic tracking-tighter mb-6">Join the Tribe</h3>
                    <input type="text" name="full_name" placeholder="Full Name" required class="w-full p-4 rounded-2xl bg-gray-50 border border-gray-100 outline-none focus:border-red-600 transition text-sm font-medium">
                    <input type="email" name="email" placeholder="Email Address" required class="w-full p-4 rounded-2xl bg-gray-50 border border-gray-100 outline-none focus:border-red-600 transition text-sm font-medium">
                    <input type="password" name="password" placeholder="Create Password" required class="w-full p-4 rounded-2xl bg-gray-50 border border-gray-100 outline-none focus:border-red-600 transition text-sm font-medium">
                     <input type="text" name="phone" placeholder="Phone Number" required class="w-full p-4 rounded-2xl bg-gray-50 border border-gray-100 outline-none focus:border-red-600 transition text-sm font-medium">
                    <button type="submit" class="w-full bg-red-600 text-white py-4 rounded-2xl font-black shadow-lg hover:bg-black transition active:scale-95 text-sm tracking-widest uppercase mt-4">Create Account</button>
                </form>
            </div>
        </div>
    </div>

    <nav class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-50 p-4 border-b border-gray-100">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="logo-text text-2xl font-black text-red-600 italic cursor-pointer tracking-tighter" window.location.href='index.php';>WOW FOOD</h1>
            <div class="flex items-center space-x-6">
                <?php if(isset($_SESSION['user_id'])): ?>
  <div class="flex items-center gap-3">
    <span class="text-sm font-bold text-gray-700">
      Hi, <?php echo htmlspecialchars($_SESSION['full_name']); ?>
    </span>
    <a href="logout.php" class="bg-gray-900 text-white px-6 py-2 rounded-full font-bold hover:bg-red-600 transition shadow-md text-sm">
      Logout
    </a>
    <a href="my_orders.php" class="bg-white border px-6 py-2 rounded-full font-bold hover:bg-gray-100 transition shadow-md text-sm">
  My Orders
</a>

  </div>
<?php else: ?>
  <button onclick="toggleAuth()" class="bg-gray-900 text-white px-6 py-2 rounded-full font-bold hover:bg-red-600 transition shadow-md text-sm">
    Login
  </button>
<?php endif; ?>


                <div class="relative cursor-pointer group" onclick="toggleCart()">
                    <i class="fa-solid fa-basket-shopping text-2xl text-gray-700 group-hover:text-red-600 transition"></i>
                    <span id="cart-count" class="absolute -top-2 -right-2 bg-red-600 text-white text-[10px] rounded-full h-5 w-5 flex items-center justify-center font-bold border-2 border-white">0</span>
                </div>
            </div>
        </div>
    </nav>

    <section class="relative h-[65vh] flex items-center justify-center overflow-hidden bg-black">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1600" class="w-full h-full object-cover opacity-60 animate-slow-zoom">
            <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-black/40 to-gray-50"></div>
        </div>
        <div class="relative z-10 text-center px-4 reveal-item">
            <span class="text-yellow-400 font-bold tracking-[0.4em] uppercase text-[10px] mb-3 block">Bareilly's Most Loved</span>
            <h2 class="text-6xl md:text-8xl font-black text-white italic tracking-tighter mb-4 uppercase">EAT THE <span class="text-red-600">WOW</span></h2>
            <p class="text-white/90 text-sm md:text-lg max-w-xl mx-auto font-medium leading-relaxed mb-8 leading-tight">Ab swaad hi bolega. Authentic flavors crafted with passion.</p>
            <div class="flex gap-4 justify-center">
                <a href="#food-container" class="bg-red-600 text-white px-8 py-4 rounded-full font-bold hover:bg-white hover:text-red-600 transition-all uppercase text-xs shadow-2xl">Order Now</a>
                <a href="#our-story" class="border-2 border-white/50 text-white px-8 py-4 rounded-full font-bold hover:bg-white/10 transition-all uppercase text-xs">Our Story</a>
            </div>
        </div>
    </section>

    <div class="bg-white border-y border-gray-100 py-8">
        <div class="container mx-auto flex flex-wrap justify-around gap-8 px-4 text-center">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-red-50 rounded-full flex items-center justify-center text-red-600 text-xl shadow-inner"><i class="fa-solid fa-bolt-lightning"></i></div>
                <div class="text-left"><p class="font-bold text-sm leading-none">Super Fast</p><p class="text-[10px] text-gray-400 uppercase mt-1">30 Min Delivery</p></div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-green-50 rounded-full flex items-center justify-center text-green-600 text-xl shadow-inner"><i class="fa-solid fa-leaf"></i></div>
                <div class="text-left"><p class="font-bold text-sm leading-none">100% Fresh</p><p class="text-[10px] text-gray-400 uppercase mt-1">Bareilly Sourced</p></div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-yellow-50 rounded-full flex items-center justify-center text-yellow-600 text-xl shadow-inner"><i class="fa-solid fa-hand-holding-heart"></i></div>
                <div class="text-left"><p class="font-bold text-sm leading-none">Home Style</p><p class="text-[10px] text-gray-400 uppercase mt-1">By Aarif  & Team</p></div>
            </div>
        </div>
    </div>

    <section id="our-story" class="container mx-auto py-24 px-4 overflow-hidden">
        <div class="flex flex-col md:flex-row items-center gap-16">
            <div class="w-full md:w-1/2 relative group reveal-item">
                <div class="relative z-10 rounded-[2rem] overflow-hidden shadow-2xl rotate-3 group-hover:rotate-0 transition duration-500">
                    <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?w=800" class="w-full h-[450px] object-cover">
                </div>
                <div class="absolute -bottom-6 -right-6 w-full h-full border-4 border-yellow-400 rounded-[2rem] -z-10"></div>
            </div>
            <div class="w-full md:w-1/2 reveal-item">
                <span class="text-red-600 font-bold tracking-[0.3em] uppercase text-xs mb-4 block">The Heart of Bareilly</span>
                <h2 class="text-4xl md:text-5xl font-black italic mb-8 tracking-tighter leading-tight">Hume Pata Hai <br> <span class="text-gray-400 underline decoration-yellow-400 underline-offset-8">Swaad Kya Hota Hai.</span></h2>
                <p class="text-gray-600 leading-relaxed text-lg italic">Aarif and Hamari Team ne milkar ye mission liya ki hum Bareilly ko sirf khana nahi, balki ek <span class="text-red-600 font-bold">Experience</span> denge. Har bite mein wahi apnapan aur wahi purana swaad.</p>
            </div>
        </div>
    </section>

    <section class="container mx-auto py-12 px-4">
        <div class="bg-gray-900 rounded-[3rem] p-8 md:p-12 text-center relative overflow-hidden shadow-2xl">
            <div class="relative z-10">
                <span class="text-red-500 font-bold uppercase text-[10px] tracking-[0.3em] mb-4 block">Confused kya khayein?</span>
                <h2 class="text-3xl md:text-4xl font-black text-white italic mb-8 tracking-tighter uppercase">Aapka Mood <span class="text-gray-400">Hamara Swaad</span></h2>
                <div class="flex flex-wrap justify-center gap-4">
                    <button onclick="recommendByMood('party')" class="bg-white/10 hover:bg-red-600 text-white px-6 py-4 rounded-2xl transition-all duration-300 group border border-white/10">
                        <div class="text-2xl mb-1 group-hover:scale-125 transition">🥳</div>
                        <p class="text-[10px] font-bold uppercase tracking-widest">Party Mood</p>
                    </button>
                    <button onclick="recommendByMood('low')" class="bg-white/10 hover:bg-blue-500 text-white px-6 py-4 rounded-2xl transition-all duration-300 group border border-white/10">
                        <div class="text-2xl mb-1 group-hover:scale-125 transition">😌</div>
                        <p class="text-[10px] font-bold uppercase tracking-widest">Chill/Low</p>
                    </button>
                    <button onclick="recommendByMood('hungry')" class="bg-white/10 hover:bg-orange-500 text-white px-6 py-4 rounded-2xl transition-all duration-300 group border border-white/10">
                        <div class="text-2xl mb-1 group-hover:scale-125 transition">🦁</div>
                        <p class="text-[10px] font-bold uppercase tracking-widest">Bohat Bhook</p>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto py-16 px-4">
        <div class="flex justify-center space-x-4 mb-16 overflow-x-auto pb-4 no-scrollbar">
            <button onclick="filterCategory('all')" class="category-btn active px-10 py-3 rounded-full font-bold border-2 text-sm">All Dishes</button>
            <button onclick="filterCategory('veg')" class="category-btn px-10 py-3 rounded-full font-bold border-2 bg-white text-sm">Veg & Drinks</button>
            <button onclick="filterCategory('non-veg')" class="category-btn px-10 py-3 rounded-full font-bold border-2 bg-white text-sm">Non-Veg</button>
        </div>
        <div id="food-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10"></div>
    </section>

    <section class="bg-gray-100 py-24 px-4 overflow-hidden">
        <div class="container mx-auto">
            <div class="text-center mb-16 reveal-item">
                <span class="text-red-600 font-bold tracking-[0.3em] uppercase text-xs mb-3 block">Real Experiences</span>
                <h2 class="text-4xl md:text-5xl font-black italic tracking-tighter text-center">What Our <span class="text-gray-400">Foodies Say</span></h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-[2rem] shadow-sm food-card reveal-item">
                    <div class="flex text-yellow-400 mb-4 text-xs"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                    <p class="text-gray-600 italic mb-6">"Bareilly mein itna authentic taste pehle kabhi nahi mila. Biryani bilkul 'Wow' thi!"</p>
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Arif+Khan&background=ef4444&color=fff&bold=true" class="w-12 h-12 rounded-full border-2 border-red-100 shadow-sm">
                        <div><h4 class="font-bold text-gray-900 text-sm">Arif Khan</h4><p class="text-[10px] text-gray-400">Verified Foodie</p></div>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-[2rem] shadow-sm food-card reveal-item" style="animation-delay: 0.1s;">
                    <div class="flex text-yellow-400 mb-4 text-xs"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                    <p class="text-gray-600 italic mb-6">"Fast delivery aur packaging ekdam premium. Bareilly ka King of taste!"</p>
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Abhijeet+SRK&background=3b82f6&color=fff&bold=true" class="w-12 h-12 rounded-full border-2 border-blue-100 shadow-sm">
                        <div><h4 class="font-bold text-gray-900 text-sm">Abhijeet SRK</h4><p class="text-[10px] text-gray-400">Local Guide</p></div>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-[2rem] shadow-sm food-card reveal-item" style="animation-delay: 0.2s;">
                    <div class="flex text-yellow-400 mb-4 text-xs"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                    <p class="text-gray-600 italic mb-6">"Veg options bhi bahut tasty hain. Har bite mein 'Wow' vibe aati hai."</p>
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Priya+Sharma&background=10b981&color=fff&bold=true" class="w-12 h-12 rounded-full border-2 border-green-100 shadow-sm">
                        <div><h4 class="font-bold text-gray-900 text-sm">Priya Sharma</h4><p class="text-[10px] text-gray-400">Food Blogger</p></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   <div id="cart-sidebar" class="fixed top-0 right-0 h-full w-full sm:w-96 bg-white shadow-2xl z-[110] transform translate-x-full transition-transform duration-300 border-l p-8 pb-32 flex flex-col">

        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-black italic text-gray-800 tracking-tighter uppercase">Your <span class="text-red-600">Basket</span></h2>
            <button onclick="toggleCart()" class="text-gray-400 hover:text-red-600 transition"><i class="fa-solid fa-xmark text-2xl"></i></button>
        </div>
        <div id="cart-items-list" class="flex-grow overflow-y-auto space-y-4 text-gray-400 text-center italic text-sm no-scrollbar">Basket is empty...</div>
      <div class="sticky bottom-0 left-0 right-0 bg-white border-t border-gray-100 pt-6 pb-4">
    <div class="space-y-2 mb-6">
        <div class="flex justify-between text-gray-500 text-xs">
            <span>Subtotal</span><span id="subtotal-price">₹0</span>
        </div>

        <div id="discount-row" class="flex justify-between text-green-600 text-xs font-bold hidden">
            <span>Discount</span><span id="discount-amount">-₹0</span>
        </div>

        <div class="flex justify-between font-black text-2xl text-red-600 italic pt-2 border-t border-gray-50">
            <span>TOTAL</span><span id="total-price">₹0</span>
        </div>
    </div>

    <button onclick="placeOrder()"
        class="checkout-btn w-full text-black py-5 rounded-2xl font-black shadow-2xl uppercase active:scale-95 flex items-center justify-center gap-3 text-xs tracking-widest italic">
        <span>Place Order</span><i class="fa-solid fa-bolt-lightning text-yellow-300"></i>
    </button>
</div>

    </div>
    <div id="cart-overlay" onclick="toggleCart()" class="fixed inset-0 bg-black/40 z-[105] hidden backdrop-blur-sm"></div>

    <footer class="bg-gray-900 text-white py-16 text-center cursor-help">
        <h3 class="text-2xl font-black italic text-red-600 tracking-tighter mb-2">WOW FOOD</h3>
        <p class="text-gray-500 text-[10px] mt-2 italic leading-relaxed">© 2026 Wow Food Bareilly. <br> Double-click for a special message ❤️</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>