// Add hover effects for workshop cards
const workshopCards = document.querySelectorAll('.workshop-card');

workshopCards.forEach(card => {
    card.addEventListener('mouseenter', () => {
        card.style.transform = 'scale(1.05)';
        card.style.boxShadow = '0 8px 20px rgba(0, 201, 255, 0.4)';
    });

    card.addEventListener('mouseleave', () => {
        card.style.transform = 'scale(1)';
        card.style.boxShadow = 'none';
    });
});

// Add click effects for buttons
const buttons = document.querySelectorAll('.register-btn, .cta-btn');

buttons.forEach(button => {
    button.addEventListener('click', () => {
        alert('Thank you for your interest! Redirecting to registration...');
        // Add your registration link here
        window.location.href = 'workshop/user.html';
    });
});