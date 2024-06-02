document.addEventListener('DOMContentLoaded', () => {
    const titleInput = document.querySelector('#title');
    const aboutInput = document.querySelector('#about');
    const contentInput = document.querySelector('#content');
    const photoInput = document.querySelector('#pphoto');

    const titlePreview = document.querySelector('#title-preview');
    const aboutPreview = document.querySelector('#about-preview');
    const contentPreview = document.querySelector('#content-preview');
    const imagePreview = document.querySelector('#image-preview');

    titleInput.addEventListener('input', () => {
        titlePreview.textContent = titleInput.value || 'Title';
    });

    aboutInput.addEventListener('input', () => {
        aboutPreview.textContent = aboutInput.value || 'Short description will appear here.';
    });

    contentInput.addEventListener('input', () => {
        contentPreview.textContent = contentInput.value || 'Content will appear here.';
    });

    photoInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    });
});
