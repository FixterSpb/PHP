"use strict";


/*
    Дополнительная валидация полей ввода.
    Почему-то, несмотря на то, что поставил type="number",
    поле ввода не игнорирует нажатия "+" и "-"
 */
function inputValidate(el, ev){
    return !/[+-]/.test(ev.key);
}


function selectOption(action){
    let option = document.querySelectorAll('option');
    option.forEach(el => {
        if (el.value === action) {
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

    event.stopPropagation();
}

document.addEventListener("keyup", keyUp);