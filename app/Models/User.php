<?php

namespace App\Models;

 use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements FilamentUser, HasName, HasAvatar, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'is_active',
        'password',
        'role',
        'pourcentage',
        'avatar_url',
        'anciennete',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function kits(): HasMany{
        return $this->hasMany(Kit::class);
    }

    public function getUser(){
        return $this;
    }

    /*public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return str_ends_with($this->email, '@gmail.com') && $this->role=="admin";
        }
        else if ($panel->getId() === 'fournisseur') {
            return str_ends_with($this->email, '@gmail.com') && $this->role=="fournisseur";
        }

        return true;
    }*/
    public function canAccessPanel(Panel $panel): bool
    {
        // Si l'utilisateur n'est pas actif, il ne peut pas accéder au panel
        if ($this->is_active == 0) {
            return false;
        }

        if ($panel->getId() === 'admin') {
            return str_ends_with($this->email, '@gmail.com') && $this->role=="admin";
        }
        else if ($panel->getId() === 'fournisseur') {
            return str_ends_with($this->email, '@gmail.com') && $this->role=="fournisseur";
        }

        return true;
    }

    public function getFilamentName(): string
    {
        return "{$this->name}";
    }
    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ? Storage::url($this->avatar_url) : null ;
    }


   /* public function isFournisseur(): bool{
        return $this->role == 'fournisseur';
    }

    public function isAdmin(): bool{
        return $this->role == 'admin';
    }*/
}
