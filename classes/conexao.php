<?php
class Conexao{
	public function __construct($banco = 'prioridades', $colecao = 'tarefas'){
		$nome_banco      = $banco;
		$nome_collection = $colecao;
		
		$this->conexao = new Mongo();
		$this->db = $this->conexao->$nome_banco;
		$this->collection = $this->db->$nome_collection;
		
	}
}
?>