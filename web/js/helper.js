
$(document).on('click','.add_multiplo', function(e){
    e.preventDefault();
    if (  $(this).parent().parent().find('.multiplo_destino li[data-id="'+$(this).parent().parent().find('.multiplo_origem .selecionado').data('id')+'"]').length ){
       alert("Item já adicionado!");
       return true;
    }
    $(this).parent().parent().find('.multiplo_destino').append(  $(this).parent().parent().find('.multiplo_origem .selecionado') );
    $(this).parent().parent().find('.multiplo_destino_id').val(
            $(this).parent().parent().find('.multiplo_destino li').map(function(){
                    return $(this).data('id')
            }).get().join(',') 
        );
    });

    $(document).on('click','.del_multiplo', function(e){
    e.preventDefault();
    if ( ! confirm('Deseja realmente remover? ') ) {
        return ;
    }

    if (  $(this).parent().parent().find('.multiplo_origem li[data-id="'+$(this).parent().parent().find('.multiplo_destino .selecionado').data('id')+'"]').length == 0){        
       $(this).parent().parent().find('.multiplo_origem').append(  $(this).parent().parent().find('.multiplo_destino .selecionado') );
    }else{
        $(this).parent().parent().find('.multiplo_destino .selecionado').remove();
    }
    
    $(this).parent().parent().find('.multiplo_destino_id').val(
            $(this).parent().parent().find('.multiplo_destino li').map(function(){
                    return $(this).data('id');
            }).get().join(',') 
        );
        
    });


    $(document).on('dblclick','.multiplo_origem', function(e){
         $(".add_multiplo").click();
    });

    

   
    $(document).on("click",'.multiplo li', function () {            
        $(".multiplo li").removeClass('selecionado');
        $(this).attr('class', 'selecionado');
    
    });

    $(".multiplo_destino option").each(function(){    
        $(this).parent().parent().parent().find('.multiplo_origem option[value="'+$(this).val()+'"]').remove();
    });

    