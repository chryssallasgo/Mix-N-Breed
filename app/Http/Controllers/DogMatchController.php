<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DogMatchController extends Controller
{
    public function mix(Request $request)
    {
        $request->validate([
            'breed1' => 'required|string',
            'breed2' => 'required|string',
        ]);

        $breed1 = $request->input('breed1');
        $breed2 = $request->input('breed2');
        $prompt = "A dog that is a mix between a $breed1 and a $breed2, photorealistic, front view";
        $apiUrl = "https://image.pollinations.ai/prompt/" . urlencode($prompt);
        $hybrid_image = $apiUrl;

        $breeds = $this->getBreeds();
        $mix_name = $this->getMixName($breed1, $breed2);
        $mix_info = $this->getMixInfo($breed1, $breed2);

        return view('dogmatch', compact('hybrid_image', 'breeds', 'mix_name', 'mix_info'));
    }

    public function showForm()
    {
        $breeds = [
            'Labrador Retriever',
            'German Shepherd',
            'Golden Retriever',
            'French Bulldog',
            'Bulldog',
            'Poodle',
            'Beagle',
            'Rottweiler',
            'Yorkshire Terrier',
            'Boxer',
            'Dachshund',
            'Pembroke Welsh Corgi',
            'Siberian Husky',
            'Australian Shepherd',
            'Great Dane',
            'Doberman Pinscher',
            'Cavalier King Charles Spaniel',
            'Miniature Schnauzer',
            'Shih Tzu',
            'Boston Terrier'
        ];
        return view('dogmatch', compact('breeds'));
    }
    private function getBreeds()
    {
        return [
            'Labrador Retriever',
            'German Shepherd',
            'Golden Retriever',
            'French Bulldog',
            'Bulldog',
            'Poodle',
            'Beagle',
            'Rottweiler',
            'Yorkshire Terrier',
            'Boxer',
            'Dachshund',
            'Pembroke Welsh Corgi',
            'Siberian Husky',
            'Australian Shepherd',
            'Great Dane',
            'Doberman Pinscher',
            'Cavalier King Charles Spaniel',
            'Miniature Schnauzer',
            'Shih Tzu',
            'Boston Terrier'
        ];
    }
    private function getMixName($breed1, $breed2)
    {
        $mixNames = [
            'Labrador Retriever|Poodle' => 'Labradoodle',
            'Poodle|Labrador Retriever' => 'Labradoodle',
            // Add more known mixes here
        ];
        $key = $breed1 . '|' . $breed2;
        return $mixNames[$key] ?? "{$breed1} x {$breed2}";
    }
    private function getMixInfo($breed1, $breed2)
    {
        // Example static data for demonstration
        $lifeSpans = [
            'Labrador Retriever' => 12,
            'Poodle' => 14,
            // Add more breeds
        ];
        $compatibility = rand(60, 95); // Placeholder: generate or calculate
        $risk = rand(10, 40); // Placeholder: generate or calculate

        $avgLifeSpan = intval((($lifeSpans[$breed1] ?? 12) + ($lifeSpans[$breed2] ?? 12)) / 2);

        return [
            'life_span' => "{$avgLifeSpan} years",
            'compatibility' => "{$compatibility}%",
            'risk' => "{$risk}%"
        ];
    }
}
