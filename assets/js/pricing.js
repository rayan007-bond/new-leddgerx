// Pricing Page JavaScript
document.addEventListener('DOMContentLoaded', function() {
  // Billing Toggle Functionality
  const billingToggle = document.getElementById('billingToggle');
  const monthlyPrices = {
    starter: 275,
    growth: 410,
    premium: 820
  };
  
  const annualPrices = {
    starter: 220, // 20% off
    growth: 328,
    premium: 656
  };

  if (billingToggle) {
    billingToggle.addEventListener('change', function() {
      updatePrices(this.checked);
      updateToggleLabels(this.checked);
    });
  }

  function updatePrices(isAnnual) {
    const prices = isAnnual ? annualPrices : monthlyPrices;
    const period = isAnnual ? '/year' : '/month';
    
    // Update Starter Plan
    const starterPrice = document.querySelector('.pricing-item:not(.featured):not(.enterprise-plan) .price');
    if (starterPrice) {
      const currency = starterPrice.querySelector('.currency');
      const periodElement = starterPrice.querySelector('.period');
      starterPrice.innerHTML = `${currency.outerHTML}${prices.starter}<span class="period">${period}</span>`;
    }

    // Update Growth Plan
    const growthPrice = document.querySelector('.pricing-item.featured .price');
    if (growthPrice) {
      const currency = growthPrice.querySelector('.currency');
      const periodElement = growthPrice.querySelector('.period');
      growthPrice.innerHTML = `${currency.outerHTML}${prices.growth}<span class="period">${period}</span>`;
    }

    // Update Premium Plan
    const premiumPrice = document.querySelector('.pricing-item:not(.featured):not(.enterprise-plan) + .pricing-item .price');
    if (premiumPrice) {
      const currency = premiumPrice.querySelector('.currency');
      const periodElement = premiumPrice.querySelector('.period');
      premiumPrice.innerHTML = `${currency.outerHTML}${prices.premium}<span class="period">${period}</span>`;
    }
  }

  function updateToggleLabels(isAnnual) {
    const labels = document.querySelectorAll('.toggle-label');
    labels.forEach(label => {
      if (isAnnual) {
        label.classList.toggle('active', label.textContent.includes('Annual'));
      } else {
        label.classList.toggle('active', label.textContent.includes('Monthly'));
      }
    });
  }

  // FAQ Accordion Functionality
  const faqItems = document.querySelectorAll('.faq-item');
  
  faqItems.forEach(item => {
    const question = item.querySelector('.faq-question');
    
    question.addEventListener('click', () => {
      // Close all other items
      faqItems.forEach(otherItem => {
        if (otherItem !== item) {
          otherItem.classList.remove('active');
        }
      });
      
      // Toggle current item
      item.classList.toggle('active');
    });
  });

  // Smooth scrolling for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });

  // Plan selection animation
  const pricingItems = document.querySelectorAll('.pricing-item');
  
  pricingItems.forEach(item => {
    item.addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-10px)';
    });
    
    item.addEventListener('mouseleave', function() {
      if (!this.classList.contains('featured')) {
        this.style.transform = 'translateY(0)';
      }
    });
  });

  // Add loading animation for better UX
  window.addEventListener('load', function() {
    document.body.classList.add('loaded');
  });

  // Price calculation for custom plans
  function calculateCustomPrice(employees, transactions, services) {
    let basePrice = 200;
    let employeeCost = employees * 50;
    let transactionCost = Math.max(0, transactions - 100) * 2;
    let serviceMultiplier = services.length * 1.2;
    
    return Math.round((basePrice + employeeCost + transactionCost) * serviceMultiplier);
  }

  // Example usage for custom quote calculator (can be expanded)
  console.log('Pricing page loaded successfully');
});