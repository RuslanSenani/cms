<?php


class Brand_model extends CI_Model
{
    public $tableName = "brands";
    public function __construct()
    {
        parent::__construct();
    }

    /*Butun qeyidleri getirecek olan metod.. */

    
    // public function front_read($table, $ar = array('id!=' => 0), $order = array('id', 'desc'), $limit = 1000000, $start = 0)
    // {
    //     $result = $this->db->where($ar)->order_by($order[0], $order[1])->limit($limit, $start)->get($table)->result_array();
    //     return $result != null ? $result : array();
    // }

    public function get_all($where = array(), $order = array('id', 'ASC'))
    {

        return $this->db->where($where)->order_by($order[0], $order[1])->get($this->tableName)->result();
    }

    public function insert($data = array())
    {
        return $this->db->insert($this->tableName, $data);
    }

    public function get($where = array())
    {
        return $this->db->where($where)->get($this->tableName)->row();
    }

    public function update($where = array(), $data = array())
    {
        return $this->db->where($where)->update($this->tableName, $data);
    }

    public function delete($where = array())
    {
        return $this->db->where($where)->delete($this->tableName);
    }
}
