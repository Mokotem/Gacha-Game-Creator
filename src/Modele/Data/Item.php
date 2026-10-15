<?php

namespace GachaGameCreator\Modele\Data;

class Item extends BaseData
{
    public string $name;
    public int $rarity;
    public string $imageId;
    public Gacha $gacha;
    public string $urlFull;
    public string $urlSmall;
    public ?string $urlSource;
    public string $character;
    public Source $source;

    public function __construct(
        ?int $id,
        string $name,
        int $rarity,
        string $imageId,
        Gacha $gacha,
        string $urlFull,
        string $urlSmall,
        ?string $urlSource,
        string $character,
        Source $source
    )
    {
        parent::__construct($id);
        $this->name = $name;
        $this->rarity = $rarity;
        $this->imageId = $imageId;
        $this->gacha = $gacha;
        $this->urlSmall = $urlSmall;
        $this->urlFull = $urlFull;
        $this->urlSource = $urlSource;
        $this->character = $character;
        $this->source = $source;
    }

    public function getPreviewInGacha(string $tag = "") : string
    {
        return "
        <a class='item' href='index.php?bro=gacha&action=item&id=$this->id'>
        <div $tag>
        <img src='$this->urlSmall'/>
        </div>
        <p>$this->name</p>
        </a>
        ";
    }
}