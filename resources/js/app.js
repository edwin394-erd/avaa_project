require('./bootstrap');
import 'flowbite';
import ApexCharts from 'apexcharts' 
import Dropzone from "dropzone";
Dropzone.autoDiscover = false;
if(document.getElementById("dropzone")) {
    let imagenesSubidas = [];

    const dropzone = new Dropzone(".dropzone", {
        dictDefaultMessage: "Sube tus evidencias aqui",
        acceptedFiles: ".png,.jpg,.jpeg,.gif",
        addRemoveLinks: true,
        dictRemoveFile: "Borrar archivo",
        dictMaxFilesExceeded: "No puedes agregar más de un archivo",
        dictCancelUpload: "Cancelar",
        dictCancelUploadConfirmation: "¿Estas seguro de quieres cancelar la subida de esta imagen?",
        parallelUploads: 5,
        maxFiles: 5,
        uploadMultiple: true,
        maxFilesize: 2, // MB

        init: function(){
            // ...tu código para mostrar imágenes ya subidas...
        }
    });

    dropzone.on('success', function(file, response){
        // Si tu backend responde con { imagenes: [...] }
        if (response.imagenes) {
            imagenesSubidas = imagenesSubidas.concat(response.imagenes);
        } else if (response.imagen) {
            imagenesSubidas.push(response.imagen);
        }
        document.querySelector('[name="imagen"]').value = JSON.stringify(imagenesSubidas);
        // Guarda el nombre en el file para poder borrarlo después
        file.nombreImagen = response.imagenes ? response.imagenes[0] : response.imagen;
    });

    dropzone.on('removedfile', function(file) {
        // Elimina el nombre de la imagen asociada a este file
        if (file.nombreImagen) {
            imagenesSubidas = imagenesSubidas.filter(img => img !== file.nombreImagen);
            document.querySelector('[name="imagen"]').value = JSON.stringify(imagenesSubidas);
        }
    });

    dropzone.on('error', function(file, message){
        console.log(message);
    });
}

