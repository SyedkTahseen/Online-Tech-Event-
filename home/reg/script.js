document.addEventListener('DOMContentLoaded', () => {
    // Add scroll animation to cards
    const cards = document.querySelectorAll('.event-card');

    const observer = new IntersectionObserver(entries => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                entry.target.style.transition = `opacity 0.8s ease-out, transform 0.8s cubic-bezier(0.23, 1, 0.32, 1) ${index * 100}ms`;
                entry.target.style.transform = 'translateY(0)';
                entry.target.style.opacity = 1;
            } else {
                entry.target.style.transition = 'opacity 0.6s ease-in, transform 0.6s ease-in-out';
                entry.target.style.transform = 'translateY(50px)';
                entry.target.style.opacity = 0;
            }
        });
    }, { threshold: 0.2 });

    cards.forEach(card => {
        observer.observe(card);
    });

    // Add smooth hover effect to buttons using transition
    const buttons = document.querySelectorAll('.register-btn');

    buttons.forEach(button => {
        button.style.transition = 'transform 0.3s ease-out, box-shadow 0.3s ease-out';

        button.addEventListener('mouseenter', () => {
            button.style.transform = 'scale(1.1)';
            button.style.boxShadow = '0px 4px 10px rgba(255, 255, 255, 0.3)';
        });

        button.addEventListener('mouseleave', () => {
            button.style.transform = 'scale(1)';
            button.style.boxShadow = 'none';
        });
    });
});
