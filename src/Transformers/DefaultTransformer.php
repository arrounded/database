<?php
namespace Arrounded\Database\Transformers;

use Arrounded\Database\Models\AbstractModel;

class DefaultTransformer extends AbstractTransformer
{
    /**
     * Default transformation for an item.
     *
     * @param AbstractModel $item
     *
     * @return array
     */
    public function transform($item)
    {
        return $this->transformWithDefaults($item);
    }
}
