<?php
namespace App\model;

use App\model\Jogo;
use JsonSerializable;

class Jogador implements JsonSerializable {

    private ?int $id;
    private ?string $nomejogador;
    private ?string $apelido;
    private ?int $idade;
    private ?string $plataforma;
    private ?string $contextra;
    private ?Jogo $jogo;

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'nomejogador' => $this->nomejogador,
            'apelido' => $this->apelido,
            'idade' => $this->idade,
            'plataforma' => $this->plataforma,
            'contextra' => $this->contextra,
            'jogo' => $this->jogo ? $this->jogo->jsonSerialize() : null
        ];
    }
    
    
    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNomeJogador(): ?string
    {
        return $this->nomejogador;
    }

    /**
     * Set the value of nome
     */
    public function setNomeJogador(?string $nomejogador): self
    {
        $this->nomejogador = $nomejogador;

        return $this;
    }

    /**
     * Get the value of idade
     */
    public function getIdade(): ?int
    {
        return $this->idade;
    }

    /**
     * Set the value of idade
     */
    public function setIdade(?int $idade): self
    {
        $this->idade = $idade;

        return $this;
    }
        /**
     * Get the value of plataforma
     */
    public function getPlataforma(): ?string
    {
        return $this->plataforma;
    }

    /**
     * Set the value of plataforma
     */
    public function setPlataforma(?string $plataforma): self
    {
        $this->plataforma = $plataforma;

        return $this;
    }

    /**
     * Get the value of estrangeiro
     */
    public function getContExtra(): ?string
    {
        return $this->contextra;
    }

    //Método para retornar um texto de acordo com o valor do atributo contextra
    public function getContExtraTexto() {
        if($this->contextra && $this->contextra == "S")
            return "Sim";

        return "Não";
    }

    /**
     * Set the value of contextra
     */
    public function setContExtra(?string $contextra): self
    {
        $this->contextra = $contextra;

        return $this;
    }

    /**
     * Get the value of jogo
     */
    public function getJogo(): ?Jogo
    {
        return $this->jogo;
    }

    /**
     * Set the value of jogo
     */
    public function setJogo(?Jogo $jogo): self
    {
        $this->jogo = $jogo;

        return $this;
    }

    /**
     * Get the value of apelido
     */
    public function getApelido(): ?string
    {
        return $this->apelido;
    }

    /**
     * Set the value of apelido
     */
    public function setApelido(?string $apelido): self
    {
        $this->apelido = $apelido;

        return $this;
    }
}