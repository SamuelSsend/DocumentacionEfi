<?php

namespace Culqi;

/**
 * Class Tokens
 *
 * @package Culqi
 */
class Tokens extends Resource
{

    const URL_TOKENS = "/tokens/";

    /**
     * @param array|string|null $options
     *
     * @return all Tokens.
     */
    public function all($options = null)
    {
        return $this->request("GET", self::URL_TOKENS, $api_key = $this->culqi->api_key, $options);
    }

    /**
     * @param array|null $options
     *
     * @return create Token response.
     */
    public function create($options = null)
    {
        return $this->request("POST", self::URL_TOKENS, $api_key = $this->culqi->api_key, $options, true);
    }

    /**
     * @param string|null $id
     *
     * @return get a Token.
     */
    public function get($id = null)
    {
        return $this->request("GET", self::URL_TOKENS . $id . "/", $api_key = $this->culqi->api_key);
    }

    /**
     * @param string|null $id
     * @param array|null  $options
     *
     * @return update Token response.
     */
    public function update($id = null, $options = null)
    {
        return $this->request("PATCH", self::URL_TOKENS . $id . "/", $api_key = $this->culqi->api_key, $options);
    }

}
