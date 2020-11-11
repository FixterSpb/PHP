'use sctrict';

const removeContainer = function(event){
    let container = document.querySelector('#container');
    container.remove();
    let gallery = document.querySelector('#gallery');
    gallery.style.display = 'block';
}

const linkOnClick = function(event){

    event.preventDefault();
    event.stopPropagation();

    let body = document.querySelector('body');
    let gallery = body.querySelector('#gallery');
    gallery.style.display = 'none';
    let container = document.createElement('div');
    container.id = 'container';

    with (container.style) {
        position = 'absolute';
        minwidth = '100vw';
        minheight = '100vh';
        width = '100%';
        height = '100%';
        top = '0';
        left = '0';
        backgroundColor = '#7e7e7e';
        textAlign = 'center';
    }

    let img = document.createElement('img');
    img.src = event.target.src;
    container.append(img);
    body.append(container);
    container.addEventListener('click', removeContainer);
}

let links = [];
links = document.querySelectorAll('a');

links.forEach(item => {
    item.addEventListener('click', linkOnClick);
});