<?php

namespace Projeto\BD;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pessoa
 *
 * @ORM\Table(name="pessoa", indexes={@ORM\Index(name="IDX_1CDFAB82F34BC62B", columns={"cd_grupo"})})
 * @ORM\Entity
 */
class Pessoa
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cd_pessoa", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="pessoa_cd_pessoa_seq", allocationSize=1, initialValue=1)
     */
    public $cdPessoa;

    /**
     * @var string
     *
     * @ORM\Column(name="nm_pessoa", type="text", nullable=false)
     */
    public $nmPessoa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_nascimento", type="date", nullable=true)
     */
    public $dtNascimento;

    /**
     * @var \Projeto\BD\Grupo
     *
     * @ORM\ManyToOne(targetEntity="Projeto\BD\Grupo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cd_grupo", referencedColumnName="cd_grupo")
     * })
     */
    public $cdGrupo;


}
