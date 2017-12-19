<?php
/**
 * Created by PhpStorm.
 * User: gaoyang
 * Date: 2017/12/18
 * Time: 14:38
 */

namespace App\Helpers\Api;

use Symfony\Component\HttpFoundation\Response as FoundationResponse;


trait ApiResponse
{
    /**
     * $status : HTTP状态码
     * $code : 自定义回调错误码
     * @var int
     */
    protected $status = FoundationResponse::HTTP_OK;
    protected $code = 0;

    /**
     * @param $statusCode
     * @return $this
     */
    public function setStatus($statusCode)
    {
        $this->status = $statusCode;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * 回调信息格式统一设置
     * @param $data
     * @param string $message
     * @param null $code
     * @param null $status
     * @return $this
     */
    public function format($data, $message = 'success', $code = null, $status = null)
    {
        if ($status) {
            $this->setStatus($status);
        }

        if ($code) {
            $this->setCode($code);
        }

        $data = [
            'code' => $this->getCode(),
            'message' => $message,
            'data' => $data
        ];

        return $this->respond($data);
    }

    /**
     * 回调信息处理
     * @param $data
     * @param array $header
     * @return $this
     */
    public function respond($data, $header = [])
    {
        return response()->json($data, $this->getStatus(), $header)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    /**
     * 成功回调
     * @param string $data
     * @param string $message
     * @return $this
     */
    public function success($data = '', $message = 'success')
    {
        return $this->format($data, $message);
    }

    /**
     * 失败回调
     * @param string $message
     * @param int $code
     * @return $this
     */
    public function failed($message = 'failed', $code = 10000)
    {
        return $this->format('', $message, $code);
    }
}