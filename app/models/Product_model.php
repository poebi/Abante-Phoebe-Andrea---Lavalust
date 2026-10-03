<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Product_model extends Model
{
    protected $table = 'products';

    public function __construct()
    {
        parent::__construct();
        $this->call->database();
    }

    public function all()
    {
        return $this->db->table($this->table)->get_all();
    }

    public function find($id)
    {
        return $this->db->table($this->table)->where('id', $id)->get();
    }

    public function insert(array $data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function update_by_id($id, array $data)
    {
        return $this->db->table($this->table)->where('id', $id)->update($data);
    }

    public function delete_by_id($id)
    {
        return $this->db->table($this->table)->where('id', $id)->delete();
    }
}
