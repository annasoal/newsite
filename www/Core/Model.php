<?php

namespace Core;


class Model
{
    protected $db;
    protected $table;
    protected $pk;
    protected $errors;
    protected $last_valid_obj;

    protected function __construct($table, $pk)
    {
        $this->db = SqlDb::app();
        $this->table = $table;
        $this->pk = $pk;
        $this->errors = [];
    }

    public function all()
    {
        return $this->db->select("SELECT * FROM {$this->table}");
    }

    public function one($id)
    {
        return $this->db->select("SELECT * FROM {$this->table} WHERE {$this->pk}=:{$this->pk}", [$this->pk => $id])[0];
    }


    public function delete($id)
    {
        return $this->db->delete($this->table, "{$this->pk}=:{$this->pk}", [$this->pk => $id]);
    }

    public function add($fields)
    {
        $valid = new Validation($this->table);
        $valid->execute($fields);

        if ($valid->good() !== false) {
            $this->last_valid_obj = $valid->getObj();
            $id = $this->db->insert($this->table, $this->last_valid_obj);
            return $id;
        }

        $this->errors = $valid->errors();
        return false;
    }

    public function edit($id, $fields)
    {
        $this->errors = [];

        $id = (int)$id;
        $valid = new Validation($this->table);
        $valid->execute($fields, $id);

        if ($valid->good()) {
            $this->last_valid_obj = $valid->getObj();
            $this->db->update($this->table, $this->last_valid_obj, "{$this->pk}=:{$this->pk}", [$this->pk => $id]);
            return true;
        }

        $this->errors = $valid->errors();
        return false;
    }

    public function errors()
    {
        return $this->errors;
    }
}

