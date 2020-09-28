<?php
require '../../app_lista_tarefas/tarefa.model.php';
require '../../app_lista_tarefas/tarefa_services.php';
require '../../app_lista_tarefas/conexao.php';


$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

// echo $acao;


if($acao  == 'inserir'){

$tarefa = new Tarefa();
$tarefa->__set('tarefa', $_POST['tarefa']);
$conexao = new conexao();
$tarefaSerico = new TarefaServeces($conexao,$tarefa);
$tarefaSerico->inserir();
header('Location: nova_tarefa.php?inclusao=1');


}else if($acao == 'recuperar'){
    $tarefa = new Tarefa();
    $conexao = new conexao();
    $tarefaSerico = new TarefaServeces($conexao, $tarefa);
    // $tarefas é um array com todos os dados recebidos do Mysql
    $tarefas = $tarefaSerico->recuperar(); 


} else if($acao == 'atualizar') {
    
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_POST['id']);
    $tarefa->__set('tarefa', $_POST['tarefa']);
    $conexao = new conexao();
    $TarefaServico = new TarefaServeces($conexao, $tarefa);
    // validar atualização com o retorno de 1 pra atualizado com sucesso e 0 pra erro atualizar
   if($TarefaServico->atualizar()){


    if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
        header('Location: index.php');
    }else{
        header('Location: todas_tarefas.php');
    }

   

}

}else if($acao == 'remover'){

    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id']);
    $conexao = new conexao();
    $TarefaServico = new TarefaServeces($conexao, $tarefa);
    $TarefaServico->remover();
   


    if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
        header('Location: index.php');
    }else{
        header('Location: todas_tarefas.php');
    }



}else if($acao == 'chacked'){

    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id']);
    $tarefa->__set('id_status', 2);
    $conexao = new conexao();
    $TarefaServico = new TarefaServeces($conexao, $tarefa);
    $TarefaServico->MarcarRealizada();
   

    if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
        header('Location: index.php');
    }else{
        header('Location: todas_tarefas.php');
    }

}else if($acao == 'recuperarTarefaPendente'){
    
    $tarefa = new Tarefa();
    $tarefa->__set('id_status',  1);
    $conexao = new conexao();
    $tarefaSerico = new TarefaServeces($conexao, $tarefa);
    // $tarefas é um array com todos os dados recebidos do Mysql
    $tarefasPendentes = $tarefaSerico->recuperarTarefasPendentes(); 
}

?>