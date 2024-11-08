<?php 
namespace Model;
defined('ROOTPATH') OR exit('Access Denied!');

Trait Model
{
  use Database;

  // protected $table = 'users';

  protected $limit = 10;
  protected $offset = 0;
  protected $order_type = "desc";
  protected $order_column = "id";
  public $errors = [];

  public function findAll()
  {
    $query = "select * from $this->table order by $this->order_column $this->order_type limit $this->limit offset $this->offset";

    return $this->query($query);
  }

  /* ====== return multiple row of data ====== */
  public function where($data, $data_not = [])
  {
    $keys = array_keys($data);
    $keys_not = array_keys($data_not);
    $query = "select * from $this->table where ";

    foreach ($keys as $key){
      $query .= $key . " = :" . $key . " && ";
    }

    foreach ($keys_not as $key){
      $query .= $key . " != :" . $key . " && ";
    }

    $query = trim($query, " && ");

    $query .= " order by $this->order_column $this->order_type limit $this->limit offset $this->offset";

    $data = array_merge($data, $data_not);
    // echo $query;

    return $this->query($query, $data);
  }

   
  /* ====== return 1 row of data ====== */
  public function first($data, $data_not = [])
  {
    $keys = array_keys($data);
    $keys_not = array_keys($data_not);
    $query = "select * from $this->table where ";

    foreach ($keys as $key){
      $query .= $key . " = :" . $key . " && ";
    }

    foreach ($keys_not as $key){
      $query .= $key . " != :" . $key . " && ";
    }

    $query = trim($query, " && ");

    $query .= " limit $this->limit offset $this->offset";

    $data = array_merge($data, $data_not);
    // echo $query;

    $result = $this->query($query, $data);
    if($result)
      return $result[0];
    
    return false;
  }
   
  /* ====== INSERT ====== */
  public function insert($data)
  {
    /*  remove unwanted data */
    if(!empty($this->allowedColumns))
    {
      foreach($data as $key => $value){
        if(!in_array($key, $this->allowedColumns))
        {
          unset($data[$key]);
        }
      }
    }
    $keys = array_keys($data);

    $query = "insert into $this->table (".implode(",", $keys).") values (:".implode(",:", $keys).") ";

    // echo $query;
    $this->query($query, $data);

    return false;
  }

   
  /* ====== UPDATE ====== */
  public function update($id, $data, $id_column = 'id')
  {
    
    /*  remove unwanted data */
    if(!empty($this->allowedColumns))
    {
      foreach($data as $key => $value){
        if(!in_array($key, $this->allowedColumns))
        {
          unset($data[$key]);
        }
      }
    }
    $keys = array_keys($data);
    $query = "update $this->table set ";

    foreach ($keys as $key){
      $query .= $key . " = :" . $key . ", ";
    }

    $query = trim($query, ", ");

    $query .= "  where $id_column = :$id_column ";

    $data[$id_column] = $id;
    // echo $query;
    $this->query($query, $data);
    return false;
  }

   
  /* ====== DELETE ====== */
  public function delete($id, $id_column = 'id')
  {
    $data[$id_column] = $id;
    $query = "delete from $this->table where $id_column = :$id_column ";

    // echo $query;

    $this->query($query, $data);
  
    return false;
  }
   
}

 