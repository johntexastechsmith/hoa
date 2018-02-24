<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hoa extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hoa';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Get the properties in the HOA
     */
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    /**
     * Get the properties in the HOA
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * Get the properties in the HOA
     */
    public function owners()
    {
        return $this->hasMany(Owner::class);
    }

    /**
     * Get the properties in the HOA
     */
    public function boardmembers()
    {
        return $this->hasMany(BoardMember::class);
    }
    
    /**
     * Get the settings for this HOA
     */
    public function settings()
    {
        return $this->hasMany(Setting::class);
    }

    /**
     * @param $name
     * @param $value
     * @return Setting
     */
    public function createOrUpdateSetting($name, $value)
    {
        $setting = Setting::where('name', $name)->first();
        $setting = ($setting instanceof Setting) ? $setting : new Setting();
        $setting->name = $name;
        $setting->value = $value;

        return $this->settings()->save($setting);
    }

    public function getSetting($name)
    {
        return Setting::where('hoa_id', $this->id)->where('name', $name)->first();
    }

    public function getSettingValue($name)
    {
        if (Setting::where('hoa_id', $this->id)->where('name', $name)->first() instanceof Setting) {
            return Setting::where('hoa_id', $this->id)->where('name', $name)->first()->value;
        } else {
            return null;
        }
    }
}
