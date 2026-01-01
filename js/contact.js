/**
 * Contact Form Logic
 * 
 * Provides initialization for the main contact form on public pages.
 */

window.initializeContactForm = function () {
    const contactForm = document.getElementById('contact-form');
    // Early exit if form not present
    if (!contactForm) return;

    const submitBtn = document.getElementById('submit-btn');
    const submitText = document.getElementById('submit-text');
    const submitLoader = document.getElementById('submit-loader');
    const formMessage = document.getElementById('form-message');
    const formMessageText = document.getElementById('form-message-text');

    // Clone to remove old listeners if re-initializing
    const newForm = contactForm.cloneNode(true);
    contactForm.parentNode.replaceChild(newForm, contactForm);
    const formToUse = newForm;

    // Must re-query elements inside the cloned form
    const newSubmitBtn = formToUse.querySelector('#submit-btn');
    const newSubmitText = formToUse.querySelector('#submit-text');
    const newSubmitLoader = formToUse.querySelector('#submit-loader');

    formToUse.addEventListener('submit', async function (e) {
        e.preventDefault();

        // 1. UI: Disable button & show loader
        if (newSubmitBtn) newSubmitBtn.disabled = true;
        if (newSubmitText) newSubmitText.classList.add('hidden');
        if (newSubmitLoader) newSubmitLoader.classList.remove('hidden');

        // 2. Hide old messages
        if (formMessage) formMessage.classList.add('hidden');

        try {
            const formData = new FormData(formToUse);
            const url = formToUse.getAttribute('data-url');

            // 3. Send Request
            const response = await fetch(url, {
                method: 'POST',
                body: formData
            });

            // 4. Handle Response
            const result = await response.json();

            // Set main message text
            if (formMessageText) formMessageText.textContent = result.message;

            if (result.success) {
                // Success State
                if (formMessage) {
                    formMessage.className = 'mb-6 p-4 rounded-lg bg-green-100 border border-green-400 text-green-800';
                    formMessage.classList.remove('hidden');
                }

                // Reset form
                formToUse.reset();
            } else {
                // Error State
                if (formMessage) {
                    formMessage.className = 'mb-6 p-4 rounded-lg bg-red-100 border border-red-400 text-red-800';
                    formMessage.classList.remove('hidden');
                }

                // Show granular validation errors if any
                if (result.data && result.data.errors && formMessageText) {
                    const errorList = document.createElement('ul');
                    errorList.className = 'mt-2 ml-4 list-disc';
                    result.data.errors.forEach(error => {
                        const li = document.createElement('li');
                        li.textContent = error;
                        errorList.appendChild(li);
                    });
                    formMessageText.appendChild(errorList);
                }
            }

            // Scroll to message
            if (formMessage) formMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

        } catch (error) {
            console.error('Contact Form Error:', error);
            if (formMessageText) formMessageText.textContent = 'An unexpected error occurred. Please try again later.';
            if (formMessage) {
                formMessage.className = 'mb-6 p-4 rounded-lg bg-red-100 border border-red-400 text-red-800';
                formMessage.classList.remove('hidden');
                formMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        } finally {
            // 5. Cleanup UI
            if (newSubmitBtn) newSubmitBtn.disabled = false;
            if (newSubmitText) newSubmitText.classList.remove('hidden');
            if (newSubmitLoader) newSubmitLoader.classList.add('hidden');
        }
    });

    console.log('Contact form initialized.');
};
