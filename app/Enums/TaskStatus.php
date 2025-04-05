<?php
namespace App\Enums;

enum TaskStatus: string {
    case Pending   = 'pending';
    case Complete  = 'complete';
    case Postpone  = 'postpone';
    case Dismissed = 'dismissed';
}
