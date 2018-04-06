<?php

namespace app\common\components\db;

use app\common\components\db\fields\Decimal;
use app\common\components\db\fields\Integer;
use app\common\components\db\fields\Text;
use app\common\components\db\fields\TimeStamp;
use app\common\components\db\fields\Varchar;
use InvalidArgumentException;

/**
 * Class Field
 * @package common\components\db
 */
class Field
{
    const INTEGER = 'int';
    const VARCHAR = 'varchar';
    const TIMESTAMP = 'timestamp';
    const TEXT = 'text';
    const DECIMAL = 'decimal';

    /**
     * @param $type
     * @return FieldType|Integer|TimeStamp|Varchar|Text|Decimal
     */
    public function getBuilder($type)
    {
        switch ($type) {
            case self::INTEGER:
                return new Integer();
            case self::VARCHAR:
                return new Varchar();
            case self::TIMESTAMP:
                return new TimeStamp();
            case self::TEXT:
                return new Text();
            case self::DECIMAL:
                return new Decimal();
            default:
                throw new InvalidArgumentException("Field type '{$type}' is not allowed");
        }
    }
}