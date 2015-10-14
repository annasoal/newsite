<?php

namespace Core;


    class Model
    {
        protected $db;
        protected $table;
        protected $pk;
        //protected $anyKey;

        protected function __construct($table, $pk){
            $this->db = SqlDb::app();
            $this->table = $table;
            $this->pk = $pk;
        }

        public function all(){
            return $this->db->select("SELECT * FROM {$this->table}");
        }

        public function one($id){
            return $this->db->select("SELECT * FROM {$this->table} WHERE {$this->pk}=:{$this->pk}", [$this->pk => $id])[0];
        }


        public function delete($id){
            return $this->db->delete($this->table, "{$this->pk}=:{$this->pk}", [$this->pk => $id]);
        }

        public function add($fields){
            $res = $this->validation($fields);

            if($res === false)
                return false;

            return $this->db->insert($this->table, $res);
        }

        public function edit($id, $fields){
            $res = $this->validation($fields);

            if($res === false)
                return false;

            $this->db->update($this->table, $res, "{$this->pk}=:{$this->pk}", [$this->pk => $id]);
            return true;
        }

        protected function validation($fields){
            $err = false;

            foreach($fields as $k => $v){
                $fields[$k] = trim($v);

                if($fields[$k] == ''){
                    $err = true;
                    return false;
                }
            }

            return $fields;
        }
    }

