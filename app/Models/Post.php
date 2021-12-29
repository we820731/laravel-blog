<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use HasDateTimeFormatter;

    const FEATURED_YES = 1;
    const FEATURED_NO = 0;
    const FEATURED = [
        self::FEATURED_YES => '是',
        self::FEATURED_NO  => '否',
    ];
    const FEATURED_COLOR = [
        self::FEATURED_YES => 'success',
        self::FEATURED_NO  => 'red',
    ];

    const PENDING = 'pending';
    const PUBLISHED = 'published';
    const UNPUBLISHED = 'unpublished';
    const STATUS = [
        self::PENDING => '草稿',
        self::PUBLISHED => '已發布',
        self::UNPUBLISHED => '未發布'
    ];
    const STATUS_COLOR = [
        self::PENDING => 'red',
        self::PUBLISHED => 'success',
        self::UNPUBLISHED => 'warning'
    ];

}
