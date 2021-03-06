<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_desa_model extends CI_Model
{
  public $table = 'data_desa';
  public $id    = 'id_desa';
  public $order = 'DESC';

  // get all
  function get_all()
  {
    return $this->db->get($this->table)->result();
  }

  function get_combo_data_desa()
  {
    $this->db->order_by('nama_desa', 'ASC');
    $query = $this->db->get($this->table);

    if($query->num_rows() > 0){
      $data = array();
      foreach ($query->result_array() as $row)
      {
        $data[$row['nama_desa']] = $row['nama_desa'];
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

  function get_all_data_desa_sidebar()
  {
    $this->db->order_by('nama_desa', 'asc');
    return $this->db->get($this->table)->result();
  }

  function get_total_row_data_desa()
  {
    return $this->db->get($this->table)->count_all_results();
  }

  function get_by_id($id)
  {
    $this->db->where($this->id, $id);
    return $this->db->get($this->table)->row();
  }

  function get_by_id_front($id)
  {
    $this->db->from('detail_desa');
    $this->db->where('nama_desa_seo', $id);
    $this->db->join('nama_desa', 'detail_desa.nama_desa = data_desa.nama_desa');
    return $this->db->get();
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

/* End of file Data_desa_model.php */
/* Location: ./application/models/Data_desa_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-10-17 02:19:21 */
/* http://harviacode.com */
