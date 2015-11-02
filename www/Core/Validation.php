<?php

namespace Core;

class Validation
{
    private $table;            // имя талицы
    private $rules;            // правила, подгружаемые из rules
    private $errors;        // массив с константами ошибк валидации
    private $final_object;    // массив, сформированный из переданного, но с очищенными данными

//
// params:
// 		$table - имя талицы для поиска в rules_map.php
// 		$rules - правила, подгружаемые из rules
//
    public function __construct($table)
    {
        $this->table = $table;
        $this->rules = include_once(RULES_PATH . $table . '.php');
        $this->errors = [];
        $this->final_object = [];
    }

//
// params:
// 		$obj - массив с формы. Ключи - поля в базе, значения - значения :)
// 		$pk - первичный ключ при редактировании записи. При добавлении равен null.
//
    public function execute($obj, $pk = null)
    {
        $query_tmp = [];
        $pair_for_unique = [];
        $clean_obj = [];

        foreach ($obj as $key => $value) {
            if (in_array($key, $this->rules['fields'])) {
                $value = trim($value);
                $count = iconv_strlen($value, 'UTF-8');

//очищаем данные для последующей передачи
                if (!isset($this->rules['html_allowed']) || !in_array($key, $this->rules['html_allowed'])) {
                    $value = htmlspecialchars($value);
                    $clean_obj[] = [$key => $value];
                }

//все представленные здесь правила описаны в файле messages.php
                if (isset($this->rules['not_empty']) && in_array($key, $this->rules['not_empty'])) {

                    if ($value == '')
                        $this->errors[] = ['not_empty', $key];
                    else {
                        if (isset($this->rules['range']) &&
                            isset($this->rules['range'][$key]) &&
                            ($count < $this->rules['range'][$key][0] || $count > $this->rules['range'][$key][1])) {
                            $this->errors[] = ['range', $key, $this->rules['range'][$key][0], $this->rules['range'][$key][1]];
                        } elseif (isset($this->rules['exact_length']) &&
                            isset($this->rules['exact_length'][$key]) &&
                            $count != $this->rules['exact_length'][$key]) {
                            $this->errors[] = ['exact_length', $key, $this->rules['exact_length'][$key]];
                        } elseif (isset($this->rules['min_length']) &&
                            isset($this->rules['min_length'][$key]) &&
                            $count < $this->rules['min_length'][$key]) {
                            $this->errors[] = ['min_length', $key, $this->rules['min_length'][$key]];
                        } elseif (isset($this->rules['max_length']) &&
                            isset($this->rules['max_length'][$key]) &&
                            $count > $this->rules['max_length'][$key]) {
                            $this->errors[] = ['max_length', $key, $this->rules['max_length'][$key]];
                        } elseif (isset($this->rules['date']) &&
                            in_array($key, $this->rules['date']) &&
                            strtotime($value) == false) {
                            $this->errors[] = ['date', $key];
                        } elseif (isset($this->rules['equals']) &&
                            isset($this->rules['equals'][$key])) {
                            $required = $obj[$key];
                            $val = $obj[$this->rules['equals'][$key]];
                            if (!$this->equals($val, $required)) {
                                $this->errors[] = ['equals', $this->rules['equals'][$key], $key];
                            }
                        } elseif (isset($this->rules['phone']) &&
                            isset($this->rules['phone'][$key]) &&
                            !$this->phone($value, $this->rules['phone'][$key])) {
                            $this->errors[] = array('phone', $key, $this->rules['phone'][$key]);
                        } elseif (isset($this->rules['correct_url']) &&
                            in_array($key, $this->rules['correct_url']) &&
                            preg_match("/[^a-zA-Zа-яА-ЯёЁ0-9_\-\+]+msi/", $value)) {
                            $this->errors[] = array('correct_url', $key);
                        } elseif (isset($this->rules['email']) &&
                            in_array($key, $this->rules['email'])&&
                            !$this->email($value)) {
                            $this->errors[] = array('email', $key);
                        } elseif (isset($this->rules['email_domain']) &&
                            in_array($key, $this->rules['email_domain']) &&
                            !$this->email_domain($value)) {
                            $this->errors[] = array('email_domain', $key);
                        } elseif (isset($this->rules['unique']) &&
                            in_array($key, $this->rules['unique'])) {
                            $pair_for_unique[$key] = $value;
                        }
                        /* rules extentions */
                    }
                }

                 if(isset($this->rules['hash']) && in_array($key, $this->rules['hash'])) {
                     $salt = '5363637';
                     $value = hash('sha256', $value . $salt);
                 }
                $this->final_object[$key] = $value;
            }
        }

        if (!empty($pair_for_unique)) {
            $list = $this->unique($pair_for_unique, $pk);

            foreach ($pair_for_unique as $key => $value) {
                foreach ($list as $list_one) {
                    if ($list_one[$key] == $value)
                        $this->errors[] = array('unique', $key);
                }
            }
        }
    }

    private function email($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function email_domain($email)
    {
        return (bool)checkdnsrr(preg_replace('/^[^@]++@/', '', $email), 'MX');
    }

    private function unique($pairs, $pk = null)
    {
        $primary_key = $this->rules['pk'];
        $query_pairs = [];

        foreach ($pairs as $key => $value) {
            $query_pairs[] = "$key=:$key";
        }

        $query = implode(' OR ', $query_pairs);

        if ($pk == null)
            $result = SqlDb::app()->select("SELECT * FROM {$this->table} WHERE $query", $pairs);
        else {
            $result = SqlDb::app()->select("SELECT * FROM {$this->table} WHERE ($query) AND $primary_key<>$pk", $pairs);
        }

        return $result;
    }


//
// returns:
//		true || false - всё хорошо или всё плохо
//
    public function good()
    {
        return count($this->errors) == 0;
    }

//
// returns:
//		массив с проверенными и отредактированными полями для базы
//
    public function getObj()
    {
        if (count($this->errors) == 0) {
            return $this->final_object;
        }
    }

    public function replaceObj()
    {
        return $this->final_object;
    }

    private function searchRule($rules, $obj)
    {
        foreach ($rules as $key) {
            return !in_array($key, $obj);
        }
    }

    private function phone($number, $length)
    {
        $number = preg_replace('/\D+/', '', $number);
        return strlen($number) >= $length;
    }

    private function equals($value, $required)
    {
        return ($value === $required);
    }
//
// returns:
//		массив с ошибками
//
    public function errors()
    {
        $errors_with_messages = [];
        $messages = include(MESSAGES_PATH . 'validation.php');
        $labels = $this->rules['labels'];

        foreach ($this->errors as $i) {
            $message = $messages[$i[0]]; // Поле ":label_1" не должно быть пустым

            if (isset($i[1]))
                $message = str_replace(':label_1', $labels[$i[1]], $message);

            if (isset($i[2])) {
                if (is_numeric($i[2]))
                    $message = str_replace(':param_1', $i[2], $message);
                else
                    $message = str_replace(':label_2', $labels[$i[2]], $message);
            }
            if (isset($i[3]))
                $message = str_replace(':param_2', $i[3], $message);
            /* //раскомментировать для исспользования
            //здесь можно добавить еще параметр
            if(isset($i[4]))
            $message = str_replace(':param_3', $i[4],  $message); */

            $errors_with_messages[$i[1]] = $message;
        }
        return $errors_with_messages;
    }

}