<?php


namespace Service\BlockchainInfo;


use Entity\CurrencyEntity;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class BlockchainInfo
 * @package Service\BlockchainInfo
 */
class BlockchainInfoService
{
    /**
     * @var ClientInterface|Client
     */
    private ClientInterface $service;


    /**
     * BlockchainInfoService constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        if (!$config['base_uri']) {
            $config['base_uri'] = getenv('BLOCKCHAIN_URL');
        }

        $this->service = new Client($config);
    }

    /**
     * @return ResponseInterface
     * @throws GuzzleException
     */
    private function response(): ResponseInterface
    {
        return $this->service->request("GET");
    }

    /**
     * @return CurrencyEntity[]
     * @throws GuzzleException
     */
    public function get(): array
    {
        $response = [];
        if ($list = json_decode($this->response()->getBody(), true)) {
            foreach ($list as $item) {
                $entity = CurrencyEntity::map($item);

                $response[$entity->getSymbol()] = $entity;
            }
        }

        return $response;
    }
}
