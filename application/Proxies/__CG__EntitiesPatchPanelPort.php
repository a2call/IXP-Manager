<?php

namespace Proxies\__CG__\Entities;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class PatchPanelPort extends \Entities\PatchPanelPort implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function setPosition($position)
    {
        $this->__load();
        return parent::setPosition($position);
    }

    public function getPosition()
    {
        $this->__load();
        return parent::getPosition();
    }

    public function setMedium($medium)
    {
        $this->__load();
        return parent::setMedium($medium);
    }

    public function getMedium()
    {
        $this->__load();
        return parent::getMedium();
    }

    public function setConnector($connector)
    {
        $this->__load();
        return parent::setConnector($connector);
    }

    public function getConnector()
    {
        $this->__load();
        return parent::getConnector();
    }

    public function setAvailableForUse($availableForUse)
    {
        $this->__load();
        return parent::setAvailableForUse($availableForUse);
    }

    public function getAvailableForUse()
    {
        $this->__load();
        return parent::getAvailableForUse();
    }

    public function setDuplex($duplex)
    {
        $this->__load();
        return parent::setDuplex($duplex);
    }

    public function getDuplex()
    {
        $this->__load();
        return parent::getDuplex();
    }

    public function setColoReference($coloReference)
    {
        $this->__load();
        return parent::setColoReference($coloReference);
    }

    public function getColoReference()
    {
        $this->__load();
        return parent::getColoReference();
    }

    public function setOrdered($ordered)
    {
        $this->__load();
        return parent::setOrdered($ordered);
    }

    public function getOrdered()
    {
        $this->__load();
        return parent::getOrdered();
    }

    public function setCompleted($completed)
    {
        $this->__load();
        return parent::setCompleted($completed);
    }

    public function getCompleted()
    {
        $this->__load();
        return parent::getCompleted();
    }

    public function setCeased($ceased)
    {
        $this->__load();
        return parent::setCeased($ceased);
    }

    public function getCeased()
    {
        $this->__load();
        return parent::getCeased();
    }

    public function setNotes($notes)
    {
        $this->__load();
        return parent::setNotes($notes);
    }

    public function getNotes()
    {
        $this->__load();
        return parent::getNotes();
    }

    public function setDeleted($deleted)
    {
        $this->__load();
        return parent::setDeleted($deleted);
    }

    public function getDeleted()
    {
        $this->__load();
        return parent::getDeleted();
    }

    public function setDeletedOn($deletedOn)
    {
        $this->__load();
        return parent::setDeletedOn($deletedOn);
    }

    public function getDeletedOn()
    {
        $this->__load();
        return parent::getDeletedOn();
    }

    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["id"];
        }
        $this->__load();
        return parent::getId();
    }

    public function setObject(\Entities\PatchPanelPortObject $object)
    {
        $this->__load();
        return parent::setObject($object);
    }

    public function getObject()
    {
        $this->__load();
        return parent::getObject();
    }

    public function setPatchPanelPortObject(\Entities\PatchPanelPortObject $patchPanelPortObject = NULL)
    {
        $this->__load();
        return parent::setPatchPanelPortObject($patchPanelPortObject);
    }

    public function getPatchPanelPortObject()
    {
        $this->__load();
        return parent::getPatchPanelPortObject();
    }

    public function setPatchPanel(\Entities\PatchPanel $patchPanel)
    {
        $this->__load();
        return parent::setPatchPanel($patchPanel);
    }

    public function getPatchPanel()
    {
        $this->__load();
        return parent::getPatchPanel();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'position', 'medium', 'connector', 'available_for_use', 'duplex', 'colo_reference', 'ordered', 'completed', 'ceased', 'notes', 'deleted', 'deleted_on', 'id', 'Object', 'PatchPanelPortObject', 'PatchPanel');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields as $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}