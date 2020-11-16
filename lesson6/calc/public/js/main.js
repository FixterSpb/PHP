"use strict";

function selectOption(act){
    let option = document.querySelectorAll('option');
    option.forEach(el => {
        if (el.value === act) {
            el.selected = true;
        }else{
            el.selected = false;
        }
    })
}

function keyUp(event){
    switch (event.key){
        case ('x'):
        case ('*'):
        case('X'):
            selectOption('x');
            break;
        case ('-'):
            selectOption('-');
            break;
        case ('/'):
            selectOption('/');
            break;
        case ('+'):
            selectOption('+');
            break;
    }
}

document.addEventListener("keyup", keyUp);
// document.addEventListener('keypress', keyPress);

