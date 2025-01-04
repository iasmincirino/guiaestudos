// Icon de menu da navbar

$(document).ready(function(){
    $('#icon').click(function(){
    $('ul').toggleClass('show');
    });
});


// Botão do toggle
var btn = document.getElementById('btn');
var contentCriancas = document.getElementById('content-criancas');
var contentAdolescentes = document.getElementById('content-adolescentes');

function leftClick() {
    btn.style.left = '0';
    contentCriancas.style.display = 'block';
    contentAdolescentes.style.display = 'none';
}

function rightClick() {
    btn.style.left = '140px';
    contentCriancas.style.display = 'none';
    contentAdolescentes.style.display = 'block';
}
