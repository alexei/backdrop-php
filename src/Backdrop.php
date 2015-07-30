<?php

require_once 'util.php';

class Backdrop implements ArrayAccess, Iterator {
    private $data = array();

    function __construct($project_name, array $directories = array()) {
        $directories = array_reverse($directories);

        // first look inside ~ if exists (no Windows support)
        $homedir = get_user_homedir();
        if (!empty($homedir)) {
            $directories[] = $homedir;
        }

        // then look inside cwd
        $directories[] = getcwd();

        $directories = array_reverse($directories);

        foreach ($directories as $directory) {
            $file_name = sprintf('%s.json', $project_name);
            $file_path = implode(DIRECTORY_SEPARATOR, array(rtrim($directory, DIRECTORY_SEPARATOR), '.backdrop', $file_name));
            if (file_exists($file_path)) {
                $this->data = array_merge($this->data, (array)json_decode(file_get_contents($file_path)));
            }
        }
    }

    public function __set($key, $val)
    {
        return $this->offsetSet($key, $val);
    }

    public function __get($key)
    {
        return $this->offsetGet($key);
    }

    public function __isset($key)
    {
        return $this->offsetExists($key);
    }

    public function __unset($key)
    {
        return $this->offsetUnset($key);
    }

    public function offsetExists($key) {
        return array_key_exists($key, $this->data);
    }

    public function offsetGet($key) {
        return $this->data[$key];
    }

    public function offsetSet($key, $val) {
        throw new Exception('Not implemented');
    }

    public function offsetUnset($key) {
        throw new Exception('Not implemented');
    }

    public function current()
    {
        return current($this->data);
    }

    public function key()
    {
        return key($this->data);
    }

    public function next()
    {
        return next($this->data);
    }

    public function rewind()
    {
        return reset($this->data);
    }

    public function valid()
    {
        return !is_null(key($this->data));
    }
}
