<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Itemmenu_data_model extends CI_Model
{
  public $table = 'itemmenu_data';
  public $id    = 'id_itemmenu_data';
  public $order = 'DESC';

  // get all
  function get_all()
  {
    return $this->db->get($this->table)->result();
  }

  function get_combo_itemmenu_data()
  {
    $this->db->order_by('itemmenu', 'ASC');
    $query = $this->db->get($this->table);

    if($query->num_rows() > 0){
      $data = array();
      foreach ($query->result_array() as $row)
      {
        $data[$row['itemmenu']] = $row['itemmenu'];
      }
      return $data;
    }
  }

  function get_all_new_home()
  {
    $this->db->limit(4);
    $this->db->order_by($this->id, $this->order);
    return $this->db->get($this->table)->result();
  }

  function get_all_itemmenu_data_sidebar()
  {
    $this->db->order_by('itemmenu', 'asc');
    return $this->db->get($this->table)->result();
  }

  function get_total_row_itemmenu_data()
  {
    return $this->db->get($this->table)->count_all_results();
  }

  function get_by_id($id)
  {
    $this->db->where($this->id, $id);
    return $this->db->get($this->table)->row();
  }

  // get total rows
  function total_rows()
  {
    return $this->db->get($this->table)->num_rows();
  }

  function insert($data)
  {
    $this->db->insert($this->table, $data);
  }

  function update($id, $data)
  {
    $this->db->where($this->id,$id);
    $this->db->update($this->table, $data);
  }

  function delete($id)
  {
    $this->db->where($this->id, $id);
    $this->db->delete($this->table);
  }

}

/* End of file Itemmenu_data_model.php */
/* Location: ./application/models/Itemmenu_data_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-10-17 02:19:21 */
/* http://harviacode.com */
