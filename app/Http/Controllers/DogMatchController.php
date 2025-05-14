<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\DogProfile;

class DogMatchController extends Controller
{
    public function mix(Request $request)
    {
        $request->validate([
            'dog1_id' => 'required|exists:dog_profiles,id',
            'dog2_id' => 'required|exists:dog_profiles,id',
        ]);

        $dog1 = DogProfile::find($request->dog1_id);
        $dog2 = DogProfile::find($request->dog2_id);

        $breed1 = $dog1->breed;
        $breed2 = $dog2->breed;

        $prompt = "A dog that is a mix between a $breed1 and a $breed2, photorealistic, front view";
        $apiUrl = "https://image.pollinations.ai/prompt/" . urlencode($prompt);
        $hybrid_image = $apiUrl;

        $mix_name = $this->getMixName($breed1, $breed2);
        $mix_info = $this->getMixInfo($dog1, $dog2); // Updated to pass profiles
        $mixNames = $this->getMixNames($breed1, $breed2);

        sleep(2);
        return [
            'hybrid_image' => $hybrid_image,
            'mix_name' => $mix_name,
            'mix_info' => $mix_info,
            'mixNames' => $mixNames,
        ];
    }
    public function showForm()
    {
        //$profiles = DogProfile::all();
        $profiles = auth()->user()->dogProfiles;
        return view('dogmatch', compact('profiles'));
    }

    private function getMixName($breed1, $breed2)
    {
        $mixNames = $this->getMixNames($breed1, $breed2);
        $key = $breed1 . '|' . $breed2;
        return $mixNames[$key] ?? "{$breed1} x {$breed2}";
    }

    private function getMixInfo(DogProfile $dog1, DogProfile $dog2)
    {
        // Calculate average lifespan
        $avgLifeSpan = intval(($dog1->age + $dog2->age) / 2);

        // Compatibility based on size (example logic)
        $sizeCompatibility = [
            'Small' => ['Small' => 90, 'Medium' => 70, 'Large' => 50],
            'Medium' => ['Small' => 70, 'Medium' => 85, 'Large' => 65],
            'Large' => ['Small' => 50, 'Medium' => 65, 'Large' => 80],
        ];
        $compatibility = $sizeCompatibility[$dog1->size][$dog2->size] ?? rand(60, 95);

        // Risk based on age difference (example logic)
        $ageDiff = abs($dog1->age - $dog2->age);
        $risk = $ageDiff > 5 ? 40 : 20;

        return [
            'life_span' => "{$avgLifeSpan} years",
            'compatibility' => "{$compatibility}%",
            'risk' => "{$risk}%"
        ];
    }

    private function getMixNames(string $breed1, string $breed2): array // Added this function
    {
        $mixes = [
            'Labrador Retriever|Poodle' => 'Labradoodle',
            'Poodle|Labrador Retriever' => 'Labradoodle',
            'Golden Retriever|Poodle' => 'Goldendoodle',
            'Poodle|Golden Retriever' => 'Goldendoodle',
            'Labrador Retriever|German Shepherd' => 'Shepherdador',
            'German Shepherd|Labrador Retriever' => 'Shepherdador',
            'German Shepherd|Poodle' => 'Shepadoodle',
            'Poodle|German Shepherd' => 'Shepadoodle',
            'Beagle|Poodle' => 'Beagapoo',
            'Poodle|Beagle' => 'Beagapoo',
            'Rottweiler|Poodle' => 'Rottle',
            'Poodle|Rottweiler' => 'Rottle',
            'Boxer|Poodle' => 'Boxerdoodle',
            'Poodle|Boxer' => 'Boxerdoodle',
            'Dachshund|Poodle' => 'Doodle',
            'Poodle|Dachshund' => 'Doodle',
            'Shih Tzu|Poodle' => 'Shihpoo',
            'Poodle|Shih Tzu' => 'Shihpoo',
            'Chihuahua|Poodle' => 'Chipoo',
            'Poodle|Chihuahua' => 'Chipoo',
            'Australian Shepherd|Poodle' => 'Aussiedoodle',
            'Poodle|Australian Shepherd' => 'Aussiedoodle',
            'Labrador Retriever|German Shepherd' => 'Shepherdador',
            'German Shepherd|Labrador Retriever' => 'Shepherdador',
            'French Bulldog|Poodle' => 'Frenoodle',
            'Poodle|French Bulldog' => 'Frenoodle',
            'Bulldog|Poodle' => 'Bulladoodle',
            'Poodle|Bulldog' => 'Bulladoodle',
            'Beagle|Labrador Retriever' => 'Beagrador',
            'Labrador Retriever|Beagle' => 'Beagrador',
            'Rottweiler|German Shepherd' => 'Shepweiler',
            'German Shepherd|Rottweiler' => 'Shepweiler',
            'Yorkshire Terrier|Poodle' => 'Yorkipoo',
            'Poodle|Yorkshire Terrier' => 'Yorkipoo',
            'Boxer|German Shepherd' => 'Boxer Shepherd',
            'German Shepherd|Boxer' => 'Boxer Shepherd',
            'Dachshund|German Shepherd' => 'DachShepherd',
            'German Shepherd|Dachshund' => 'DachShepherd',
            'Pembroke Welsh Corgi|Poodle' => 'Corgipoo',
            'Poodle|Pembroke Welsh Corgi' => 'Corgipoo',
            'Siberian Husky|German Shepherd' => 'Gerberian Shepsky',
            'German Shepherd|Siberian Husky' => 'Gerberian Shepsky',
            'Australian Shepherd|Border Collie' => 'Border Aussie',
            'Border Collie|Australian Shepherd' => 'Border Aussie',
            'Great Dane|Poodle' => 'Danedoodle',
            'Poodle|Great Dane' => 'Danedoodle',
            'Doberman Pinscher|Poodle' => 'Doberdoodle',
            'Poodle|Doberman Pinscher' => 'Doberdoodle',
            'Cavalier King Charles Spaniel|Poodle' => 'Cavapoo',
            'Poodle|Cavalier King Charles Spaniel' => 'Cavapoo',
            'Miniature Schnauzer|Poodle' => 'Schnoodle',
            'Poodle|Miniature Schnauzer' => 'Schnoodle',
            'Shih Tzu|Yorkshire Terrier' => 'Shorkie',
            'Yorkshire Terrier|Shih Tzu' => 'Shorkie',
            'Boston Terrier|Poodle' => 'Boosonoodle',
            'Poodle|Boston Terrier' => 'Boosonoodle',
            'Chihuahua|Dachshund' => 'Chiweenie',
            'Dachshund|Chihuahua' => 'Chiweenie',
            'Pit bull|Boxer' => 'Pitboxer',
            'Boxer|Pit bull' => 'Pitboxer',
            // Add more known mixes here
        ];
        $possibleMixes = [];
        foreach ($mixes as $key => $value) {
            if (str_contains($key, $breed1) && str_contains($key, $breed2)) {
                $possibleMixes[$key] = $value;
            }
        }
        return $possibleMixes;
    }
}
