<?php

namespace Proxies\__CG__\App\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Compte extends \App\Entity\Compte implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'id', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'solde', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'partenaires', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'idpartenaire', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'numbcompte', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'depots', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'utilisateurs'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'id', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'solde', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'partenaires', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'idpartenaire', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'numbcompte', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'depots', '' . "\0" . 'App\\Entity\\Compte' . "\0" . 'utilisateurs'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Compte $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId(): ?int
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getSolde(): ?int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSolde', []);

        return parent::getSolde();
    }

    /**
     * {@inheritDoc}
     */
    public function setSolde(int $solde): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSolde', [$solde]);

        return parent::setSolde($solde);
    }

    /**
     * {@inheritDoc}
     */
    public function getPartenaires(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPartenaires', []);

        return parent::getPartenaires();
    }

    /**
     * {@inheritDoc}
     */
    public function addPartenaire(\App\Entity\Partenaire $partenaire): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addPartenaire', [$partenaire]);

        return parent::addPartenaire($partenaire);
    }

    /**
     * {@inheritDoc}
     */
    public function removePartenaire(\App\Entity\Partenaire $partenaire): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removePartenaire', [$partenaire]);

        return parent::removePartenaire($partenaire);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdpartenaire(): ?\App\Entity\partenaire
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdpartenaire', []);

        return parent::getIdpartenaire();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdpartenaire(?\App\Entity\partenaire $idpartenaire): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdpartenaire', [$idpartenaire]);

        return parent::setIdpartenaire($idpartenaire);
    }

    /**
     * {@inheritDoc}
     */
    public function getNumbcompte(): ?int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNumbcompte', []);

        return parent::getNumbcompte();
    }

    /**
     * {@inheritDoc}
     */
    public function setNumbcompte(?int $numbcompte): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNumbcompte', [$numbcompte]);

        return parent::setNumbcompte($numbcompte);
    }

    /**
     * {@inheritDoc}
     */
    public function getDepots(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDepots', []);

        return parent::getDepots();
    }

    /**
     * {@inheritDoc}
     */
    public function addDepot(\App\Entity\Depot $depot): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addDepot', [$depot]);

        return parent::addDepot($depot);
    }

    /**
     * {@inheritDoc}
     */
    public function removeDepot(\App\Entity\Depot $depot): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeDepot', [$depot]);

        return parent::removeDepot($depot);
    }

    /**
     * {@inheritDoc}
     */
    public function getUtilisateurs(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUtilisateurs', []);

        return parent::getUtilisateurs();
    }

    /**
     * {@inheritDoc}
     */
    public function addUtilisateur(\App\Entity\User $utilisateur): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addUtilisateur', [$utilisateur]);

        return parent::addUtilisateur($utilisateur);
    }

    /**
     * {@inheritDoc}
     */
    public function removeUtilisateur(\App\Entity\User $utilisateur): \App\Entity\Compte
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeUtilisateur', [$utilisateur]);

        return parent::removeUtilisateur($utilisateur);
    }

}
