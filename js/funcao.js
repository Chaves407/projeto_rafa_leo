// Adiciona a formatação do número de telefone enquanto o usuário digita
$(document).ready(function() {
    $('#TelefoneContato').on('input', function() {
        var telefone = $(this).val().replace(/\D/g, ''); // Remove caracteres não numéricos
        var formattedTelefone = formatarTelefone(telefone);
        $(this).val(formattedTelefone);
    });
});

// Função para formatar o número de telefone
function formatarTelefone(telefone) {
    var formattedTelefone = '(' + telefone.substr(0, 2) + ') ' +
                            telefone.substr(2, 5) + '-' +
                            telefone.substr(7, 5);
    return formattedTelefone;
}