<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRule extends Model
{
    const TYPE_SHOW = 'show';
    const TYPE_HIDE = 'hide';
    const TYPE_HIDE_OTHERS = 'hide_others';

}
