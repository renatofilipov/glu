<?php
/**
 * Redis Service
 *
 * @author Renato Filipov <renato@filipov.me>
 * @license http://renato.filipov.me
 */

namespace App\Service;

use Predis\Client;

/**
 * Redis Service
 *
 * This is not being used in this project, but could be useful...
 */
class RedisService {
    const PROJECT_NAME = 'glu';

    /**
     * @var Client $redis
     */
    protected $redis;

    /**
     * RedisService constructor
     *
     * @param Client $redis
     */
    public function __construct(Client $redis) {
        $this->redis = $redis;
    }

    /**
     * Generate cache key
     *
     * @param string $value
     *
     * @return string
     */
    public function generateKey(string $value) : string {
        return self::PROJECT_NAME . ':' . $value;
    }

    /**
     * Checks whether the given key already exists or not
     *
     * @param string $key
     *
     * @return int
     */
    public function exists(string $key) : string {
        return $this->redis->exists($key);
    }

    /**
     * Get key
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key) : string {
        return json_decode($this->redis->get($key), true);
    }

    /**
     * Set key
     *
     * @param string $key
     * @param string $value
     */
    public function set(string $key, string $value) {
        $this->redis->set($key, json_encode($value));
    }

    /**
     * Set Ex.
     *
     * @param string $key
     * @param string $value
     * @param int $ttl
     */
    public function setex(string $key, string $value, int $ttl = 3600) {
        $this->redis->setex($key, $ttl, json_encode($value));
    }

    /**
     * Delete key
     *
     * @param string $key
     */
    public function del(string $key) {
        $this->redis->del($key);
    }
}
