<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobOffer;
use Illuminate\Support\Str;

class BotController extends Controller
{
    public function chat(Request $request)
    {
        $message = strtolower($request->input('message', ''));
        
        // Timeout/Pause artificielle pour faire "vrai" (600ms)
        usleep(600000);
        
        // 1. Détection des salutations
        $greetings = ['bonjour', 'salut', 'coucou', 'hey', 'hello'];
        foreach ($greetings as $greet) {
            if (Str::contains($message, $greet)) {
                return response()->json([
                    'reply' => "Bonjour 👋 ! Je suis l'assistant recrutement de Global Jobs. Que recherchez-vous comme type de poste ou dans quelle ville ?"
                ]);
            }
        }
        
        // 2. Détection mots clés de recherche
        // Ex: "Je cherche un emploi de développeur à paris"
        $isSearching = false;
        $searchTerms = ['cherche', 'emploi', 'travail', 'job', 'poste', 'offre', 'avez-vous'];
        
        foreach ($searchTerms as $term) {
            if (Str::contains($message, $term)) {
                $isSearching = true;
                break;
            }
        }
        
        // Extraction des mots pour trouver le titre du job ou la location
        // On vire les mots parasites
        $stopwords = ['je', 'cherche', 'un', 'une', 'des', 'de', 'le', 'la', 'les', 'à', 'en', 'pour', 'avez-vous', 'avez', 'vous', 'emploi', 'travail', 'job', 'poste', 'offre', 'offres', 'salut', 'bonjour', 'est', 'ce', 'que', 'il', 'y', 'a', 'dans'];
        
        $words = explode(' ', preg_replace('/[^a-z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ]/i', ' ', $message));
        
        $keywords = array_filter($words, function($word) use ($stopwords) {
            return strlen($word) > 2 && !in_array($word, $stopwords);
        });
        
        if (count($keywords) > 0 || $isSearching) {
            
            $query = JobOffer::where('is_active', true);
            
            if (count($keywords) > 0) {
                $query->where(function($q) use ($keywords) {
                    foreach ($keywords as $kw) {
                        // Recherche par mot clé dans titre ou localisation ou description
                        $q->orWhere('title', 'ILIKE', '%' . $kw . '%')
                          ->orWhere('location', 'ILIKE', '%' . $kw . '%')
                          ->orWhere('description', 'ILIKE', '%' . $kw . '%');
                    }
                });
            }
            
            $jobs = $query->latest()->take(3)->get();
            
            if ($jobs->count() > 0) {
                $reply = "J'ai inspecté notre base de données et j'ai trouvé <strong>" . $jobs->count() . " offre(s) pertinente(s)</strong> pour vous :<br><br>";
                
                foreach ($jobs as $job) {
                    $company = $job->company->company_name ?? $job->company->name;
                    $url = route('jobs.show', $job->id);
                    $reply .= "<div style='background:#f1f5f9; padding: 10px; border-radius: 8px; margin-bottom: 8px; border: 1px solid #e2e8f0; font-size:13px;'>";
                    $reply .= "<strong>{$job->title}</strong><br>";
                    $reply .= "<span style='color: #475569;'>📍 {$job->location} | 🏢 {$company}</span><br>";
                    $reply .= "<a href='{$url}' style='color: #3b82f6; text-decoration: underline; font-weight: 500;'>Voir l'annonce →</a>";
                    $reply .= "</div>";
                }
                
                $reply .= "N'hésitez pas à me donner d'autres mots-clés si vous souhaitez affiner !";
                return response()->json(['reply' => $reply]);
            } else {
                return response()->json([
                    'reply' => "Mince, je n'ai trouvé aucune offre d'emploi correspondant exactement à vos critères (« " . implode(' ', $keywords) . " ») en ce moment... 😔<br><br>Essayez avec d'autres mots-clés, ou des termes plus généraux (ex: 'développeur', 'paris', etc)."
                ]);
            }
        }
        
        // 3. Fallback générique
        return response()->json([
            'reply' => "Je suis encore un jeune Bot en apprentissage ! 🤖 Pour pouvoir vous aider, dites-moi simplement ce que vous cherchez (ex: <em>'Je cherche un stage à Lyon'</em> ou <em>'Avez-vous des jobs de Développeur ?'</em>)."
        ]);
    }
}
