<?php

namespace Maris\Symfony\DocumentUnit\Factory;

use Maris\Symfony\DocumentUnit\Entity\AbstractLegalNumber;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

/***
 * @template T
 */
abstract class AbstractFactory
{
    protected ReflectionClass $creator;

    protected ReflectionProperty $initializer;

    /**
     * @throws ReflectionException
     */
    public function __construct( string $class )
    {
        $this->creator = new ReflectionClass( $class );
        $this->initializer = $this->creator->getProperty("value");
    }


    /***
     * Создает объект из строки.
     * @param string $number
     * @return T|null
     * @throws ReflectionException
     */
    public function create( string $number ):?AbstractLegalNumber
    {
        return $this->valid($number) ? $this->createInstance( $number ) : null;
    }

    /**
     * Создает объект.
     * @param string $number
     * @return T|null
     * @throws ReflectionException
     */
    protected function createInstance( string $number):?AbstractLegalNumber
    {
        $instance = $this->creator->newInstanceWithoutConstructor();
        $this->initializer->setValue( $instance, $this->modifyValue( $number ) );
        return $instance;
    }

    /**
     * Модифицирует значение перед созданием объекта.
     * По умолчанию удаляет все символы кроме цифр.
     * Для объектов номера которых содержат не только цифры
     * необходимо переопределить.
     * @param string $value
     * @return string
     */
    protected function modifyValue( string $value ):string
    {
        return preg_replace("~\D+~","", $value);
    }
    /***
     * Ищет ИНН в строке.
     * @param string $str
     * @return array<T>
     * @throws ReflectionException
     */
    public function parse( string $str ):array
    {
        $result = [];
        foreach ($this->getMatches( $str ) as $item)
            if( !is_null($inn = $this->create( $item )) )
                $result[] = $inn;

        return $result;
    }

    /***
     * Возвращает массив со строковыми представлениями поиска.
     * @param string $str
     * @return array<string>
     */
    abstract protected function getMatches( string $str ):array;

    /***
     * Проверяет на валидность.
     * Строка должна состоять только из цифр.
     * @param string $number
     * @return bool
     */
    abstract public function valid( string $number ):bool;
}