<?php
namespace Hxh\XlsWrite;


use Vtiful\Kernel\Excel;

class XlsWrite extends \Vtiful\Kernel\Excel
{

    /**
     * 初始化
     * @throws \Exception
     */
    public function __construct(array $config = [])
    {
        if (empty(config('xlswrite'))) {
            throw new \Exception('laravel-xlswriter Config file is not published.please publish first');
        }

        if(empty($config) || !isset($config['path'])){
            $config = [
                'path' => config('xlswrite.stores.'.config('xlswrite.driver').'.path')
            ];
        }
        parent::__construct($config);
    }


    /**
     * 游标查询 分批处理
     * @param int $limit  每次取出的数量
     * @param callable $callback 回调函数
     * @return true
     */
    public function xlsChunk(int $limit, callable $callback){
        $offset = 0;
        $lines = [];
        do  {
            // 获取下一行
            $line = $this->nextRow();
            // 如果当前行为null && 当前取出的数据为0 直接跳出
            if($line === null && count($lines) === 0){
                break;
            }
            // 存入
            if($line !== null){
                $lines[] = $line;
            }
            // 当前偏移量
            $offset++;
            // 如果当前偏移量大于等于限制数量
            if($offset >= $limit || $line === null){
                $callback($lines);
                $offset = 0;
                $lines = [];
            }
        }while ($line !== null);

        return true;
    }

}
