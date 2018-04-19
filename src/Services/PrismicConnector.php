<?php
namespace Gwsn\PrismicBundle\Services;

use Gwsn\Prismic\Document\BasePrismicDocument;
use Gwsn\Prismic\Document\PrismicDocumentInterface;

class PrismicConnector {
    /**
     * @var string $apiKey
     */
    protected $apiKey;

    /**
     * @var string $endpoint
     */
    protected $endpoint;

    /**
     * @var array $config
     */
    protected $config;

    /**
     * @var PrismicDocumentInterface $prismic
     */
    protected $prismic;

    /**
     * PrismicConnector constructor.
     *
     * @param $config
     *
     * @throws \Exception
     */
    public function __construct($config) {
        $this->setConfig($config);
    }

    /**
     * @return string
     */
    private function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    private function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    private function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     */
    private function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @param array $config
     *
     * @throws \Exception
     */
    private function setConfig($config)
    {
        if(!key_exists('api_endpoint', $config)) {
            throw new \Exception("Config is not valid, the key 'api_endpoint' not exists in configuration");
        }

        if(!key_exists('api_key', $config)) {
            throw new \Exception("Config is not valid, the key 'api_endpoint' not exists in configuration");
        }

        $this->config = $config;

        $this->setEndpoint($config['api_endpoint']);
        $this->setApiKey($config['api_key']);

    }

    /**
     * @return PrismicDocumentInterface
     */
    public function getPrismic()
    {
        return $this->prismic;
    }

    /**
     * @param PrismicDocumentInterface $prismic
     */
    private function setPrismic($prismic)
    {
        $this->prismic = $prismic;
    }

    /**
     * Setup the base connection
     * @param PrismicDocumentInterface $documentHandler
     *
     * @return PrismicDocumentInterface
     * @throws \Exception
     */
    public function setup(PrismicDocumentInterface $documentHandler = null) {

        if($documentHandler !== null && ! $documentHandler instanceof PrismicDocumentInterface) {
            throw new \Exception('Document isn ot instance of PrismicDocumentInterface');
        }
        $documentHandler = ($documentHandler === null ? new BasePrismicDocument : $documentHandler);

        $this->setPrismic($documentHandler);
        $this->prismic->setEndpoint($this->getEndpoint());
        $this->prismic->setToken($this->getApiKey());

        return $this->prismic;
    }

}