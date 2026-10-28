<?php

namespace GachaGameCreator\Modele\Data;

class Item extends BaseData
{
    public string $name;
    public int $rarity;
    public string $imageId;
    public int $idGacha;
    public string $urlFull;
    public string $urlSmall;
    public ?string $urlSource;
    public ?string $character;
    public Source $source;

    /** @var array<int>  */
    public array $likes;

    public function __construct(
        ?int $id,
        string $name,
        int $rarity,
        string $imageId,
        int $gacha,
        string $urlFull,
        string $urlSmall,
        ?string $urlSource,
        ?string $character,
        Source $source
    )
    {
        parent::__construct($id);
        $this->name = $name;
        $this->rarity = $rarity;
        $this->imageId = $imageId;
        $this->idGacha = $gacha;
        $this->urlSmall = $urlSmall;
        $this->urlFull = $urlFull;
        $this->urlSource = $urlSource;
        $this->character = $character;
        $this->source = $source;
        $this->likes = [];
    }

    public function preview(string $tag = "") : string
    {
        return "
        <a class='item' href='index.php?bro=gacha&action=item&id=$this->id'>
            <div $tag class='fill'>
            <img src='$this->urlSmall'/>
            </div>
            <p>$this->name</p>
        </a>
        ";
    }
}