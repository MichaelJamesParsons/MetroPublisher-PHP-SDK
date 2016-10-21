<?php
namespace MetroPublisher\Common;

use phpDocumentor\Reflection\DocBlockFactory;
use ReflectionClass;

/**
 * Class AnnotationParserTest
 * @package MetroPublisher\Common
 */
class AnnotationParser
{
    /** @var  AnnotationParser */
    private static $instance;

    /** @var DocBlockFactory */
    private $factory;

    protected function __construct() {
        $this->factory = DocBlockFactory::createInstance();
    }

    private function __clone() {}
    private function __wakeup() {}

    public static function getInstance() {
        if(is_null(self::$instance)) {
            self::$instance = new AnnotationParser();
        }

        return self::$instance;
    }

    /**
     * @param ReflectionClass $reflection
     *
     * @return \phpDocumentor\Reflection\DocBlock
     */
    public function getClassAnnotation(ReflectionClass $reflection) {
        return $this->factory->create($reflection->getDocComment());
    }

    /**
     * @param \ReflectionProperty $property
     *
     * @return \phpDocumentor\Reflection\DocBlock
     */
    public function getPropertyAnnotation(\ReflectionProperty $property) {
        return $this->factory->create($property->getDocComment());
    }
}