<?php

namespace Polyakusha\TikEngine\Http;

class ParamsContainer implements \IteratorAggregate
{
    protected $params = [];

    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    public function add($key, $value)
    {
        $this->params[$key] = $value;
        return $this;
    }

    public function filter($key, $default = null, $filter = FILTER_DEFAULT, $options = [])
    {
        $value = isset($this->params[$key]) ? $this->params[$key] : $default;

        $value = filter_var($value, $filter, $options);
        $default = filter_var($default, $filter, $options);

        return $value ?: $default; //@fixme: boolean!!
    }

    public function filterArray($key, $default = null, $filter = FILTER_DEFAULT, $options = [])
    {
        if (!is_array($options)) {
            $options = [
                    'flags' => $options
                ];
        }

        $options['flags'] = isset($options['flags'])
            ? $options['flags'] | FILTER_FORCE_ARRAY
            : FILTER_FORCE_ARRAY;

        return $this->filter($key, $default, $filter, $options);
    }

    protected function filterVar($key, $default, $filter, $options, $forceArray)
    {
        $method = $forceArray ? 'filterArray' : 'filter';
        return $this->$method($key, $default, $filter, $options);

    }

    public function getBool($key, $default = false, $forceArray = false, $options = [])
    {
        return $this->filterVar($key, $default, FILTER_VALIDATE_BOOLEAN, $options, $forceArray);
    }

    public function getFloat($key, $default = 0, $forceArray = false, $options = [])
    {
        return $this->filterVar($key, $default, FILTER_VALIDATE_FLOAT, $options, $forceArray);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->params);
    }

    public function getInt($key, $default = 0, $forceArray = false, $options = [])
    {
        return $this->filterVar($key, $default, FILTER_VALIDATE_INT, $options, $forceArray);
    }

    public function update(array $params)
    {
        $this->params = array_merge($this->params, $params);
        return $this;
    }
}