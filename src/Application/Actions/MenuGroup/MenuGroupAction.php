<?php

declare(strict_types=1);

namespace App\Application\Actions\MenuGroup;

use App\Application\Actions\Action;
use App\Domain\Menu\MenuGroupRepository;
use Psr\Log\LoggerInterface;

abstract class MenuGroupAction extends Action
{
    protected MenuGroupRepository $menuGroupRepository;

    public function __construct(LoggerInterface $logger, MenuGroupRepository $menuGroupRepository)
    {
        parent::__construct($logger);
        $this->menuGroupRepository = $menuGroupRepository;
    }
}
