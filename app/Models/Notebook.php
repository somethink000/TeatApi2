<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Notebook
 *
 * @property int $id
 * @property string $name
 * @property string $company
 * @property string $phone
 * @property string $email
 * @property string $birthday
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\NotebookFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Notebook newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notebook newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notebook query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notebook whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notebook whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notebook whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notebook whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notebook whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notebook whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notebook whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notebook wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notebook whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Notebook extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company',
        'phone',
        'email',
        'birthday',
        'image'
    ];
}
