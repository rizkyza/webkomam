<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori_jabatan_model extends CI_Model
{
  public $table = 'kategori_jabatan';
  public $id    = 'id_kategori_jabatan';
  public $order = 'DESC';

  // get all
  function get_all()
  {
    return $this->db->get($this->table)->result();
  }

  function get_combo_kategori_jabatan()
  {
    $this->db->order_by('nama_jabatan', 'ASC');
    $query = $this->db->get($this->table);

    if($query->num_rows() > 0){
      $data = array();
      foreach ($query->result_array() as $row) 
      {
        $data[$row['nama_jabatan']] = $row['nama_jabatan'];
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

  function get_all_kategori_jabatan_sidebar()
  {
    $this->db->order_by('nama_jabatan', 'asc');
    return $this->db->get($this->table)->result();
  }

  function get_total_row_kategori_jabatan()
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
    $this->db->from('data_pejabat');
    $this->db->where('nama_jabatan_seo', $id);
    $this->db->join('jabatan', 'data_pejabat.jabatan = kategori_jabatan.nama_jabatan');
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

/* End of file Kategori_jabatan_model.php */
/* Location: ./application/models/Kategori_jabatan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-10-17 02:19:21 */
/* http://harviacode.com */