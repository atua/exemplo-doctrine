<?php

namespace Projeto\BD;

use Doctrine\ORM\Mapping as ORM;

/**
 * Grupo
 *
 * @ORM\Table(name="grupo")
 * @ORM\Entity
 */
class Grupo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cd_grupo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="grupo_cd_grupo_seq", allocationSize=1, initialValue=1)
     */
    private $cdGrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="nm_grupo", type="text", nullable=false)
     */
    private $nmGrupo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Projeto\BD\Teste", inversedBy="cdGrupo")
     * @ORM\JoinTable(name="grupo_teste",
     *   joinColumns={
     *     @ORM\JoinColumn(name="cd_grupo", referencedColumnName="cd_grupo")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="cd_teste", referencedColumnName="cd_teste")
     *   }
     * )
     */
    private $cdTeste;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cdTeste = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
