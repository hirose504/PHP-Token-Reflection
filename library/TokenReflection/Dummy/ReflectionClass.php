<?php
/**
 * PHP Token Reflection
 *
 * Development version
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this library in the file license.txt.
 *
 * @author Ondřej Nešpor <andrew@andrewsville.cz>
 * @author Jaroslav Hanslík <kukulich@kukulich.cz>
 */

namespace TokenReflection\Dummy;
use TokenReflection;

use TokenReflection\Broker, TokenReflection\IReflectionClass, TokenReflection\ReflectionBase;
use ReflectionClass as InternalReflectionClass, TokenReflection\Exception;

/**
 * Dummy class "reflection" of a nonexistent class.
 */
class ReflectionClass implements IReflectionClass
{
	/**
	 * Nonexistent classes pseudo-package name.
	 *
	 * @var string
	 */
	const PACKAGE_NONE = 'None';

	/**
	 * Reflection broker.
	 *
	 * @var \TokenReflection\Broker
	 */
	private $broker;

	/**
	 * Class name (FQN).
	 *
	 * @var string
	 */
	private $name;

	/**
	 * Constructor.
	 *
	 * @param string $className Class name
	 * @param \TokenReflection\Broker $broker Reflection broker
	 */
	public function __construct($className, Broker $broker)
	{
		$this->name = $className;
		$this->broker = $broker;
	}

	/**
	 * Returns the class name (FQN).
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Returns the class UQN.
	 *
	 * @return string
	 */
	public function getShortName()
	{
		$pos = strrpos($this->name, '\\');
		return false === $pos ? $this->name : substr($this->name, $pos + 1);
	}

	/**
	 * Returns the reflection broker used by this reflection object.
	 *
	 * @return \TokenReflection\Broker
	 */
	public function getBroker()
	{
		return $this->broker;
	}

	/**
	 * Returns the package name.
	 *
	 * @return string
	 */
	public function getPackageName()
	{
		return self::PACKAGE_NONE;
	}

	/**
	 * Magic __get method.
	 *
	 * @param string $key Variable name
	 * @return mixed
	 */
	final public function __get($key)
	{
		return ReflectionBase::get($this, $key);
	}

	/**
	 * Magic __isset method.
	 *
	 * @param string $key Variable name
	 * @return boolean
	 */
	final public function __isset($key) {
		return ReflectionBase::exists($this, $key);
	}


	/**
	 * Returns the file name the reflection object is defined in.
	 *
	 * @return string
	 */
	public function getFileName()
	{
		return null;
	}

	/**
	 * Returns the definition start line number in the file.
	 *
	 * @return integer
	 */
	public function getStartLine()
	{
		return null;
	}

	/**
	 * Returns the definition end line number in the file.
	 *
	 * @return integer
	 */
	public function getEndLine()
	{
		return null;
	}

	/**
	 * Returns the PHP extension reflection.
	 *
	 * Returns null - everything is user defined.
	 *
	 * @return null
	 */
	public function getExtension()
	{
		return null;
	}

	/**
	 * Returns the PHP extension name.
	 *
	 * Returns null - everything is user defined.
	 *
	 * @return null
	 */
	public function getExtensionName()
	{
		return null;
	}

	/**
	 * Returns if the reflection object is internal.
	 *
	 * @return boolean
	 */
	public function isInternal()
	{
		return false;
	}

	/**
	 * Returns if the reflection object is user defined.
	 *
	 * @return boolean
	 */
	public function isUserDefined()
	{
		return false;
	}

	/**
	 * Outputs the reflection subject source code.
	 *
	 * @return string
	 */
	public function getSource()
	{
		return '';
	}

	/**
	 * Returns the appropriate docblock definition.
	 *
	 * @return string|false
	 */
	public function getDocComment()
	{
		return false;
	}

	/**
	 * Returns the docblock definition of the class or its parent.
	 *
	 * @return string|false
	 */
	public function getInheritedDocComment()
	{
		return $this->getDocComment();
	}

	/**
	 * Returns the string representation of the reflection object.
	 *
	 * @return string
	 */
	public function __toString()
	{
		// @todo
		return '';
	}

	/**
	 * Returns parsed docblock.
	 *
	 * @return array
	 */
	public function getAnnotations()
	{
		return array();
	}

	/**
	 * Returns a particular annotation value.
	 *
	 * @param string $name Annotation name
	 * @param boolean $forceArray Always return values as array
	 * @return string|array|null
	 */
	public function getAnnotation($name)
	{
		return null;
	}

	/**
	 * Checks if there is a particular annotation.
	 *
	 * @param string $name Annotation name
	 * @return boolean
	 */
	public function hasAnnotation($name)
	{
		return false;
	}

	/**
	 * Returns a constant value.
	 *
	 * @param string $name Constant name
	 * @return mixed|false
	 */
	public function getConstant($name)
	{
		throw new Exception(sprintf('Constant "%s" is not defined in class "%s"', $name, $this->name), Exception::DOES_NOT_EXIST);
	}

	/**
	 * Returns a constant reflection.
	 *
	 * @param string $name Constant name
	 * @return \TokenReflection\ReflectionConstant|null
	 * @throws \TokenReflection\Exception If the requested constant does not exist
	 */
	public function getConstantReflection($name)
	{
		return array();
	}

	/**
	 * Returns an array of constant values.
	 *
	 * @return array
	 */
	public function getConstants()
	{
		return array();
	}

	/**
	 * Returns an array of constant reflections.
	 *
	 * @return array
	 */
	public function getConstantReflections()
	{
		return array();
	}

	/**
	 * Returns an array of constant reflections defined by this class not its parents.
	 *
	 * @return array
	 */
	public function getOwnConstantReflections()
	{
		return array();
	}

	/**
	 * Returns the class constructor reflection.
	 *
	 * @return \TokenReflection\ReflectionMethod|null
	 */
	public function getConstructor()
	{
		return null;
	}

	/**
	 * Returns the class desctructor reflection.
	 *
	 * @return \TokenReflection\ReflectionMethod|null
	 */
	public function getDestructor()
	{
		return null;
	}

	/**
	 * Returns default properties.
	 *
	 * @return array
	 */
	public function getDefaultProperties()
	{
		return array();
	}

	/**
	 * Returns interface names.
	 *
	 * @return array
	 */
	public function getInterfaceNames()
	{
		return array();
	}

	/**
	 * Returns interface reflections.
	 *
	 * @return array
	 */
	public function getInterfaces()
	{
		return array();
	}

	/**
	 * Returns a method reflection.
	 *
	 * @param string $name Method name
	 * @return \TokenReflection\ReflectionMethod
	 */
	public function getMethod($name)
	{
		throw new Exception(sprintf('There is no method %s in class %s', $name, $this->name), Exception::DOES_NOT_EXIST);
	}

	/**
	 * Returns method reflections.
	 *
	 * @param integer $filter Method filter
	 * @return array
	 */
	public function getMethods($filter = null)
	{
		return array();
	}

	/**
	 * Returns modifiers.
	 *
	 * @return integer
	 */
	public function getModifiers()
	{
		return 0;
	}

	/**
	 * Returns the namespace name.
	 *
	 * @return string
	 */
	public function getNamespaceName()
	{
		return null;
	}

	/**
	 * Returns the parent class reflection.
	 *
	 * @return \TokenReflection\ReflectionClass|null
	 */
	public function getParentClass()
	{
		return null;
	}

	/**
	 * Returns the parent classes reflections.
	 *
	 * @return array
	 */
	public function getParentClasses()
	{
		return array();
	}

	/**
	 * Returns the parent classes names.
	 *
	 * @return array
	 */
	public function getParentClassNameList()
	{
		return array();
	}

	/**
	 * Returns the parent class reflection.
	 *
	 * @return \TokenReflection\ReflectionClass
	 */
	public function getParentClassName()
	{
		return null;
	}

	/**
	 * Returns class properties.
	 *
	 * @param integer $filter Property types
	 * @return array
	 */
	public function getProperties($filter = null)
	{
		return array();
	}

	/**
	 * Return a property reflections.
	 *
	 * @param string $name Property name
	 * @return \TokenReflection\ReflectionProperty
	 */
	public function getProperty($name)
	{
		throw new Exception(sprintf('There is no property %s in class %s', $name, $this->name), Exception::DOES_NOT_EXIST);
	}

	/**
	 * Returns static properties reflections.
	 *
	 * @return array
	 */
	public function getStaticProperties()
	{
		return array();
	}

	/**
	 * Returns a value of a static property.
	 *
	 * @param string $name Property name
	 * @param mixed $default Default value
	 * @return mixed
	 */
	public function getStaticPropertyValue($name, $default = null)
	{
		throw new Exception(sprintf('There is no static property %s in class %s', $name, $this->name), Exception::DOES_NOT_EXIST);
	}

	/**
	 * Returns interfaces implemented by this class, not its parents.
	 *
	 * @return array
	 */
	public function getOwnInterfaces()
	{
		return array();
	}

	/**
	 * Returns names of interfaces implemented by this class, not its parents.
	 *
	 * @return array
	 */
	public function getOwnInterfaceNames()
	{
		return array();
	}

	/**
	 * Returns methods declared by this class, not its parents.
	 *
	 * @param integer $filter Method filter
	 * @return array
	 */
	public function getOwnMethods($filter = null)
	{
		return array();
	}

	/**
	 * Returns properties declared by this class, not its parents.
	 *
	 * @param integer $filter Properties filter
	 * @return array
	 */
	public function getOwnProperties($filter = null)
	{
		return array();
	}

	/**
	 * Returns constants declared by this class, not its parents
	 *
	 * @return array
	 */
	public function getOwnConstants()
	{
		return array();
	}

	/**
	 * Returns if the class defines the given constant.
	 *
	 * @param string $name Constant name.
	 * @return boolean
	 */
	public function hasConstant($name)
	{
		return false;
	}

	/**
	 * Returns if the class (and not its parents) defines the given constant.
	 *
	 * @param string $name Constant name.
	 * @return boolean
	 */
	public function hasOwnConstant($name)
	{
		return false;
	}

	/**
	 * Returns if the class implements the given method.
	 *
	 * @param string $name Method name
	 * @return boolean
	 */
	public function hasMethod($name)
	{
		return false;
	}

	/**
	 * Returns if the class implements (and not its parents) the given method.
	 *
	 * @param string $name Method name
	 * @return boolean
	 */
	public function hasOwnMethod($name)
	{
		return false;
	}

	/**
	 * Returns if the class implements the given property.
	 *
	 * @param string $name Property name
	 * @return boolean
	 */
	public function hasProperty($name)
	{
		return false;
	}

	/**
	 * Returns if the class (and not its parents) implements the given property.
	 *
	 * @param string $name Property name
	 * @return boolean
	 */
	public function hasOwnProperty($name)
	{
		return false;
	}

	/**
	 * Returns if the class implements the given interface.
	 *
	 * @param string|object $interface Interface name or reflection object
	 * @return boolean
	 */
	public function implementsInterface($interface) {
		if (is_object($interface)) {
			if (!$interface instanceof IReflectionClass) {
				throw new InvalidArgumentException('Parameter must be a string or an instance of class reflection');
			}

			$interfaceName = $interface->getName();

			if (!$interface->isInterface()) {
				throw new RuntimeException(sprintf('%s is not an interface.', $interfaceName));
			}
		}

		// Only validation, always returns false
		return false;
	}

	/**
	 * Returns if the class is defined within a namespace.
	 *
	 * @return boolean
	 */
	public function inNamespace()
	{
		return false;
	}

	/**
	 * Returns if the class is abstract.
	 *
	 * @return boolean
	 */
	public function isAbstract()
	{
		return false;
	}

	/**
	 * Returns if the class is final.
	 *
	 * @return boolean
	 */
	public function isFinal()
	{
		return false;
	}

	/**
	 * Returns if the current reflection comes from a tokenized source.
	 *
	 * @return boolean
	 */
	public function isTokenized()
	{
		return false;
	}

	/**
	 * Returns if the given object is an instance of this class.
	 *
	 * @param object $object Instance
	 * @return boolean
	 */
	public function isInstance($object)
	{
		if (!is_object($object)) {
			throw new Exception(sprintf('A class instance must be provided (%s set)', gettype($object)));
		}

		return $this->name === get_class($object) || is_subclass_of($object, $this->name);
	}

	/**
	 * Returns if it is possible to create an instance of this class.
	 *
	 * @return boolean
	 */
	public function isInstantiable()
	{
		return false;
	}

	/**
	 * Returns if objects of this class are cloneable.
	 *
	 * Not implemented in 5.3, but in trunk though.
	 *
	 * @return boolean
	 * @see http://svn.php.net/viewvc/php/php-src/trunk/ext/reflection/php_reflection.c?revision=307971&view=markup#l4059
	 */
	public function isCloneable()
	{
		return false;
	}

	/**
	 * Returns if the class is an interface.
	 *
	 * @return boolean
	 */
	public function isInterface()
	{
		return false;
	}

	/**
	 * Returns if the class is an exception or its descendant.
	 *
	 * @return boolean
	 */
	public function isException()
	{
		return false;
	}

	/**
	 * Returns if the class is iterateable.
	 *
	 * Returns true if the class implements the Traversable interface.
	 *
	 * @return boolean
	 */
	public function isIterateable()
	{
		return false;
	}

	/**
	 * Returns if the current class is a subclass of the given class.
	 *
	 * @param string|object $class Class name or reflection object
	 * @return boolean
	 */
	public function isSubclassOf($class)
	{
		return false;
	}

	/**
	 * Returns reflections of direct subclasses.
	 *
	 * @return array
	 */
	public function getDirectSubclasses()
	{
		$that = $this->name;
		return array_filter($this->getBroker()->getClasses(Broker\Backend::INTERNAL_CLASSES | Broker\Backend::TOKENIZED_CLASSES), function(IReflectionClass $class) use($that) {
			if (!$class->isSubclassOf($that)) {
				return false;
			}

			return null === $class->getParentClassName() || !$class->getParentClass()->isSubClassOf($that);
		});
	}

	/**
	 * Returns names of direct subclasses.
	 *
	 * @return array
	 */
	public function getDirectSubclassNames()
	{
		return array_keys($this->getDirectSubclasses());
	}

	/**
	 * Returns reflections of indirect subclasses.
	 *
	 * @return array
	 */
	public function getIndirectSubclasses()
	{
		$that = $this->name;
		return array_filter($this->getBroker()->getClasses(Broker\Backend::INTERNAL_CLASSES | Broker\Backend::TOKENIZED_CLASSES), function(IReflectionClass $class) use($that) {
			if (!$class->isSubclassOf($that)) {
				return false;
			}

			return null !== $class->getParentClassName() && $class->getParentClass()->isSubClassOf($that);
		});
	}

	/**
	 * Returns names of indirect subclasses.
	 *
	 * @return array
	 */
	public function getIndirectSubclassNames()
	{
		return array_keys($this->getIndirectSubclasses());
	}

	/**
	 * Returns reflections of classes directly implementing this interface.
	 *
	 * @return array
	 */
	public function getDirectImplementers()
	{
		if (!$this->isInterface()) {
			return array();
		}

		$that = $this->name;
		return array_filter($this->getBroker()->getClasses(Broker\Backend::INTERNAL_CLASSES | Broker\Backend::TOKENIZED_CLASSES), function(IReflectionClass $class) use($that) {
			if (!$class->implementsInterface($that)) {
				return false;
			}

			return null === $class->getParentClassName() || !$class->getParentClass()->implementsInterface($that);
		});
	}

	/**
	 * Returns names of classes directly implementing this interface.
	 *
	 * @return array
	 */
	public function getDirectImplementerNames()
	{
		return array_keys($this->getDirectImplementers());
	}

	/**
	 * Returns reflections of classes indirectly implementing this interface.
	 *
	 * @return array
	 */
	public function getIndirectImplementers()
	{
		if (!$this->isInterface()) {
			return array();
		}

		$that = $this->name;
		return array_filter($this->getBroker()->getClasses(Broker\Backend::INTERNAL_CLASSES | Broker\Backend::TOKENIZED_CLASSES), function(IReflectionClass $class) use($that) {
			if (!$class->implementsInterface($that)) {
				return false;
			}

			return null !== $class->getParentClassName() && $class->getParentClass()->implementsInterface($this);
		});
	}

	/**
	 * Returns names of classes indirectly implementing this interface.
	 *
	 * @return array
	 */
	public function getIndirectImplementerNames()
	{
		return array_keys($this->getIndirectImplementers());
	}

	/**
	 * Creates a new instance using variable number of parameters.
	 *
	 * Use any number of constructor paramters as function parameters.
	 *
	 * @return object
	 */
	public function newInstance($args)
	{
		return $this->newInstanceArgs(func_get_args());
	}

	/**
	 * Creates a new instance using an array of parameters.
	 *
	 * @param array $args Array of constructor parameters
	 * @return object
	 */
	public function newInstanceArgs(array $args = array())
	{
		if (!class_exists($this->name, true)) {
			throw new Exception(sprintf('Could not create an instance of class %s; class not found', $this->name));
		}

		$reflection = new InternalReflectionClass($this->name);
		return $reflection->newInstanceArgs($args);
	}

	/**
	 * Sets a static property value.
	 *
	 * @param string $name Property name
	 * @param mixed $value Property value
	 */
	public function setStaticPropertyValue($name, $value)
	{
		throw new Exception(sprintf('There is no static property %s in class %s', $name, $this->name), Exception::DOES_NOT_EXIST);
	}
}