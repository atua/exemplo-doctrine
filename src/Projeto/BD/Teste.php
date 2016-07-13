<?php

namespace Projeto\BD;

use Doctrine\ORM\Mapping as ORM;

/**
 * Teste
 *
 * @ORM\Table(name="teste")
 * @ORM\Entity
 */
class Teste
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cd_teste", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="teste_cd_teste_seq", allocationSize=1, initialValue=1)
     */
    private $cdTeste;

    /**
     * @var string
     *
     * @ORM\Column(name="nm_teste", type="text", nullable=false)
     */
    private $nmTeste;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Projeto\BD\Grupo", mappedBy="cdTeste")
     */
    private $cdGrupo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cdGrupo = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
