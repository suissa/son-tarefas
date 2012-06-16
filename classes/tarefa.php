<?php
include 'conexao.php';
class Tarefa extends Conexao{

	private $_id;
	private $UsuarioID;
	private $Usuario;
	private $Tarefa;
	private $Tipo;
	private $Prioridade;

	public function __set($name, $value){
        $this->$name = $value;
    }

    public function __get($name){
    	return $this->$name;
    }

	public function consultar($_id){
		$mongo_id = new MongoID($_id);
		return $this->collection->findOne(array('_id' => $mongo_id));
	}
	
	public function listar($filter){
		return $this->collection->find($filter);
	}
	
	public function inserir(){
		$this->query = array(
			'UsuarioID'  => $this->UsuarioID,
			'Usuario'    => $this->Usuario,
			'Tarefa'     => $this->Tarefa,
			'Tipo'       => $this->Tipo,//Obrigatório, idéia, outro
			'Prioridade' => $this->Prioridade
		);
		$this->collection->insert($this->query);
	}
	
	public function mudar_tarefa(){
		$this->mongo_id = new MongoID($this->_id);
		$this->collection->update(array('_id' => $this->mongo_id), array('$set' => array('Tarefa' => $this->Tarefa)), true);
	}
	
	public function mudar_prioridade(){
		$this->mongo_id = new MongoID($this->_id);
		
		if($this->modo=='up'){
			$this->collection->update(array('_id' => $this->mongo_id), array('$inc' => array('Prioridade' => 1)), false);
		}elseif($this->modo=='down'){
			$this->collection->update(array('_id' => $this->mongo_id), array('$inc' => array('Prioridade' => -1)), false);
		}
	}
	
	public function excluir(){
		$this->mongo_id = new MongoID($this->_id);
		$this->collection->remove(array('_id' => $this->mongo_id));
	}
}
?>