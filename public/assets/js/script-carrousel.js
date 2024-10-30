let count = 1;
const totalSlides = 3; // Total de slides que você possui

document.getElementById("radio1").checked = true;

setInterval(function() {
    nextImage();
}, 5000); // Altera a imagem a cada 5 segundos

function nextImage() {
    count++;
    if (count > totalSlides) { // Verifica se o contador excede o número total de slides
        count = 1; // Reseta o contador para o primeiro slide
    }

    document.getElementById("radio" + count).checked = true; // Marca o rádio correspondente ao slide atual
}