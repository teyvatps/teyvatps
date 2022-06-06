<?php

namespace TeyvatPS\utils;

use labalityowo\Bytebuffer\Buffer;
use TeyvatPS\Config;

class Crypto
{

    public static Buffer $ec2bKey;
    public static Buffer $secretKey;
    public static Buffer $ec2bBin;

    public static function init(): void
    {
        self::$ec2bKey = Buffer::new(file_get_contents(Config::DATA_FOLDER . 'ec2b/ec2b.key'));
        self::$secretKey = Buffer::new(file_get_contents(Config::DATA_FOLDER . 'ec2b/secret.key'));
        self::$ec2bBin = Buffer::new(file_get_contents(Config::DATA_FOLDER . 'ec2b/ec2b.bin'));
    }

    public static function xorBuffer(Buffer &$buffer, Buffer $key): void
    {
        $rawBuffer = $buffer->toString();
        for ($i = 0; $i < $buffer->getLength(); $i++) {
            $rawBuffer[$i] = $rawBuffer[$i] ^ $key->toString()[$i % $key->getLength()];
        }
        $buffer = Buffer::new($rawBuffer);
    }
}