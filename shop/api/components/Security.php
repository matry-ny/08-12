<?php

namespace app\api\components;
use app\common\Application;
use app\common\helper\RequestHelper;

/**
 * Class Security
 * @package app\api\components
 */
class Security
{
    /**
     * @var int
     */
    private $clientId;

    /**
     * @var string
     */
    private $address;

    /**
     * @var array
     */
    private $request;

    /**
     * Security constructor.
     * @param int $clientId
     * @param string $address
     * @param array $request
     */
    public function __construct(int $clientId, string $address, array $request)
    {
        $this->clientId = $clientId;
        $this->address = $address;
        $this->request = $request;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function isValidRequest(): bool
    {
        return $this->generateToken() === RequestHelper::getHttpHeader('token');
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function generateToken(): string
    {
        $data = serialize($this->request);
        $secret = $this->getClientSecret();

        $request = "id:{$this->clientId}.address:{$this->address}.data:{$data}.secret:{$secret}";
        return md5($request);
    }

    /**
     * @return null|string
     * @throws \Exception
     */
    private function getClientSecret()
    {
        foreach(Application::get()->param('clients') as $client) {
            if ($client['id'] == $this->clientId) {
                return $client['secret'];
            }
        }

        return null;
    }
}
