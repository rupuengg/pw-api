<?php

declare(strict_types=1);

namespace App\Application\Actions\Menu;

use App\Application\Actions\Action;
use App\Domain\Menu\MenuRepository;
use Psr\Log\LoggerInterface;

abstract class MenuAction extends Action
{
    protected MenuRepository $menuRepository;

    public function __construct(LoggerInterface $logger, MenuRepository $menuRepository)
    {
        parent::__construct($logger);
        $this->menuRepository = $menuRepository;
    }
}
