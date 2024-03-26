
function validaCPF(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;
    
  if (strCPF == "00000000000") return false;

  for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
  Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

  Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
    return true;
}


$(document).ready(function(){
    if ($('.cpf').length > 0) {
            
        $('.cpf').mask('999.999.999-99', {reverse: true});
        $(".cpf").change(function(e){
            const cpf = $(this).val().replaceAll('.','').replace('-','');
            if ( ! validaCPF(cpf ) ){
                alert('CPF incorreto!');
                e.preventDefault();
                $(this).focus();
            }
            return true;
        })


    }


});


$(document).on('click',".imprimir_cautela",imprimirCautela );
$(document).on('click',".baixar_cautela",baixarCautela );

function imprimirCautela(event){    
    event.preventDefault();
    const url =  $(this).parent().prop('href');  
    fetch(url)
    .then(response => response.text())
    .then(html => {
        let w = window.open();
        let doc = w.document;
        doc.open();
        doc.write(html);
        doc.close();
        w.setTimeout(() => {
            w.print();
            w.close();
        }, 1000); // Espera 1 segundo antes de imprimir para garantir que o CSS seja aplicado
    })
    .catch(error => console.error('Erro ao carregar a página:', error));

    
    
}

function baixarCautela(event){    
    event.preventDefault();
    
    if (! confirm("Deseja realmnte baixar essa cautela?")) return false;

    const url =  $(this).parent().prop('href');  
    $.ajax({
        url: url,
        success: function(resposta){
            if (resposta == 1){
                alert('Cautela baixada com sucesso!');
                window.location.reload();
            }
        }
    })
}