<?php

namespace App\Enums;
use App\Traits\EnumTrait;

class LeadStatus
{
    use EnumTrait;

    const UNQUALIFIED = 'unqualified';
    const QUALIFIED = 'qualified';
    const READY_TO_CLOSE = 'ready to close';
    const WON_LOST = 'won/lost';
    const LOST_OPPORTUNITY = 'lost opportunity';
}
