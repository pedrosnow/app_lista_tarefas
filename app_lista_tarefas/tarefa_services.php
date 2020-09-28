<?php

class TarefaServeces{

    private $conexao;
    private $tarefa;

    public function __construct(conexao $conexao, Tarefa $tarefa){
        $this->conexao = $conexao->conectar();
        $this->tarefa = $tarefa;
    }
    public function inserir(){
        $query = 'INSERT INTO tb_tarefas(tarefa)VALUES(:tarefa)';
        $stmt =  $this->conexao->prepare($query);
        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->execute();
    }
    public function recuperar(){
        $query = '
            SELECT 
                tb_tarefas.id, tb_status.status, tb_tarefas.tarefa 
            FROM 
                tb_tarefas
                left join tb_status on tb_tarefas.id_status =  tb_status.id
        ';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function atualizar(){
        $query = 'UPDATE tb_tarefas SET tarefa = :tarefa WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->bindValue(':id', $this->tarefa->__get('id'));
        return $stmt->execute();
    
       
    }
    public function remover(){
        $query = 'DELETE FROM tb_tarefas WHERE id = :id';
        $stmt =  $this->conexao->prepare($query);
        $stmt->bindValue(':id', $this->tarefa->__get('id'));
        $stmt->execute();

    }
    public function MarcarRealizada(){
        $query = 'UPDATE tb_tarefas SET id_status = :tarefa WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tarefa', $this->tarefa->__get('id_status'));
        $stmt->bindValue(':id', $this->tarefa->__get('id'));
        return $stmt->execute();
    }public function recuperarTarefasPendentes(){
        $query = '
        SELECT 
            tb_tarefas.id, tb_status.status, tb_tarefas.tarefa 
        FROM 
            tb_tarefas
            left join tb_status on tb_tarefas.id_status =  tb_status.id 
        WHERE
            tb_tarefas.id_status = :id_status
        ';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}