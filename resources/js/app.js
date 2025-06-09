require("./bootstrap");
import Dropzone from "dropzone";
import "flowbite";
import ApexCharts from "apexcharts";

Dropzone.autoDiscover = false;

const dropzoneElement = document.querySelector(".dropzone");
if (dropzoneElement && !dropzoneElement.dropzone) {
    let imagenesSubidas = [];

    const dropzone = new Dropzone(dropzoneElement, {
        dictDefaultMessage: "Sube tus evidencias aqui (5 máx.)",
        acceptedFiles: ".png,.jpg,.jpeg,.gif",
        addRemoveLinks: true,
        dictRemoveFile: "Borrar archivo",
        dictMaxFilesExceeded: "No puedes agregar más de un archivo",
        dictCancelUpload: "Cancelar",
        dictCancelUploadConfirmation:
            "¿Estas seguro de quieres cancelar la subida de esta imagen?",
        parallelUploads: 5,
        maxFiles: 5,
        maxFilesize: 2, // MB

        init: function () {
            // ...tu código para mostrar imágenes ya subidas...
        },
    });

    dropzone.on("success", function (file, response) {
        if (response.imagenes) {
            imagenesSubidas = imagenesSubidas.concat(response.imagenes);
        } else if (response.imagen) {
            imagenesSubidas.push(response.imagen);
        }
        document.querySelector('[name="imagen"]').value =
            JSON.stringify(imagenesSubidas);
        file.nombreImagen = response.imagenes
            ? response.imagenes[0]
            : response.imagen;
    });

    dropzone.on("removedfile", function (file) {
        if (file.nombreImagen) {
            imagenesSubidas = imagenesSubidas.filter(
                (img) => img !== file.nombreImagen
            );
            document.querySelector('[name="imagen"]').value =
                JSON.stringify(imagenesSubidas);
        }
    });

    dropzone.on("error", function (file, message) {
        console.log(message);
    });

    dropzone.on("addedfile", function (file) {
        if (this.files.length > 5) {
            this.removeFile(file);
            alert("No puedes agregar más de 5 imágenes.");
        }
    });
}
