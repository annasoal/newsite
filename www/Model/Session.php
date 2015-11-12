<?php

namespace Model;

class Session extends \Core\Model
{
    private static $instance;

    public static function app()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected function __construct()
    {
        parent::__construct('sessions', 'id_session');
    }

    public function open($id_user)
    {
        $fields = [
            'token' => $this->randString(),
            'id_user' => $id_user,
            'timestart' => date("Y-m-d H:i:s"),
            'lastactivity' => date("Y-m-d H:i:s"),
            'isover' => date("Y-m-d H:i:s", time() + 3600 * 24 * 7)
        ];

        $this->add($fields);
        return $fields['token'];
    }

    public function getByToken($token)
    {
        $session = $this->db->select("SELECT * FROM {$this->table} WHERE token=:token", ['token' => $token])[0];

        if ($session == null)
            return null;

        $dt = date("Y-m-d H:i:s");

        if ($dt > $session['isover']) {
            $this->delete($session['id_session']);
            return null;
        }

        $fields = [
            'lastactivity' => date("Y-m-d H:i:s")
        ];

        $this->edit($session['id_session'], $fields);
        return $session['id_user'];
    }

    public function deleteByToken($token)
    {
        $this->db->delete($this->table, "token=:token", ['token' => $token]);
        return true;
    }

    private function randString($length = 64)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789';
        $code = '';
        $clen = strlen($chars) - 1;

        while (strlen($code) < $length)
            $code .= $chars[mt_rand(0, $clen)];

        return $code;
    }
}
