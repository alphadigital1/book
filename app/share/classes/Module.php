<?php
/**
 * Description: Module class
 *
 * author: Daniel Yamada
 */

require_once VCLASSES."Connection.php";  
require_once VCLASSES."Crud.php"; 

class Module {

    private $pdo;
    private $crud;
    private static $module;  
 
    protected $table = 'ial360.sys_modules';
    protected $save_id=0;

    //table columns
    protected $id;
    protected $name;
    protected $description='';

    protected $active='Y';
    protected $created;
    protected $createdby;
    protected $modified;
    protected $modifiedby;

    public function setSaveId( $var ) {
        $this->save_id = $var;
    }
    public function setId( $var ) {
        $this->id = $var;
    }
    public function getId() {
        return $this->id;
    }
    public function setName( $var ) {
        $this->name = $var;
    }
    public function getName() {
        return $this->name;
    }
    public function setDescription( $var ) {
        $this->description = $var;
    }
    public function getDescription() {
        return $this->description;
    }

    public function setActive( $var ) {
        $this->active = $var;
    }
    public function getActive() {
        return $this->active;
    }
    public function setCreated( $var ) {
        $this->created = $var;
    }
    public function getCreated() {
        return $this->created;
    }
    public function setCreatedBy( $var ) {
        $this->createdby = $var;
    }
    public function getCreatedBy() {
        return $this->createdby;
    }
    public function setModified( $var ) {
        $this->modified = $var;
    }
    public function getModified() {
        return $this->modified;
    }
    public function setModifiedBy( $var ) {
        $this->modifiedby = $var;
    }
    public function getModifiedBy() {
        return $this->modifiedby;
    }

    private function __construct(){   
        $this->pdo = Connection::getInstance();  
        $this->crud = Crud::getInstance($this->pdo, $this->table);
    }  
  
    public static function getInstance()
    {  
        if(!isset(self::$module)) {
            try {   
               self::$module = new Module();
            } catch (Exception $e) {
               echo "Erro: ".$e->getMessage();
            }   
        }   
        return self::$module;   
    }
   
    public static function createTable()
    {
        $sql = "CREATE TABLE `sys_modules` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(100) NOT NULL,
            `description` text,
            `active` char(1) NOT NULL DEFAULT 'Y',
            `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `createdby` int(11) NOT NULL DEFAULT '0',
            `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
            `modifiedby` int(11) DEFAULT '0',
            PRIMARY KEY (`id`)
           ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8";
    }

    public function insert()
    {
		$this->crud->setTablename($this->table);
        $array = array('name'=> $this->name, 'description'=> $this->description, 'createdby' => $this->save_id, );
        $result = $this->crud->insert($array);

        if($result){
            $id = $this->selectGeneric("SELECT LAST_INSERT_ID() as lastId", NULL, NULL);
            return $id['lastId'];
        }
        return 0;
    }
    
    public function update()
    {
        $this->crud->setTablename($this->table);
        $array = array('name'=> $this->name, 'description'=> $this->description, 'active'=> $this->active, 'modifiedby'=> $this->save_id, );
        $condition = array('id=' => $this->id);  
        return $this->crud->update($array, $condition); 
    }

    public function delete()
    {
		$this->crud->setTablename($this->table);
        if($this->id == 0)
            return 0;
        $condition = array('id=' => $this->id, );
        return $this->crud->delete($condition);
    }
     
    public function selectAll($c=NULL)
    {
        $conditions = "";
        if (!empty($c))
           $conditions = "WHERE {$c}";
        $sql = "SELECT * FROM {$this->table} {$conditions} ";
        return $this->crud->getSQLGeneric($sql, NULL, TRUE);
    }

    public function select($c=NULL)
    {
        $conditions = "";
        if (!empty($c))
           $conditions = "WHERE {$c}";
        $sql = "SELECT * FROM {$this->table} {$conditions} LIMIT 1";
        return $this->crud->getSQLGeneric($sql, NULL, TRUE);
    }

    public function selectGeneric($sql, $parameters, $fetch)
    {
        return $this->crud->getSQLGeneric($sql, $parameters, $fetch);
    }
    
    
    public function reset()
    {
        $this->id = 0;
        $this->name = '';
        $this->description = '';
    
        $this->active = '';
        $this->created = '';
        $this->createdby = $this->save_id;
        $this->modified = '';
        $this->modifiedby = $this->save_id;
    }

}

?>