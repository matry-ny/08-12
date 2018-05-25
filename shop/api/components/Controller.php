<?php

namespace app\api\components;


use app\common\helper\RequestHelper;

class Controller extends \app\common\components\Controller
{
    /**
     * @var Security
     */
    private $security;

    public function __construct()
    {
        $clientId = RequestHelper::getHttpHeader('client-id');
        if (empty($clientId)) {
            $this->error(401, 'Client id is required');
        }

        $this->security = new Security(
            $clientId,
            RequestHelper::getAddress(),
            RequestHelper::getData()
        );
        if (false === $this->security->isValidRequest()) {
            $this->error(401, 'Client token is invalid');
        }
    }

    /**
     * @param int $status
     * @param string $message
     */
    protected function error(int $status, string $message)
    {
        echo json_encode(['status' => $status, 'message' => $message]);
        exit;
    }

    /**
     * @param $data
     * @return string
     */
    protected function success($data): string
    {
        return json_encode(['status' => 200, 'data' => $data]);
    }
}
