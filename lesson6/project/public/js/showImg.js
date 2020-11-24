
function handleFileSelect(event){
    console.dir(event);

    let file = event.target.files[0];

    let reader = new FileReader();

    // Closure to capture the file information.
    reader.onload = (function(theFile) {
        return function(e) {
            let img = document.getElementById('uploadImage');
            console.dir(img);
            img.src = e.target.result;
        };
    })(file);

    // Read in the image file as a data URL.
    reader.readAsDataURL(file);
}

document.getElementsByName('img')[0].addEventListener('change', handleFileSelect, false);