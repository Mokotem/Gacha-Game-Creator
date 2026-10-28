<?php

namespace GachaGameCreator\Modele\Repositories;

use GachaGameCreator\Modele\Data\HaveItem;
use GachaGameCreator\Modele\Repositories\BaseRepository;

class HaveItemRepository extends BaseRepository
{
    private ItemRepository $item;
    private EffectRepository $effect;

    public function __construct(ItemRepository $item, EffectRepository $effect)
    {
        parent::__construct("HaveItem");
        $this->item = $item;
        $this->effect = $effect;
    }

    /**
     * @inheritDoc
     */
    public function fromTable(array $value)
    {
        return new HaveItem(
            $value["idPlayer"],
            $this->item->fromId($value["idItem"]),
            $this->effect->fromId($value["idEffect"]),

        );
    }

    /**
     * @inheritDoc
     */
    public function insert($value): bool
    {

    }
}