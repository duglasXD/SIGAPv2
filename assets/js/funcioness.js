function validarCampos()
{
    var aux = 0;
    alert("si entra");

    if ($("#sapasociacion_nombreAsociacion").val() == "")
    {
        $("#1").addClass("has-danger");
        aux = 1;
    } else {
        $("#1").addClass("has-success");
    }
    if ($("#sapasociacion_numeroAsociacion").val() == "")
    {
        $("#2").addClass("has-danger");
        aux = 1;
    } else {
        $("#2").addClass("has-success");
    }
    if ($("#sapasociacion_siglasAsociacion").val() == "")
    {
        $("#3").addClass("has-danger");
        aux = 1;
    } else {
        $("#3").addClass("has-success");
    }
    if ($("#sapasociacion_tipoAsociacion").val() == "")
    {
        $("#4").addClass("has-danger");
        aux = 1;
    } else {
        $("#4").addClass("has-success");
    }
    if ($("#sapasociacion_institucionPerteneceAsociacion").val() == "")
    {
        $("#5").addClass("has-danger");
        aux = 1;
    } else {
        $("#5").addClass("has-success");
    }
    if ($("#sapasociacion_idSapAsociaciones").val() == "")
    {
        $("#6").addClass("has-danger");
        aux = 1;
    } else {
        $("#6").addClass("has-success");
    }
    if ($("#sapasociacion_idMunicipio").val() == "")
    {
        $("#7").addClass("has-danger");
        aux = 1;
    } else {
        $("#7").addClass("has-success");
    }
    if ($("#sapasociacion_sectorAsociacion").val() == "")
    {
        $("#8").addClass("has-danger");
        aux = 1;
    } else {
        $("#8").addClass("has-success");
    }
    if ($("#sapasociacion_numeroDiarioOficialAsociacion").val() == "")
    {
        $("#9").addClass("has-danger");
        aux = 1;
    } else {
        $("#9").addClass("has-success");
    }
    if ($("#sapasociacion_claseAsociacion").val() == "")
    {
        $("#10").addClass("has-danger");
        aux = 1;
    } else {
        $("#10").addClass("has-success");
    }
    if ($("#sapasociacion_tomoDiarioOficial").val() == "")
    {
        $("#11").addClass("has-danger");
        aux = 1;
    } else {
        $("#11").addClass("has-success");
    }
    if ($("#sapasociacion_fechaConstitucionAsociacion").val() == "")
    {
        $("#12").addClass("has-danger");
        aux = 1;
    } else {
        $("#12").addClass("has-success");
    }
    if ($("#sapasociacion_cuotaAsociacion").val() == "")
    {
        $("#13").addClass("has-danger");
        aux = 1;
    } else {
        $("#13").addClass("has-success");
    }
    if ($("#sapasociacion_fechaPersonalidadJuridicaAsociacion").val() == "")
    {
        $("#14").addClass("has-danger");
        aux = 1;
    } else {
        $("#14").addClass("has-success");
    }
    if ($("#sapasociacion_emailAsociacion").val() == "")
    {
        $("#15").addClass("has-danger");
        aux = 1;
    } else {
        $("#15").addClass("has-success");
    }
    if ($("#sapasociacion_fechaPublicacionDiarioOficial").val() == "")
    {
        $("#16").addClass("has-danger");
        aux = 1;
    } else {
        $("#16").addClass("has-success");
    }
    if ($("#sapasociacion_lemaAsociacion").val() == "")
    {
        $("#17").addClass("has-danger");
        aux = 1;
    } else {
        $("#17").addClass("has-success");
    }
    if ($("#sapasociacion_telefonoAsociacion").val() == "")
    {
        $("#18").addClass("has-danger");
        aux = 1;
    } else {
        $("#18").addClass("has-success");
    }
    if ($("#sapasociacion_descripcionEmblemaAsociacion").val() == "")
    {
        $("#19").addClass("has-danger");
        aux = 1;
    } else {
        $("#19").addClass("has-success");
    }
    if ($("#sapasociacion_direccionAsociacion").val() == "")
    {
        $("#20").addClass("has-danger");
        aux = 1;
    } else {
        $("#20").addClass("has-success");
    }
    if ($("#actividadasociacion").val() == "")
    {
        $("#21").addClass("has-danger");
        aux = 1;
    } else {
        $("#21").addClass("has-success");
    }
    alert(aux);
    return aux;
}