// 1. Data Array (With Founder's Specials)
const foodItems = [
    { id: 1, name: "Classic Veg Burger", price: 99, category: "veg", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQd7upKlVxkEoqRy0sLDWDi9opymeKy1siHjw&s", rating: 4.5 },
    { id: 2, name: "Paneer Tikka Pizza", price: 249, category: "veg", image: "https://images.unsplash.com/photo-1513104890138-7c749659a591?w=500", rating: 4.8 },
    { id: 3, name: "Chicken Zinger", price: 149, category: "non-veg", image: "https://images.unsplash.com/photo-1562967914-608f82629710?w=500", rating: 4.7 },
    { id: 4, name: "Peri Peri Fries", price: 89, category: "veg", image: "https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=500", rating: 4.3 },
    { id: 5, name: "Butter Chicken", price: 350, category: "non-veg", image: "https://www.indianhealthyrecipes.com/wp-content/uploads/2023/05/butter-chicken-murgh-makhani.jpg", rating: 4.9, special: "Utkarsh's Fav" },
    { id: 6, name: "Farmhouse Pizza", price: 299, category: "veg", image: "https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=500", rating: 4.6 },
    { id: 7, name: "Mutton Seekh Kebab", price: 199, category: "non-veg", image: "https://hygienehalalfoods.com/storage/mutton-kabab-800x800.jpg", rating: 4.8 },
    { id: 8, name: "Veg Hakka Noodles", price: 120, category: "veg", image: "https://images.unsplash.com/photo-1585032226651-759b368d7246?w=500", rating: 4.4 },
    { id: 9, name: "Cold Coffee", price: 79, category: "beverage", image: "https://images.unsplash.com/photo-1530373239216-42518e6b4063?w=500", rating: 4.2 },
    { id: 10, name: "Chocolate Brownie", price: 110, category: "veg", image: "https://images.unsplash.com/photo-1564355808539-22fda35bed7e?w=500", rating: 4.9 },
    { id: 11, name: "Chicken Wings", price: 180, category: "non-veg", image: "https://images.unsplash.com/photo-1527477396000-e27163b481c2?w=500", rating: 4.7 },
    { id: 12, name: "Margherita Pizza", price: 199, category: "veg", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSWwNz-YV88e3LFP6iisBcZT-loky1VotV4aQ&s", rating: 4.5 },
    { id: 13, name: "Dal Makhani Tadka", price: 220, category: "indian", image: "https://i.ytimg.com/vi/M7nvJN0vQ3g/maxresdefault.jpg", rating: 4.7 },
    { id: 14, name: "Shahi Paneer", price: 280, category: "indian", image: "https://indianshealthyrecipes.com/wp-content/uploads/2024/07/ShahiPaneer-3.jpg", rating: 4.8 },
    { id: 15, name: "Raj kachori", price: 280, category: "indian", image: "https://indiasweethouse.in/cdn/shop/files/RajKachori.png?v=1718889710", rating: 4.8 },
    { id: 16, name: "Hyderabadi Biryani", price: 250, category: "non-veg", image: "https://upload.wikimedia.org/wikipedia/commons/7/7c/Hyderabadi_Chicken_Biryani.jpg", rating: 4.7, special: "Sneha's Fav" },
    { id: 17, name: "Chole Bhature", price: 140, category: "indian", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQLV7xAZVR-Kq2eFVM7H5HDiaHRESqwCeu40w&s", rating: 4.7, special: "Best Seller" },
    { id: 18, name: "Malai Kofta", price: 260, category: "indian", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRsT8TUD-NzEQeESGXCTvbEFMbcMp-heDW-Kw&s", rating: 4.5 },
    { id: 19, name: "Butter Naan", price: 40, category: "indian", image: "https://images.unsplash.com/photo-1601050690597-df0568f70950?w=500", rating: 4.4 },
    { id: 20, name: "Palak Paneer", price: 240, category: "indian", image: "https://images.unsplash.com/photo-1613292443284-8d10ef9383fe?w=500", rating: 4.6 },
    { id: 21, name: "Mutton Rogan Josh", price: 450, category: "non-veg", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyydlpFTfyMMtWwwUR96d7B0c-nDeSLirdRg&s", rating: 4.8 },
    { id: 22, name: "Tandoori Roti", price: 15, category: "indian", image: "https://sinfullyspicy.com/wp-content/uploads/2024/05/1200-by-1200-images.jpg", rating: 4.3 },
    { id: 23, name: "Masala Chai", price: 30, category: "beverage", image: "https://images.unsplash.com/photo-1561336313-0bd5e0b27ec8?w=500", rating: 4.9 },
    { id: 24, name: "Sweet Lassi", price: 60, category: "beverage", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDJl5giiE26PIj2AiDVRiVzwuqVuXVJX7MHg&s", rating: 4.7 },
    { id: 25, name: "Mango Shake", price: 90, category: "beverage", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTFcHT1of1x78LFUXffnLE8oNK7Xo-EMdpmGQ&s", rating: 4.5 },
    { id: 26, name: "Fresh Lime Soda", price: 50, category: "beverage", image: "https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?w=500", rating: 4.3 },
    { id: 27, name: "Oreo Shake", price: 120, category: "beverage", image: "https://images.unsplash.com/photo-1572490122747-3968b75cc699?w=500", rating: 4.8 },
    { id: 28, name: "Gulab Jamun (2 Pcs)", price: 60, category: "indian", image: "https://images.unsplash.com/photo-1589119908995-c6837fa14848?w=500", rating: 4.9 },
    { id: 29, name: "Vanilla Ice Cream", price: 80, category: "beverage", image: "https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=500", rating: 4.4 },
    { id: 30, name: "Thums Up (Can)", price: 40, category: "beverage", image: "https://m.media-amazon.com/images/I/61yecBpCDhL.jpg", rating: 4.6 },
    { id: 31, name: "Hot Coffee", price: 50, category: "beverage", image: "https://t3.ftcdn.net/jpg/05/34/82/24/360_F_534822425_9Ok2L60rSndeunIM6sELPKvuDqzhopX7.jpg", rating: 4.5 },
    { id: 32, name: "Red Bull", price: 145, category: "beverage", image: "https://t3.ftcdn.net/jpg/02/94/67/10/360_F_294671035_pe2CDpqSPhqv5ybyyy3vYBBKsdoCYDmE.jpg", rating: 4.7 }
];

let cart = []; 
let discountPercent = 0; 

// 2. Preloader & UI Toggles
window.addEventListener('load', () => {
    const loader = document.getElementById('preloader');
    if(loader) setTimeout(() => { loader.classList.add('loader-hide'); }, 1500);
});

function toggleAuth() { document.getElementById('auth-modal').classList.toggle('hidden'); }
function toggleSecret() { document.getElementById('founder-secret').classList.toggle('hidden'); }
function toggleCart() { document.getElementById('cart-sidebar').classList.toggle('translate-x-full'); document.getElementById('cart-overlay').classList.toggle('hidden'); }

function switchTab(type) {
    const loginForm = document.getElementById('login-form');
    const signupForm = document.getElementById('signup-form');
    const loginTab = document.getElementById('login-tab');
    const signupTab = document.getElementById('signup-tab');

    if (type === 'signup') {
        loginForm.classList.add('hidden'); signupForm.classList.remove('hidden');
        signupTab.classList.add('border-red-600', 'text-red-600'); loginTab.classList.remove('border-red-600', 'text-red-600');
    } else {
        signupForm.classList.add('hidden'); loginForm.classList.remove('hidden');
        loginTab.classList.add('border-red-600', 'text-red-600'); signupTab.classList.remove('border-red-600', 'text-red-600');
    }
}

// 3. Render Food Items
function renderFoodItems(items) {
    const container = document.getElementById('food-container');
    if(!container) return;
    container.innerHTML = ""; 

    items.forEach((item, index) => {
        const card = document.createElement('div');
        const isVeg = ['veg', 'indian', 'beverage'].includes(item.category);
        const symbolColor = isVeg ? "border-green-600" : "border-red-600";
        const dotColor = isVeg ? "bg-green-600" : "bg-red-600";
        const specialBadge = item.special ? `<div class="absolute top-0 left-1/2 -translate-x-1/2 bg-yellow-400 text-black text-[9px] font-black px-3 py-1 rounded-b-xl shadow-md z-20 uppercase tracking-tighter">${item.special}</div>` : '';

        card.className = "food-card reveal-item bg-white rounded-3xl shadow-lg overflow-hidden relative group p-4 border border-gray-100";
        card.style.animationDelay = `${index * 0.05}s`;

        card.innerHTML = `
            ${specialBadge}
            <div class="relative h-48 overflow-hidden rounded-2xl mb-4">
                <img src="${item.image}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="${item.name}">
                <div class="absolute top-3 left-3 z-10 drop-shadow-md">
                    <div class="w-4 h-4 border-2 ${symbolColor} flex items-center justify-center bg-white rounded-sm">
                        <div class="w-2 h-2 ${dotColor} rounded-full"></div>
                    </div>
                </div>
                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur px-2 py-1 rounded-lg text-xs font-bold shadow-sm">
                    <i class="fa-solid fa-star text-yellow-500"></i> ${item.rating}
                </div>
            </div>
            <div class="px-2">
                <span class="text-[10px] uppercase font-bold tracking-widest ${isVeg ? 'text-green-600' : 'text-red-600'}">${item.category}</span>
                <h3 class="text-lg font-black text-gray-800 mb-1 truncate">${item.name}</h3>
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mt-4">
                    <span class="text-xl font-black text-red-600 italic">₹${item.price}</span>
                    <button onclick="addToCart(event, ${item.id})" class="add-btn bg-gray-900 text-white flex items-center justify-center gap-2 px-4 py-2 rounded-xl hover:bg-red-600 transition-all active:scale-90 shadow-lg w-full sm:w-auto">
                        <i class="fa-solid fa-plus text-xs"></i><span class="text-sm font-bold">Add</span>
                    </button>
                </div>
            </div>`;
        container.appendChild(card);
    });
}

// 4. Mood Based Recommender
function recommendByMood(mood) {
    let filtered;
    const container = document.getElementById('food-container');
    container.scrollIntoView({ behavior: 'smooth', block: 'center' });

    if (mood === 'party') filtered = foodItems.filter(i => [2, 3, 7, 11, 16, 21].includes(i.id));
    else if (mood === 'low') filtered = foodItems.filter(i => [9, 10, 13, 23, 28, 31].includes(i.id));
    else if (mood === 'hungry') filtered = foodItems.filter(i => [5, 14, 15, 16, 17, 20].includes(i.id));

    renderFoodItems(filtered);
    confetti({ particleCount: 50, spread: 60, origin: { y: 0.7 } });
}

// 5. Social Proof (Bareilly Live)
function startSocialProof() {
    const locations = ["Civil Lines", "Selection Point", "DD Puram", "Rajendra Nagar", "Suresh Sharma Nagar", "Izatnagar"];
    const popup = document.getElementById('social-proof');
    const proofText = document.getElementById('proof-text');
    const proofImg = document.getElementById('proof-img');
    if(!popup) return;

    setInterval(() => {
        const randomItem = foodItems[Math.floor(Math.random() * foodItems.length)];
        const randomLoc = locations[Math.floor(Math.random() * locations.length)];
        proofImg.innerHTML = `<img src="${randomItem.image}" class="w-full h-full object-cover">`;
        proofText.innerHTML = `Someone from <span class="text-red-600">${randomLoc}</span> just ordered <br>${randomItem.name}`;
        popup.style.display = 'flex';
        popup.classList.add('animate-proof');
        setTimeout(() => { popup.style.display = 'none'; popup.classList.remove('animate-proof'); }, 5000);
    }, 22000);
}

// 6. Order Tracking Logic
function startOrderTracker() {
    const steps = [
        { id: 'step-1', title: 'Utkarsh is Cooking', desc: 'Adding extra love...', icon: 'fa-fire-burner' },
        { id: 'step-2', title: 'Sneha Quality Check', desc: 'Packing your treat...', icon: 'fa-medal' },
        { id: 'step-3', title: 'Express Delivery', desc: 'Zooming to your door! ⚡', icon: 'fa-motorcycle' }
    ];
    let currentStep = 0;
    const interval = setInterval(() => {
        if (currentStep > 0) {
            const prev = document.getElementById(`step-${currentStep}`);
            if(prev) { prev.innerHTML = '<i class="fa-solid fa-check"></i>'; prev.className = "w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold text-white bg-green-500 border-2 border-green-500"; }
        }
        if (currentStep < steps.length) {
            const step = steps[currentStep];
            document.getElementById('order-status-title').innerText = step.title;
            document.getElementById('order-status-desc').innerText = step.desc;
            document.getElementById('order-status-icon').innerHTML = `<i class="fa-solid ${step.icon}"></i>`;
            const currentRow = document.getElementById(`row-step-${currentStep + 1}`);
            if(currentRow) { currentRow.style.opacity = '1'; document.getElementById(`step-${currentStep + 1}`).classList.add('animate-pulse'); }
            currentStep++;
        } else {
            clearInterval(interval);
            document.getElementById('order-status-title').innerText = "WOW! ARRIVED";
            confetti({ particleCount: 100, spread: 70, origin: { y: 0.6 } });
        }
    }, 3000);
}

// 7. Core Logic (Cart, Filter, Greeting)
function updateCartUI() {
    const cartList = document.getElementById('cart-items-list');
    const totalElement = document.getElementById('total-price');
    const subtotalElement = document.getElementById('subtotal-price');
    const countElement = document.getElementById('cart-count');

    countElement.innerText = cart.reduce((sum, item) => sum + item.quantity, 0);
    if (cart.length === 0) {
        cartList.innerHTML = '<div class="text-gray-400 text-center pt-10">Basket empty!</div>';
        totalElement.innerText = "₹0"; return;
    }
    cartList.innerHTML = cart.map(item => `
        <div class="flex items-center justify-between bg-gray-50 p-3 rounded-2xl border border-gray-100 mb-3 text-xs">
            <div class="flex items-center gap-3">
                <img src="${item.image}" class="w-10 h-10 rounded-lg object-cover">
                <div><h4 class="font-bold text-gray-800">${item.name}</h4><p class="text-red-600 font-bold">₹${item.price} x ${item.quantity}</p></div>
            </div>
            <button onclick="removeFromCart(${item.id})" class="text-gray-300 hover:text-red-600"><i class="fa-solid fa-trash-can"></i></button>
        </div>`).join('');

    let sub = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    if(subtotalElement) subtotalElement.innerText = `₹${sub}`;
    totalElement.innerText = `₹${sub - (sub * discountPercent / 100)}`;
}

function addToCart(event, itemId) {
    const item = foodItems.find(f => f.id === itemId);
    const existing = cart.find(c => c.id === itemId);
    if (existing) existing.quantity++; else cart.push({ ...item, quantity: 1 });
    updateCartUI();
}

function removeFromCart(id) { cart = cart.filter(i => i.id !== id); updateCartUI(); }

async function placeOrder() {
  if (cart.length === 0) {
    alert("Cart empty!");
    return;
  }

  try {
    const res = await fetch("place_order.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ cart })
    });

    const data = await res.json();

    if (data.success) {
      alert(data.message);
      cart = [];
      updateCartUI();
      toggleCart();
      window.location.href = "my_orders.php";
    } else {
      alert("Error: " + data.message);
    }
  } catch (err) {
    alert("Server error! " + err.message);
  }
}



function filterCategory(category) {
    document.querySelectorAll('.category-btn').forEach(btn => btn.classList.remove('active'));
    if(event) event.target.classList.add('active');
    let filtered = (category === 'all') ? foodItems : foodItems.filter(i => i.category === category || (category === 'veg' && ['indian','beverage'].includes(i.category)));
    renderFoodItems(filtered);
}

function setGreeting() {
    const hours = new Date().getHours();
    const heroTitle = document.querySelector('h2.text-6xl');
    let msg = "EAT THE <span class='text-red-600'>WOW</span>";
    if (hours < 12) msg = "GOOD MORNING <span class='text-red-600'>WOW</span>";
    else if (hours < 17) msg = "LUNCH TIME <span class='text-red-600'>WOW</span>";
    else msg = "GOOD EVENING <span class='text-red-600'>WOW</span>";
    if(heroTitle) heroTitle.innerHTML = msg;
}

document.addEventListener('DOMContentLoaded', () => { 
    setGreeting(); renderFoodItems(foodItems); startSocialProof();
    document.querySelector('footer').addEventListener('dblclick', toggleSecret);
});
window.placeOrder =placeOrder;