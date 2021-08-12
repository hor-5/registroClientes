$("#btnEliminar").click(function () {
    Swal.fire({
        type: "error",
        title: "Eliminado",
        text: "Su registro fue eliminado con exito.",
        showConfirmButton: false,
        timer: 1000

    });
});
$("#btnLimpiar").click(function () {
    Swal.fire({
        type: "success",
        title: "Ha limpiado su listado con exito",        
        showConfirmButton: false,
        timer: 1000

    });
});

$("#btnAgregar").click(function () {
    var nombre = $("#txtNombre").val();
    var telefono = $("#txtTelefono").val();
    var correo = $("#txtCorreo").val();
    var dni = $("#txtDni").val();
    if( nombre != "" && telefono!= "" && correo != "" && dni!= ""){
    Swal.fire({
        type: 'success',
        title: 'Genial!',
        text: "Su nuevo registro ha sido agregado.",
        showConfirmButton: false,
          timer: 2000    
    });}
    else{
        Swal.fire({
            type: "warning",
            title: "Faltan completar datos",            
            showConfirmButton: false,
            timer: 1000
    
        });
    }
});

