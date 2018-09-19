/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* Validaciones de  SapAsociacion (editSapAsociacion) */
$(document).ready(function(){

   $("#date").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
   $("#phone").mask("(999) 999-9999");
   
   
   $('.cuota').mask('000.000.000.000.000,00', {reverse: true});/* Cuota Asociacion */
   $('.NumeroDiario').mask('00000000');/* Numero Diario Oficial*/
   $('.TomoDiario').mask('00000000');/* Tomo Diario Oficial*/
   $('.Email').mask({regex: "[a-zA-Z0-9 ._% -] + @ [a-zA-Z0-9 -] + \\ [a-zA-Z. ] {2,4} "});/* Email Asociacion*/
   $('.Telefono').mask('0000-0000');/* Telefono Diario Oficial*/
   $('.siglas').mask({regex:"[a-zA-Z]"});
   
});

/*-----------------------------------------------------*/
