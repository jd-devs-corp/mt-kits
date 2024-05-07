<?php

namespace App\Models;

 use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
 use Illuminate\Support\Facades\Auth;
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

    public function unpayed_kits(): HasMany{
        return $this->hasMany(UnpayKit::class);
    }

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

        // Obtenez l'ID du panel actuel
        $currentPanelId = $panel->getId();

        // Vérifiez si l'utilisateur est un admin
        if ($this->role == "admin") {
            if ($currentPanelId !== 'admin') {
                // Redirigez vers le panel admin
                redirect()->route('filament.admin.pages.tableau-de-bord');
                return false;
            }
            return true;
        }

        // Vérifiez si l'utilisateur est un fournisseur
        if ($this->role == "fournisseur") {
            if ($currentPanelId !== 'fournisseur') {
                // Redirigez vers le panel fournisseur
                redirect()->route('filament.fournisseur.pages.dashboard');
                return false;
            }
            return true;
        }

        // Si l'utilisateur n'a aucun rôle spécifique, redirigez vers une page par défaut
        redirect()->route('home')->send();
        return false;
    }

    public function logout(): void
    {
        // Déconnexion de Sanctum
        Auth::logout();

        // Invalidation de la session
        session()->invalidate();

        // Redirection vers la page de connexion
        redirect()->route('login');
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
    public function histories()
    {
        return $this->hasMany(History::class, 'user_id');
    }


}
