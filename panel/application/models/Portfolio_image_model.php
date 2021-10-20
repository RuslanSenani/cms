<?php


class Portfolio_image_model extends CI_Model
{
    public $tableName = "portfolio_images";
    public function __construct()
    {
        parent::__construct();
    }

    /*Butun qeyidleri getirecek olan metod.. */
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
