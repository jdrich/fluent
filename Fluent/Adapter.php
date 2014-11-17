<?php

namespace Fluent;

/**
 * This class enables the user (programmer) to wrap an object that usually does
 * not support a fluent interface in a fluent interface. A fluent interface can
 * cut down on code repetition and make code easier to read and more fun to write.
 */
class Adapter
{
    /**
     * The object being wrapped by the Adapter instance.
     * @var object
     */
    private $adaptee;

    /**
     * An array of methods that return values, and should cease method chaining.
     * @var array
     */
    private $return_methods;


    /**
     * Our constructor.
     *
     * @param object $adaptee        The object being wrapped.
     * @param array  $return_methods Return methods that cease chaining.
     *
     * @throws \UnexpectedValueException When the first parameter to the constructor is not an object.
     */
    public function __construct( $adaptee, $return_methods = array() )
    {
        if ( !is_object( $adaptee ) )
        {
            throw new \UnexpectedValueException( 'First argument to Adapter::__construct() must be an object.' );
        }

        $this->_adaptee = $adaptee;
        $this->_return_methods = $return_methods;
    }


    /**
     * Override the Adapter __toString method to call $adaptee->__toString()
     *
     * @return string The wrapped methods __toString output.
     */
    public function __toString()
    {
        return $this->_adaptee->__toString();
    }


    /**
     * Allow our adapter to pretend to have the same interface as the object
     * we're wrapping.
     *
     * @param string $method The method to be called.
     * @param array  $args   The function arguments.
     *
     * @return mixed Returns self, or the return of the method called if the specified method is one of the return methos for the adapter.
     */
    public function __call( $method, $args )
    {
        if ( in_array( $method, $this->_return_methods ) )
        {
            return call_user_func_array( array( $this->_adaptee, $method ), $args );
        }

        call_user_func_array( array( $this->_adaptee, $method ), $args );

        return $this;
    }


    protected function setReturnMethods( $return_methods = array() )
    {
        $this->_return_methods = $return_methods;
    }
}
