import './bootstrap';

import TomSelect from "tom-select";
import "tom-select/dist/css/tom-select.css";

/*
 * Hero Card Interactions
 *
 * This block manages the interactive behavior of the hero card component:
 * 1. Detects if a hero card exists on the page.
 * 2. Sets up references to the navbar, scrollable content, open/close buttons, and demo view.
 * 3. Defines a function `setDemoState` to toggle the demo view:
 *    - Adds/removes the 'demo-active' class on the hero card.
 *    - Updates the 'aria-hidden' attribute on the demo view for accessibility.
 * 4. Opens the demo when the open button is clicked, closes it when the close button is clicked.
 * 5. Enables vertical scrolling on the hero scroll area when the user scrolls the navbar,
 *    preventing default scroll behavior if the content is scrollable.
 * 
 * Provides a smooth interactive experience for opening/closing demos and scrolling hero content.
 */
const heroCard = document.querySelector('[data-hero-card]');
if (heroCard) {
    const navbar = heroCard.querySelector('.navbar');
    const heroScroll = heroCard.querySelector('.hero-scroll');
    const openButton = heroCard.querySelector('[data-hero-open]');
    const closeButton = heroCard.querySelector('[data-hero-close]');
    const demoView = heroCard.querySelector('[data-hero-demo]');

    const setDemoState = (isActive) => {
        heroCard.classList.toggle('demo-active', isActive);

        if (demoView) {
            demoView.setAttribute('aria-hidden', isActive ? 'false' : 'true');
        }
    };

    openButton?.addEventListener('click', () => setDemoState(true));
    closeButton?.addEventListener('click', () => setDemoState(false));

    navbar?.addEventListener('wheel', (event) => {
        if (!heroScroll) {
            return;
        }

        const canScrollVertically = heroScroll.scrollHeight > heroScroll.clientHeight;

        if (!canScrollVertically) {
            return;
        }

        event.preventDefault();
        heroScroll.scrollBy({
            top: event.deltaY,
            left: event.deltaX,
            behavior: 'auto',
        });
    }, { passive: false });
}


/*
 * Password Strength Meter
 *
 * This block dynamically evaluates the strength of the user's password as they type:
 * 1. Listens for input changes in the password field.
 * 2. Shows or hides the strength bar depending on whether the field has content.
 * 3. Calculates a strength score based on:
 *    - Minimum length (6+ and 10+ characters)
 *    - Presence of uppercase letters
 *    - Presence of numbers
 *    - Presence of special characters
 * 4. Maps the strength score to a width percentage and color for the strength fill:
 *    - Red for weak, orange for medium, green for strong.
 * 5. Updates the visual strength bar in real-time for immediate user feedback.
 */
const passwordInput = document.getElementById('password');
const strengthBar = document.getElementById('password-strength-bar');
const strengthFill = document.getElementById('password-strength-fill');
if (passwordInput && strengthBar && strengthFill) {
    passwordInput.addEventListener('input', () => {
        const value = passwordInput.value;

        if (value.length > 0) {
            strengthBar.style.display = 'block';
        } else {
            strengthBar.style.display = 'none';
        }

        let strength = 0;
        if (value.length >= 6) strength += 1;
        if (/[A-Z]/.test(value)) strength += 1;
        if (/\d/.test(value)) strength += 1;
        if (/[\W]/.test(value)) strength += 1;
        if (value.length >= 10) strength += 1;

        let width = (strength / 5) * 100;
        let color = '#48c264';
        if (strength <= 1) color = 'red';
        else if (strength <= 3) color = 'orange';

        strengthFill.style.width = width + '%';
        strengthFill.style.background = color;
    });
}

/*
 * OTP Input Handling
 *
 * This block manages all behaviors for multi-field OTP inputs:
 * 1. Automatically moves focus to the next input when a user types a character.
 * 2. Handles pasting multiple characters, spreading them across the inputs sequentially.
 * 3. Moves focus back to the previous input when the user presses Backspace on an empty field.
 * 
 * It ensures smooth user experience when entering or pasting OTP codes.
 */
const otpInputs = document.querySelectorAll('.otp-input');
otpInputs.forEach((input, index) => {
    input.addEventListener('input', () => {
        const inputs = Array.from(otpInputs);
        if (input.value.length > 1) {
            const chars = input.value.split('');
            chars.forEach((char, i) => {
                if (index + i < inputs.length) {
                    inputs[index + i].value = char;
                }
            });
            const lastIndex = Math.min(index + chars.length, inputs.length - 1);
            inputs[lastIndex].focus();
        } else if (input.value.length === 1 && index < inputs.length - 1) {
            inputs[index + 1].focus();
        }
    });

    input.addEventListener('keydown', (e) => {
        if (e.key === 'Backspace' && input.value.length === 0 && index > 0) {
            otpInputs[index - 1].focus();
        }
    });

    input.addEventListener('paste', (e) => {
        e.preventDefault();
        const pasteData = (e.clipboardData || window.clipboardData).getData('text');
        const inputs = Array.from(otpInputs);
        pasteData.split('').forEach((char, i) => {
            if (index + i < inputs.length) {
                inputs[index + i].value = char;
            }
        });
        const lastIndex = Math.min(index + pasteData.length, inputs.length - 1);
        inputs[lastIndex].focus();
    });
});

/*
 * Toast Notification Handling
 *
 * This block manages the success toast message after page load:
 * 1. Waits for the DOM to fully load.
 * 2. Checks if the toast element exists on the page.
 * 3. Adds the 'show' class to fade in and slide up the toast.
 * 4. Keeps the toast visible for 6 seconds.
 * 5. Removes the 'show' class to fade out, then completely removes the element from the DOM.
 *
 * Provides a smooth, auto-hiding notification for success messages.
 */
document.addEventListener('DOMContentLoaded', function () {
    const toast = document.getElementById('toast-success');
    if (toast) {
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 500);
        }, 4000);
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const section = document.querySelector('.review-section-intro');

    if (!section) {
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                section.classList.add('show');
            }
        });
    }, {
        threshold: 0.2
    });

    observer.observe(section);
});

window.toggleSize = function (el, size) {
    document.querySelectorAll('.chip').forEach(btn => {
        btn.classList.remove('active');
    });

    el.classList.add('active');

    const input = document.getElementById('sizes-input');
    if (input) {
        input.value = size;
    }
};

const productImageInput = document.getElementById('product-image-input');
if (productImageInput) {
    productImageInput.addEventListener('change', function(event) {
        if (event.target.files && event.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('product-preview');
                const icon = document.getElementById('upload-icon');
                const uploadText = document.getElementById('upload-text');

                if (!preview || !icon || !uploadText) {
                    return;
                }

                preview.src = e.target.result;
                preview.style.display = 'block';

                icon.innerHTML = `
                    <path d="M3 6h18" />
                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                    <line x1="10" y1="11" x2="10" y2="17" />
                    <line x1="14" y1="11" x2="14" y2="17" />
                `;
                uploadText.textContent = "Remove Image";

                icon.parentElement.onclick = function() {
                    preview.src = "";
                    preview.style.display = 'none';
                    icon.innerHTML = `
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <polyline points="17 8 12 3 7 8" />
                        <line x1="12" y1="3" x2="12" y2="15" />
                    `;
                    uploadText.textContent = "Click to Upload Image";
                    productImageInput.value = "";
                }
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const deleteDialog = document.querySelector('[data-delete-confirm-dialog]');

    if (!deleteDialog) {
        return;
    }

    const deleteName = deleteDialog.querySelector('[data-delete-dress-name]');
    const cancelButton = deleteDialog.querySelector('[data-delete-cancel]');
    const submitButton = deleteDialog.querySelector('[data-delete-submit]');
    let activeForm = null;

    document.querySelectorAll('[data-delete-confirm-trigger]').forEach((button) => {
        button.addEventListener('click', function () {
            const formId = button.getAttribute('data-form-id');
            activeForm = formId ? document.getElementById(formId) : null;

            if (deleteName) {
                deleteName.textContent = button.getAttribute('data-dress-name') || 'this dress';
            }

            if (typeof deleteDialog.showModal === 'function') {
                deleteDialog.showModal();
            }
        });
    });

    cancelButton?.addEventListener('click', function () {
        deleteDialog.close();
        activeForm = null;
    });

    submitButton?.addEventListener('click', function () {
        if (activeForm) {
            activeForm.submit();
        }
    });

    deleteDialog.addEventListener('click', function (event) {
        if (event.target === deleteDialog) {
            deleteDialog.close();
            activeForm = null;
        }
    });
});
console.log("APP JS LOADED");

const initTomSelect = () => {
    document.querySelectorAll('.searchable-select').forEach(el => {
        if (!el.tomselect) { // prevent double init
            new TomSelect(el);
        }
    });
};

// run immediately
initTomSelect();
// also run on page load (safety)
window.addEventListener('load', initTomSelect);
new TomSelect(el, {
    placeholder: "Select Location",
    allowEmptyOption: true
});