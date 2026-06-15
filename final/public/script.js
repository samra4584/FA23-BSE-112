// Contact Form Submission (only if contact form exists)
const contactForm = document.querySelector('#contact form');
if (contactForm) {
  contactForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const name = this.querySelector('input[type="text"]').value;
    const email = this.querySelector('input[type="email"]').value;
    const phone = this.querySelector('input[type="tel"]').value;
    if (name && email && phone) {
      alert(`Thank you ${name}! We will contact you soon.`);
      this.reset();
    } else {
      alert('Please fill out all fields correctly.');
    }
  });
}

// Scroll to Top Button (works on all pages)
const scrollBtn = document.createElement('button');
scrollBtn.innerHTML = '<i class="bi bi-arrow-up"></i>';
scrollBtn.style.cssText = `
  position: fixed; bottom: 20px; right: 20px; 
  background-color: #d4a373; color: #000; 
  border: none; padding: 10px 15px; border-radius: 50%;
  font-size: 18px; cursor: pointer; display: none; z-index: 1000;
`;
document.body.appendChild(scrollBtn);
scrollBtn.addEventListener('click', () => window.scrollTo({top: 0, behavior: 'smooth'}));
window.addEventListener('scroll', () => {
  scrollBtn.style.display = window.scrollY > 300 ? 'block' : 'none';
});
// Universal Cart using localStorage - optimized
let cart = JSON.parse(localStorage.getItem("cart")) || [];
const cartItems = document.getElementById("cart-items");
const cartTotal = document.getElementById("cart-total");
const cartCount = document.getElementById("cart-count");

// Add to cart buttons - optimized with event delegation
document.addEventListener('click', function(e) {
  if (e.target.closest('.add-cart') || (e.target.closest('.btn-coffee') && e.target.closest('.card'))) {
    const btn = e.target.closest('.add-cart') || e.target.closest('.btn-coffee');
    const name = btn.dataset.name || btn.closest(".card")?.querySelector(".card-title")?.textContent;
    const price = parseFloat(btn.dataset.price || btn.closest(".card")?.querySelector(".fw-bold")?.textContent.replace("$",""));
    if(!name || !price) return;
    cart.push({name, price});
    updateCart();
    saveCart();
  }
});

function updateCart() {
  if(!cartItems) return;
  cartItems.innerHTML = "";
  let total = 0;
  cart.forEach(item => {
    total += item.price;
    const li = document.createElement("li");
    li.textContent = `${item.name} - $${item.price.toFixed(2)}`;
    li.className = "text-light mb-1";
    cartItems.appendChild(li);
  });
  cartTotal.textContent = total.toFixed(2);
  if(cartCount) cartCount.textContent = cart.length;
}

function saveCart() {
  localStorage.setItem("cart", JSON.stringify(cart));
}

// Clear cart button - optimized
document.addEventListener('click', function(e) {
  if (e.target.closest('.clear-cart')) {
    cart = [];
    updateCart();
    saveCart();
  }
});

// Checkout button - redirect to checkout page (only if it's a button, not a link)
document.querySelectorAll("button.checkout").forEach(btn => {
  btn.addEventListener("click", (e) => {
    if (cart.length === 0) {
      e.preventDefault();
      alert("Your cart is empty!");
    } else {
      // Save cart - links will handle navigation
      saveCart();
    }
  });
});
// Navigation active state management
(function() {
  const navLinks = document.querySelectorAll('#navbar-links .nav-link, .navbar-nav .nav-link[href^="/"]'); 
  
  // Set active state based on current page
  const currentPath = window.location.pathname;
  const currentHash = window.location.hash;
  
  // Remove all active classes first
  navLinks.forEach(link => link.classList.remove('active'));
  
  // Set active for current page
  navLinks.forEach(link => {
    const href = link.getAttribute('href');
    if (href) {
      // For hash links (same page sections)
      if (href.startsWith('#') && currentHash === href) {
        link.classList.add('active');
      }
      // For route links (different pages)
      else if (href.startsWith('/') && currentPath === href) {
        link.classList.add('active');
      }
      // For home page
      else if ((href === '/' || href === '#home' || href.includes('#home')) && currentPath === '/' && !currentHash) {
        link.classList.add('active');
      }
    }
  });
  
  // Highlight on click - persist active state
  navLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      // Only handle if it's a hash link (same page)
      if (this.getAttribute('href')?.startsWith('#')) {
        navLinks.forEach(l => {
          if (l.getAttribute('href')?.startsWith('#')) {
            l.classList.remove('active');
          }
        });
        this.classList.add('active');
      }
      // For route links, let the page load handle it
    });
  });
  
  // Highlight on scroll (only for sections in same page)
  const sections = document.querySelectorAll('section[id]');
  if (sections.length > 0) {
    let ticking = false;
    function updateActiveOnScroll() {
      let scrollY = window.scrollY + 80;
      sections.forEach(section => {
        if(scrollY >= section.offsetTop && scrollY < section.offsetTop + section.offsetHeight){
          navLinks.forEach(l => {
            if (l.getAttribute('href')?.startsWith('#')) {
              l.classList.remove('active');
            }
          });
          const id = section.getAttribute('id');
          const activeLink = document.querySelector(`#navbar-links .nav-link[href="#${id}"]`);
          if(activeLink) activeLink.classList.add('active');
        }
      });
      ticking = false;
    }
    
    window.addEventListener('scroll', () => {
      if (!ticking) {
        window.requestAnimationFrame(updateActiveOnScroll);
        ticking = true;
      }
    }, { passive: true });
  }
})();


// Initialize cart on page load
updateCart();
