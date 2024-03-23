<?php

namespace EverForge\ThinkConstant\Tests\Support;

use Psr\SimpleCache\CacheInterface;

class SimpleCache implements CacheInterface
{
    protected $storage = [];

    /**
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        return $this->storage[$key] ?? $default;
    }

    public function set($key, $value, $ttl = null): bool
    {
        $this->storage[$key] = $value;

        return true;
    }

    public function delete($key): bool
    {
        unset($this->storage[$key]);

        return true;
    }

    public function clear(): bool
    {
        $this->storage = [];

        return true;
    }

    /**
     * @param $keys
     * @param $default
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     *
     * @return array
     */
    public function getMultiple($keys, $default = null): array
    {
        $values = [];
        foreach ($keys as $key) {
            $values[$key] = $this->get($key, $default);
        }

        return $values;
    }

    public function setMultiple($values, $ttl = null): bool
    {
        foreach ($values as $key => $value) {
            $this->set($key, $value, $ttl);
        }

        return true;
    }

    public function deleteMultiple($keys): bool
    {
        foreach ($keys as $key) {
            $this->delete($key);
        }

        return true;
    }

    public function has($key): bool
    {
        return isset($this->storage[$key]);
    }
}
