<?php

namespace Api;

abstract class ApiAbstract
{
    public const SUCCESS = 'success';
    public const ERROR = 'error';

    public const SUCCESS_CODE = 200;
    public const ERROR_CODE = 403;


    /**
     * @param string $status
     * @param int $code
     * @param array $data
     * @return array
     */
    protected function response(string $status, int $code, array $data): array
    {
        return array_merge(['status' => $status, 'code' => $code], $data);
    }

    /**
     * @param mixed $data
     * @return array
     */
    protected function success($data): array
    {
        return $this->response(self::SUCCESS, self::SUCCESS_CODE, ['data' => $data]);
    }

    /**
     * @param mixed $message
     *
     * @return array
     */
    protected function error($message): array
    {
        return $this->response(self::ERROR, self::ERROR_CODE, ['message' => $message]);
    }
}
