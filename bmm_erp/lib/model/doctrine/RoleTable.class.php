<?php

/**
 * RoleTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class RoleTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object RoleTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Role');
    }
}