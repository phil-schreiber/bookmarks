<?php
/**
 * @author Philipp Schreiber <phil.schreiber@ephemeroid.net>
 * 
 * @category Interface
 * @package  bookmarks 
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/phil-schreiber/bookmarks
 */

namespace bm\model;

abstract class AbstractEntity implements \JsonSerializable
{
    /*
     * crediting Alejandro Gervasio's https://www.sitepoint.com/building-a-domain-model/ for this implementation of abstract entities  
     *      
     **/
    
    public function __set($name, $value) {
        $field = "_" . strtolower($name);

        if (!property_exists($this, $field)) {
            throw new InvalidArgumentException(
                "Setting the field '$field' is not valid for this entity.");
        }

        $mutator = "set" . ucfirst(strtolower($name));
        if (method_exists($this, $mutator) &&is_callable(array($this, $mutator))) {
            $this->$mutator($value);
        } else {
            $this->$field = $value;
        }

        return $this;
    }

    
    public function __get($name) {
        $field = "_" . strtolower($name);

        if (!property_exists($this, $field)) {
            throw new InvalidArgumentException(
                "Getting the field '$field' is not valid for this entity.");
        }

        $accessor = "get" . ucfirst(strtolower($name));
        return (method_exists($this, $accessor) &&
            is_callable(array($this, $accessor)))
            ? $this->$accessor() : $this->field;
    }

    /**
     * Get the entity fields
     */
    public function toArray() {
        return get_object_vars($this);
    }
    
    abstract public function jsonSerialize();
}