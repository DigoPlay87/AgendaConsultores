function alertarEnvio(hora, pedido, valor, troco, pgto, tel, urlrel, obs, previsao, pago, data, horap){
	// console.log('teste' + hora)
	var valorFormatado = valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
	var trocoF = troco.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

	var linkrel = urlrel + "painel-balcao/rel/comprovante_class.php?codigo=" + data + "d" + horap;
	  
	let url = `https://api.whatsapp.com/send?phone=55${tel}&text=
		Seu Pedido de *Número ${pedido}* está sendo Preparado!%0A
		Horário do Pedido: ${hora}%0A
		Previsao de Entrega: ${previsao}%0A%0A
		Valor: ${valorFormatado} %0A
		Troco: ${trocoF} %0A
		Forma de Pagamento: ${pgto} %0A
		Pago: ${pago} %0A%0A
		*Observações do Pedido:* ${obs} %0A%0A%0A
		Link para Comprovante%0A%0A${linkrel} %0A
	`;

	var mensagemParaWpp = url.replace(/<b>/g, "*").replace(/<\/b>/g,"*"); 

	window.open(url);
}

function enviarWhatsPedido(hora, pedido, valor, troco, pgto, tel, urlrel, obs, previsao, pago, cliente, telefone, endereco, data, horap){
	// console.log('teste' + hora)
	var valorFormatado = valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
	var trocoF = troco.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

	var linkrel = urlrel + "painel-balcao/rel/comprovante_class.php?codigo=" + data + "d" + horap;
	  
	let url = `https://api.whatsapp.com/send?phone=55${tel}&text=
		Novo Pedido *Número ${pedido}* %0A
		Horário do Pedido: ${hora}%0A
		Previsao de Entrega: ${previsao}%0A%0A
		Valor: ${valorFormatado} %0A
		Troco: ${trocoF} %0A
		Forma de Pagamento: ${pgto} %0A
		*Pago: ${pago}* %0A%0A%0A
		*Dados do Cliente* %0A
		Nome: ${cliente} %0A
		Telefone: ${telefone} %0A
		Endereço: ${endereco} %0A%0A%0A
		*Observações do Pedido:* ${obs} %0A%0A%0A
		Link para Comprovante%0A%0A${linkrel} %0A
	`;

	var mensagemParaWpp = url.replace(/<b>/g, "*").replace(/<\/b>/g,"*"); 

	window.open(url);

}