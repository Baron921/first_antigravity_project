<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\JobOffer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Création d'un compte Administrateur RH de test pour simplifier vos essais
        User::factory()->company()->create([
            'name' => 'Recruteur Test',
            'email' => 'rh@jobbox.com',
            'password' => Hash::make('password'), // Mot de passe "password"
            'company_name' => 'TechVision Solutions',
        ]);
        
        // Création d'un compte Candidat de test
        User::factory()->candidate()->create([
            'name' => 'Candidat Modele',
            'email' => 'candidat@jobbox.com',
            'password' => Hash::make('password'), // Mot de passe "password"
        ]);

        // Génération massives pour "peupler la base"
        // 10 entreprises qui publient 5 offres d'emploi chacune !
        User::factory(10)->company()->create([
            'password' => Hash::make('password') // Tous ont le même mot de passe
        ])->each(function (User $company) {
            JobOffer::factory(5)->create([
                'user_id' => $company->id
            ]);
        });
        
        // Et 20 candidats fictifs
        User::factory(20)->candidate()->create([
            'password' => Hash::make('password')
        ]);
    }
}
