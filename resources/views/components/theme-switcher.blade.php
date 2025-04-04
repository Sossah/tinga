<div class="theme-switcher">
    <button id="theme-toggle" class="btn btn-sm" title="Toggle theme">
        <i class="fas fa-moon dark-icon"></i>
        <i class="fas fa-sun light-icon"></i>
    </button>
</div>

<style>
    .theme-switcher {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
    }
    
    #theme-toggle {
        background-color: transparent;
        border: none;
        font-size: 1.2rem;
        cursor: pointer;
        padding: 8px;
        border-radius: 50%;
        transition: all 0.3s ease;
    }
    
    body.light-mode #theme-toggle {
        color: #117a1a;
        background-color: rgba(255, 255, 255, 0.2);
    }
    
    body.dark-mode #theme-toggle {
        color: #f5e720;
        background-color: rgba(0, 0, 0, 0.2);
    }
    
    body.light-mode .dark-icon {
        display: inline-block;
    }
    
    body.light-mode .light-icon {
        display: none;
    }
    
    body.dark-mode .dark-icon {
        display: none;
    }
    
    body.dark-mode .light-icon {
        display: inline-block;
    }
    
    #theme-toggle:hover {
        transform: rotate(15deg);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const themeToggle = document.getElementById('theme-toggle');
        const body = document.body;
        
        // Check for saved theme preference or use preferred color scheme
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            body.classList.add(savedTheme + '-mode');
        } else {
            // Use prefers-color-scheme as a fallback
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                body.classList.add('dark-mode');
            } else {
                body.classList.add('light-mode');
            }
        }
        
        // Toggle theme on button click
        themeToggle.addEventListener('click', function() {
            if (body.classList.contains('light-mode')) {
                body.classList.replace('light-mode', 'dark-mode');
                localStorage.setItem('theme', 'dark');
            } else {
                body.classList.replace('dark-mode', 'light-mode');
                localStorage.setItem('theme', 'light');
            }
        });
    });
</script>