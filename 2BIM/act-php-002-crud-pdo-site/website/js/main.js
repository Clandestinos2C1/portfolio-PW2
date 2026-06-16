const hamburger = document.getElementById('hamburger');
const navLinks = document.getElementById('navLinks');
const navbar = document.getElementById('navbar');

hamburger.addEventListener('click', () => {
  hamburger.classList.toggle('open');
  navLinks.classList.toggle('mobile-open');
  navbar.classList.toggle('menu-aberto');
});

navLinks.querySelectorAll('a').forEach(link => {
  link.addEventListener('click', () => {
    hamburger.classList.remove('open');
    navLinks.classList.remove('mobile-open');
    navbar.classList.remove('menu-aberto');
  });
});

window.addEventListener('scroll', () => {
  navbar.classList.toggle('scrolled', window.scrollY > 20);
});

const scrollTop = document.getElementById('scrollTop');
window.addEventListener('scroll', () => {
  scrollTop.classList.toggle('visible', window.scrollY > 400);
});
scrollTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

const cards = document.querySelectorAll('.disco-card');
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
      observer.unobserve(entry.target);
    }
  });
}, { threshold: 0.1 });
cards.forEach(card => observer.observe(card));