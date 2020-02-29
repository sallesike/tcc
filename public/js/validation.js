$('#school').validate({

	rules: {
		name: {
			required: true,
		}
	},
	messages: {
		name: {
			required: 'Informe o nome da escola',
		}
	}
});

$("#event").validate({
	rules: {
		name: {
			required: true,
		},
		date: {
			required: true,
		},
		address: {
			required: true,
		},
		workload:{
			required: true,
		},
		min_workload:{
			required: true,
		},
		instructor_id:{
			required: true,
		}
	},
	messages: {
			name: {
				required : 'Informe um nome',
			},
			date: {
				required: 'Informe uma data'
			},
			address: {
				required: 'Informe um endereço'
			},
			workload: {
				required: 'Informe a carga o horária',				
			},
			min_workload: {
				required: 'Informe uma carga horária minima'
			},
			instructor_id: {
				required: 'Escolha a assinatura do instrutor'
			}
		}
	});

$("#find_certificate").validate({
	rules : 
	{
		cpf:{
			required : true,
		} 
	},
	messages:
	{
		cpf:{
			required: 'Houve um erro ao buscar por esse cpf, verifique-o.'
		}
	}
});

$('#instructor').validate({
	rules:
	{
		name:{
			required: true,		
			minlength: 3,				
		},		
	},
	messages:
	{
		name:
		{
			required: "É necessario informar o nome do instrutor do evento",
			name	: "O nome deve conter ao menos três caracteres"
		},
	}
});


