$("#date").mask("99/99/9999");
$("#cpf").mask("999.999.999-99"); 
$('#birthday').mask("99/99/9999");
$('.harnessing').mask("999");
$("#success-alert").hide();
$("#error-alert").hide();

//inicia o tooltip
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$('.navbar-nav').on('click', 'li', function(){
    $('.navbar-nav li.active').removeClass('active');
    $(this).addClass('active');
});
var path = window.location.pathname.split("/").pop();
if(path = "")
{
    path = 'certificado';
}

var target = $('nav a[href="'+path+'"]');
target.addClass('active');

$('#cpf').keyup(
	function(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
    if ($(this).val().length == 14)
    {
    	$.ajax({    				
    		method: 'POST',
    		dataType: 'json',
    		url: '/get-student-by-cpf.json',
    		async: false,
    		data:{
    			'cpf': $(this).val()
    		},
    		success: function(r)
    		{    					
    			if(r)
    			{
    				$('#student_id').val(r.id);
    				$('#name').val(r.name);
    				$('#birthday').val(r.birthday.replace(/(\d*)-(\d*)-(\d*).*/, '$3/$2/$1')); 
    				$('#name').removeAttr('disabled');
    				$('#birthday').removeAttr('disabled');
    				$('#event').removeAttr('disabled');   						
    			}
    			else
    			{
    				$('#name').val("");    					
    				$('#birthday').val("");
    				$('#name').removeAttr('disabled');
    				$('#birthday').removeAttr('disabled');
    				$('#event').removeAttr('disabled');
    			}    					  					
           },
           error: function(r)
           {
              $('#error-cpf').html(r.cpf);
          }
        })
    }
})
    $('.save_certificate').click(function(e){
        var input = $(this).closest('tr').find('input');

        if(input[0].value == "")
        {
            //$("#error-alert").fadeTo(2000, 500).slideUp(500, function() {
            //    $("#error-alert").slideUp(500);
           // });      
          call_toast("erro", "Campo em branco.", "error");

        }
        else
        {
            save_certificate(input[0].value, input[1].value,input[2].value, input[3].value);
            input.prop("disabled", true);
        }
    });

    function save_certificate(harnessing, user_id, event_id, subscription_id)
    {
        if(harnessing)
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax(
            {
                method: 'POST',
                dataType: 'html',
                url : '/store_certificate',
                async: false,
                data :{
                    'harnessing': harnessing,
                    'user_id': user_id,
                    'event_id': event_id,
                    'subscription_id': subscription_id
                },
                success: function(r){
                    if (r == 'exist')
                    {
                        call_toast('erro', "Certificado já existe", "error");
                    }
                    if(r == 'sucess')
                    {
                       call_toast('salvo', "Certificado gerado", "success");
                    }
             },error: function (r){
                $('#error-alert').text("Houve um error ao salvar");
             }
         });
        }
    }

    function call_toast(head, message, icon)
    {
       $.toast({
            heading: head,
            text: message,
            position: 'top-right',
            stack: false,
            icon: icon
            })
    }


$(document).ready(function()
{
    $('.table-list').DataTable(
    {
    	"bInfo": false,
        "responsive": true,
    	"pageLength": 10,
    	"bLengthChange": false,
    	//se o usuário acesso o recurso, ordena pela coluna País,
    	// altera para visualizar apenas dois registros por página
    	// e navega para a última página. O usuário então encerra o expediente,
    	// desliga o PC e volta no dia seguinte para trabalhar. Ao acessar o
    	// recurso novamente, o DataTable irá carregar todas as informações do último acesso dele	
    	"bStateSave": true,	 	
    	language: 
    	{
    	 	search:   "Pesquisar",
    	 	"sEmptyTable": "Nenhum registro encontrado na tabela",
             paginate:
            {
                 first:    "Primeiro",
                 previous: "Anterior",
                 next:     "Próximo",
                 last:     "Último"                     
            },
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            }
        }		
    });   
});

//addiciona 100 a todos os campos visiveis de carga horaria
/*$('#set-100').click(function()
{
    var datas = [];
    $('.editable').text('100');   
    var table = $('#tb-editable').DataTable({
        "bDestroy": true,
    });
    table.column(1).data().each(function(data){
       datas.push(data);
       console.log($('#student_id').val());
       console.log(datas);
   });
});*/

//Modal para excluir certificado

$('#cancel_certificate').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var certificate = button.data('whatever')
    $('#certificate').val(certificate);

})

$('#modal_admin').on('show.bs.modal', function (event){ 
    var button = $(event.relatedTarget)
    var userid = button.data('whateverid')
    var username = button.data('whatevername')
    $('#user').val(userid);
    $('#user-name').text(username);
})

$('#accept-subscription').on('show.bs.modal', function(event)
{
    var button      = $(event.relatedTarget)
    var event_name  = button.data('whatevername');
    var event_id    = button.data('whateverid');
    var event_date  = button.data('whateverdate');
    $('#tb_event_id').val(event_id);
    $('#name-event').text(event_name);
    $('#date-event').text(event_date);
})

$('#send-signature').click(function()
{   
    signature = $('input[name=signature]:checked').val();
    $('#instructor-id').val(signature);
});