<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelCrud extends Model
{
    private $param = array(
        "last_id"=>0,
        "metode"=>"", 
        "table"=>"", 
        "join"=>"", 
        "on"=>"",
        "select"=>""
    );

    public function setParamDataPagination($table, $last_id=0, $metode="", $join="", $on="", $select="")
    {
        $this->param['last_id'] = $last_id;
        $this->param['metode'] = $metode;
        $this->param['table'] = $table;
        $this->param['join'] = $join;
        $this->param['on'] = $on;
        $this->param['select'] = $select;
    }

    public function save_data($table, $data)
	{
		return $this->db->table($table)->insert($data);
	}

    public function update_data($data, $param, $id)
	{
		return $this->db->table($this->param['table'])->update($data, [$param => $id]);
	}

	public function read_all_data()
	{
		return $this->db->table($this->param['table'])->get()->getResultArray();
	}

	public function select_1_cond($param = "id", $id = 1)
	{
		return $this->db->table($this->param['table'])->where([$param => $id])->get()->getResultArray();
	}

	public function delete_truncate($table)
	{
		return $this->db->table($table)->truncate();
	}
	
    public function delete_data($id)
	{
		return $this->db->table($this->param['table'])->delete(['id' => $id]);
	}

	public function solo_query($query)
	{
		return $this->db->query($query)->getResultArray();
	}

    public function data_pagination(){
        $builder = $this->db->table($this->param['table']);

        if ($this->param["join"] != "") {
            $builder->join($this->param['join'], $this->param['on']);
            $builder->select($this->param['select']);
        }else{
            if ($this->param['select'] != "") {
                $builder->select($this->param['select']);
            }
        }

        if ($this->param['metode'] != "") {
            if ($this->param['metode'] == "next") {
                $builder->orWhere('id <', $this->param['last_id'])->orderBy('id', 'DESC');
            }else{
                $builder->orWhere('id >', $this->param['last_id'])->orderBy('id', 'ASC');
            }
        }else{
            $builder->orderBy('id', 'DESC');
        }

        $builder->limit(10);

        // dd($builder->getCompiledSelect());

        $results = $builder->get()->getResultArray();

        // Ambil ID dari hasil query
        $ids = array_column($results, 'id');
        
        // Tentukan first_id dan last_id
        $first_id = !empty($ids) ? reset($ids) : null; // Ambil ID pertama
        $last_id = !empty($ids) ? end($ids) : null; // Ambil ID terakhir

        // Kembalikan data dan ID
        return [
            'data' => $results,
            'first_id' => $first_id,
            'last_id' => $last_id
        ];
    }
}
