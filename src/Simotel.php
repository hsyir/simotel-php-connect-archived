<?php


namespace Hsy\Simotel;


class Simotel
{
    private $config;

    public function __construct(array $config = [])
    {
        $this->config = empty($config) ? $this->loadDefaultConfig() : $config;
    }

    /**
     * Retrieve default config.
     *
     * @return array
     */
    protected function loadDefaultConfig(): array
    {
        return require(static::getDefaultConfigPath());
    }

    /**
     * Retrieve Default config's path.
     *
     * @return string
     */
    public static function getDefaultConfigPath(): string
    {
        return dirname(__DIR__) . '/config/simotel.php';
    }


    public function smartApiCall($data)
    {
        return (new SmartApi($this->config["smartApi"]))->call($data);
    }
}