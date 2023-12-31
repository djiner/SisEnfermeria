<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\hasOne; // Asegúrate de importar BelongsTo
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles;
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use TwoFactorAuthenticatable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'email_verified_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'pivot'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    public function scopePaciente($query){
        return $query->where('role', 'paciente');
    }
    public function scopeEnfermera($query){
        return $query->where('role', 'enfermera');
    }

    public function asDoctorAppointments(){
        return $this->hasMany(Appointment::class, 'doctor_id');
    }
    public function attendedAppointments(){
        return $this->asDoctorAppointments()->where('status', 'Atendida');
    }
    public function cancellAppointments(){
        return $this->asDoctorAppointments()->where('status', 'Cancelada');
    }

    public function asPatientAppointments(){
        return $this->hasMany(Appointment::class, 'patient_id');
    }


    public function persona(): hasOne
    {
        return $this->hasOne(Persona::class);
    }
    public function enfermera(): belongsTo
    {
        return $this->belongsTo(Enfermera::class);
    }
    public function specialties()
    {
        return $this->belongsToMany(Especialidad::class);
    }


}
