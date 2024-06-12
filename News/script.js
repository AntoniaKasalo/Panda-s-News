document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('header');
    const images = ['Slike/CatDog.jpg', 'Slike/white-bengal-tiger-nature.jpg', 'Slike/giraffe1.jpg', 'Slike/moose.jpg','Slike/cat2.jpg','Slike/bunny1.jpg','Slike/panda2.jpg','Slike/giraffe2.jpg','Slike/cat1.jpg','Slike/moose2.jpg','Slike/bunny2.jpg'];
    let currentImageIndex = 0;

    function changeBackgroundImage() {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        header.style.opacity = 0.5;
        setTimeout(() => {
            header.style.backgroundImage = `url('${images[currentImageIndex]}')`;
            header.style.opacity = 1;
        }, 500);
    }

    setInterval(changeBackgroundImage, 6000);
});
