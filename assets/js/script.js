// ========= NAVBAR SCROLL EFFECT =========
const navbar = document.getElementById('navbar');

window.addEventListener('scroll', () => {
  navbar.classList.toggle('scrolled', window.scrollY > 60);
});

// ========= HAMBURGER MENU =========
const hamburger = document.getElementById('hamburger');
const mobileMenu = document.getElementById('mobile-menu');

if (hamburger && mobileMenu) {
  hamburger.addEventListener('click', () => {
    mobileMenu.classList.toggle('open');
  });
  mobileMenu.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => mobileMenu.classList.remove('open'));
  });
}

// ========= SCROLL REVEAL =========
const revealObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.style.transitionDelay = entry.target.dataset.delay || '0ms';
      entry.target.classList.add('visible');
      revealObserver.unobserve(entry.target);
    }
  });
}, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

const staggerGroups = [
  '.programs-grid .program-card',
  '.academics-grid .ac-card',
  '.testi-grid .testi-card',
  '.campus-grid .campus-card',
  '.contact-cards .cc',
  '.cert-logos .cert-item',
  '.about-features .about-feat',
  '.iso-points .iso-point'
];
staggerGroups.forEach(selector => {
  document.querySelectorAll(selector).forEach((el, i) => {
    el.dataset.delay = `${i * 75}ms`;
  });
});

document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

// ========= COUNTER ANIMATION (ease-out + glow on finish) =========
const counterObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const el = entry.target;
      const target = parseInt(el.dataset.target, 10);
      const suffix = el.dataset.suffix || '';
      const duration = 2000;
      const steps = 60;
      let tick = 0;

      const timer = setInterval(() => {
        const progress = tick / steps;
        const value = Math.floor(target * (1 - Math.pow(1 - progress, 3)));
        el.textContent = value.toLocaleString() + suffix;
        tick++;

        if (tick > steps) {
          el.textContent = target.toLocaleString() + suffix;
          clearInterval(timer);
          // Add glow class when counting finishes
          el.classList.add('counted');
        }
      }, duration / steps);

      counterObserver.unobserve(el);
    }
  });
}, { threshold: 0.5 });

document.querySelectorAll('[data-target]').forEach(el => counterObserver.observe(el));

// ========= ACTIVE NAV LINK =========
const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('#nav-links a');

const sectionObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      navLinks.forEach(link => {
        link.classList.remove('active-nav');
        if (link.getAttribute('href') === '#' + entry.target.id) {
          link.classList.add('active-nav');
        }
      });
    }
  });
}, { rootMargin: '-40% 0px -55% 0px' });

sections.forEach(s => sectionObserver.observe(s));

// ========= 3D TILT EFFECT ON CARDS =========
function addTiltEffect(selector, maxTilt = 8) {
  document.querySelectorAll(selector).forEach(card => {
    card.addEventListener('mousemove', e => {
      const rect = card.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;
      const cx = rect.width / 2;
      const cy = rect.height / 2;
      const rotX = ((y - cy) / cy) * maxTilt * -1;
      const rotY = ((x - cx) / cx) * maxTilt;
      card.style.transform = `perspective(800px) rotateX(${rotX}deg) rotateY(${rotY}deg) translateY(-8px)`;
      card.style.transition = 'transform 0.1s ease';
    });
    card.addEventListener('mouseleave', () => {
      card.style.transform = '';
      card.style.transition = 'transform 0.5s ease';
    });
  });
}
addTiltEffect('.program-card', 6);
addTiltEffect('.testi-card', 5);
addTiltEffect('.feat-card', 5);
addTiltEffect('.ac-card', 4);

// ========= RIPPLE EFFECT ON BUTTONS =========
document.querySelectorAll('.btn-primary, .btn-outline, .btn-login').forEach(btn => {
  btn.addEventListener('click', function (e) {
    const ripple = document.createElement('span');
    ripple.classList.add('ripple');
    const rect = this.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    ripple.style.cssText = `
            width: ${size}px; height: ${size}px;
            left: ${e.clientX - rect.left - size / 2}px;
            top:  ${e.clientY - rect.top - size / 2}px;
        `;
    this.appendChild(ripple);
    ripple.addEventListener('animationend', () => ripple.remove());
  });
});

// ========= PARTICLE CANVAS IN HERO =========
(function () {
  const hero = document.querySelector('.hero');
  if (!hero) return;

  const canvas = document.createElement('canvas');
  canvas.style.cssText = 'position:absolute;inset:0;width:100%;height:100%;z-index:1;pointer-events:none;';
  hero.appendChild(canvas);

  const ctx = canvas.getContext('2d');
  let particles = [];
  let W, H;

  function resize() {
    W = canvas.width = hero.offsetWidth;
    H = canvas.height = hero.offsetHeight;
  }
  resize();
  window.addEventListener('resize', resize);

  function Particle() {
    this.reset();
  }
  Particle.prototype.reset = function () {
    this.x = Math.random() * W;
    this.y = Math.random() * H;
    this.r = Math.random() * 1.5 + 0.3;
    this.dx = (Math.random() - 0.5) * 0.4;
    this.dy = (Math.random() - 0.5) * 0.4;
    this.opacity = Math.random() * 0.35 + 0.05;
  };
  Particle.prototype.update = function () {
    this.x += this.dx;
    this.y += this.dy;
    if (this.x < 0 || this.x > W) this.dx *= -1;
    if (this.y < 0 || this.y > H) this.dy *= -1;
  };
  Particle.prototype.draw = function () {
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
    ctx.fillStyle = `rgba(165, 180, 252, ${this.opacity})`;
    ctx.fill();
  };

  const COUNT = 80;
  for (let i = 0; i < COUNT; i++) particles.push(new Particle());

  function animate() {
    ctx.clearRect(0, 0, W, H);
    particles.forEach(p => { p.update(); p.draw(); });
    // Draw connecting lines between nearby particles
    for (let i = 0; i < particles.length; i++) {
      for (let j = i + 1; j < particles.length; j++) {
        const dx = particles[i].x - particles[j].x;
        const dy = particles[i].y - particles[j].y;
        const dist = Math.sqrt(dx * dx + dy * dy);
        if (dist < 100) {
          ctx.beginPath();
          ctx.moveTo(particles[i].x, particles[i].y);
          ctx.lineTo(particles[j].x, particles[j].y);
          ctx.strokeStyle = `rgba(165, 180, 252, ${0.06 * (1 - dist / 100)})`;
          ctx.lineWidth = 0.5;
          ctx.stroke();
        }
      }
    }
    requestAnimationFrame(animate);
  }
  animate();
})();

// ========= ISO ICON SPIN-IN ON SCROLL =========
const isoIconBig = document.querySelector('.iso-icon-big');
if (isoIconBig) {
  const isoObs = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        isoIconBig.classList.add('visible');
        isoObs.unobserve(isoIconBig);
      }
    });
  }, { threshold: 0.5 });
  isoObs.observe(isoIconBig);
}

// ========= MOUSE PARALLAX ON HERO =========
const heroEl = document.querySelector('.hero');
if (heroEl) {
  document.addEventListener('mousemove', e => {
    const xRatio = (e.clientX / window.innerWidth - 0.5) * 20;
    const yRatio = (e.clientY / window.innerHeight - 0.5) * 10;
    const heroBefore = heroEl.querySelector('.hero-overlay');
    if (heroBefore) {
      heroBefore.style.transform = `translate(${xRatio * 0.5}px, ${yRatio * 0.5}px)`;
    }
    const heroContent = heroEl.querySelector('.hero-content');
    if (heroContent) {
      heroContent.style.transform = `translate(${xRatio * -0.3}px, ${yRatio * -0.3}px)`;
    }
  });
}
