// scripts.js
$(document).ready(function() {
    // Carregar as tarefas ao carregar a página
    carregarTarefas();

    // Função para carregar as tarefas
    function carregarTarefas() {
        $.ajax({
            url: 'read_tasks.php',
            success: function(data) {
                var tarefas = JSON.parse(data);

                // Limpar a tabela de tarefas
                $('#lista_tarefas tbody').empty();

                // Adicionar cada tarefa na tabela
                tarefas.forEach(function(tarefa) {
                    var row = '<tr>' +
                              '<td>' + tarefa.titulo + '</td>' +
                              '<td>' + tarefa.descricao + '</td>' +
                              '<td>' + tarefa.data_criacao + '</td>' +
                              '<td>' + tarefa.status + '</td>' +
                              '<td><button class="btn-editar" data-id="' + tarefa.id + '">Editar</button></td>' +
                              '<td><button class="btn-deletar" data-id="' + tarefa.id + '">Deletar</button></td>' +
                              '</tr>';
                    $('#lista_tarefas tbody').append(row);
                });

                // Configurar evento para botões de editar
                $('.btn-editar').click(function() {
                    var idTarefa = $(this).data('id');
                    abrirModalEditar(idTarefa);
                });

                // Configurar evento para botões de deletar
                $('.btn-deletar').click(function() {
                    var idTarefa = $(this).data('id');
                    deletarTarefa(idTarefa);
                });
            },
            error: function(xhr, status, error) {
                console.error('Erro ao carregar tarefas:', error);
            }
        });
    }

    // Função para abrir modal de edição com os dados da tarefa
    function abrirModalEditar(idTarefa) {
        $.ajax({
            url: 'get_task.php',
            type: 'POST',
            data: { id: idTarefa },
            success: function(response) {
                var tarefa = JSON.parse(response);
                $('#modalEditar #editar_id').val(tarefa.id);
                $('#modalEditar #editar_titulo').val(tarefa.titulo);
                $('#modalEditar #editar_descricao').val(tarefa.descricao);
                $('#modalEditar #editar_status').val(tarefa.status);

                $('#modalEditar').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Erro ao obter detalhes da tarefa:', error);
            }
        });
    }

    // Evento para submeter o formulário de edição de tarefa
    $('#form_editar_tarefa').submit(function(event) {
        event.preventDefault();

        var id = $('#editar_id').val();
        var titulo = $('#editar_titulo').val();
        var descricao = $('#editar_descricao').val();
        var status = $('#editar_status').val();

        $.ajax({
            type: 'POST',
            url: 'update_task.php',
            data: {
                id: id,
                titulo: titulo,
                descricao: descricao,
                status: status
            },
            success: function(response) {
                alert(response);
                $('#modalEditar').modal('hide');
                carregarTarefas(); // Recarregar a lista de tarefas após editar
            },
            error: function(xhr, status, error) {
                console.error('Erro ao atualizar tarefa:', error);
            }
        });
    });

    // Evento para adicionar uma nova tarefa
    $('#form_adicionar_tarefa').submit(function(event) {
        event.preventDefault();

        var titulo = $('#titulo').val();
        var descricao = $('#descricao').val();

        $.ajax({
            type: 'POST',
            url: 'create_task.php',
            data: { titulo: titulo, descricao: descricao },
            success: function(response) {
                alert(response);
                carregarTarefas(); // Recarregar a lista de tarefas após adicionar
                $('#titulo').val('');
                $('#descricao').val('');
            },
            error: function(xhr, status, error) {
                console.error('Erro ao adicionar tarefa:', error);
            }
        });
    });
    function abrirModalEditar(idTarefa) {
        $.ajax({
            url: 'get_task.php',
            type: 'POST',
            data: { id: idTarefa },
            success: function(response) {
                var tarefa = JSON.parse(response);
                $('#editar_id').val(tarefa.id);
                $('#editar_titulo').val(tarefa.titulo);
                $('#editar_descricao').val(tarefa.descricao);
                $('#editar_status').val(tarefa.status);
    
                $('#modalEditar').show(); // Mostrar o modal
            },
            error: function(xhr, status, error) {
                console.error('Erro ao obter detalhes da tarefa:', error);
            }
        });
    }
    
    // Evento para fechar o modal
    $('.close').click(function() {
        $('#modalEditar').hide(); // Fechar o modal ao clicar no botão de fechar
    });
    $('#form_editar_tarefa').submit(function(event) {
        event.preventDefault();
    
        var id = $('#editar_id').val();
        var titulo = $('#editar_titulo').val();
        var descricao = $('#editar_descricao').val();
        var status = $('#editar_status').val();
    
        $.ajax({
            type: 'POST',
            url: 'update_task.php',
            data: {
                id: id,
                titulo: titulo,
                descricao: descricao,
                status: status
            },
            success: function(response) {
                alert(response);
                $('#modalEditar').hide(); // Esconder o modal após a edição
                carregarTarefas(); // Recarregar a lista de tarefas após editar
            },
            error: function(xhr, status, error) {
                console.error('Erro ao atualizar tarefa:', error);
            }
        });
    });
    $('#lista_tarefas').on('click', '.btn-editar', function() {
        var idTarefa = $(this).data('id');
        abrirModalEditar(idTarefa);
    });
    // Função para deletar uma tarefa
    function deletarTarefa(idTarefa) {
        if (confirm('Tem certeza que deseja deletar esta tarefa?')) {
            $.ajax({
                type: 'POST',
                url: 'delete_task.php',
                data: { id: idTarefa },
                success: function(response) {
                    alert(response);
                    carregarTarefas(); // Recarregar a lista de tarefas após deletar
                },
                error: function(xhr, status, error) {
                    console.error('Erro ao deletar tarefa:', error);
                }
            });
        }
    }
});
