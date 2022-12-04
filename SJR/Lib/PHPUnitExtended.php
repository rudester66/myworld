<?php

/**
 * @author SCrossan
 *
 */
class PHPUnitExtended extends PHPUnit_Framework_TestCase
{

	/**
	 * Call protected/private method of a class
	 * @param object &$object
	 * @param string $mthodName
	 * @param array $parameters
	 * @return mixed Method return
	 */
	public function invokeMethod(&$object, $methodName, array $parameters = array())
	{
		$reflection = new ReflectionClass(get_class($object));
		$method = $reflection->getMethod($methodName);
		$method->setAccessible(true);

		return $method->invokeArgs($object, $parameters);
	}

	/**
	 * Set protected/private property of a class
	 * @param object &$object
	 * @param string $porpertyName
	 * @param array $value
	 * @return mixed Method return
	 */
	public function invokeProperty(&$object, $porpertyName, $value)
	{
		$reflection = new ReflectionClass(get_class($object));
		$property = $reflection->getProperty($porpertyName);
		$property->setAccessible(true);

		return $property->setValue($object, $value);
	}

	/**
	 * Method to check if both arrays values are in the same order
	 * @param array $expected
	 * @param array $actual
	 * @param string $message
	 * @throws PHPUnit_Framework_ExpectationFailedException
	 */
	public function assertArrayEquals(array $expected, array $actual, $message = "Borh arrays are not equal")
	{
		//var_dump($expected, $actual);
		$expectedStr = '';
		$actualStr = '';
		$both = array(); // Array to store both $expected and $actual arrays
		$both['expected'] = $expected;
		$both['actual'] = $actual;
		foreach($both as $arrayName => $array)
		{
			foreach($array as $key => $value)
			{
				//die(var_dump($value));
				$arrayStr = $arrayName . 'Str';
				if(is_array($value))
				{
					$$arrayStr = $this->arrayString($value, $$arrayStr);
				}
				else
				{
					$$arrayStr .= "$key = $value, ";
				}
			}
		}

		//var_dump($expectedStr, $actualStr);
		if($expectedStr != $actualStr)
		{
			throw new PHPUnit_Framework_ExpectationFailedException($message);
		}
	}

	/**
	 * Method to recersivly add key pair values of a multidimensional accociative array to a string
	 * @param array $array
	 * @param string $arrayString
	 * @return string
	 */
	function arrayString(array $array, $arrayString)
	{
		foreach($array as $key => $value)
		{
			if(is_array($value))
			{
				$arrayString = $this->arrayString($value, $arrayString);
			}
			else
			{
				$arrayString .= "$key = $value, ";
			}
		}

		return $arrayString;
	}
}

?>