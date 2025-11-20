<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DogProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class DogMatchForm extends Component
{
    public $selectedProfiles = [];
    public $resultImage;
    public $resultBreed;
    public $resultLifespan;
    public $resultSize;
    public $resultTraits;
    public $resultCompatibility;

    public $identifiedBreed1;
    public $identifiedBreed1Confidence;
    public $identifiedBreed2;
    public $identifiedBreed2Confidence;

    public $profiles;
    public $hasProfiles;
    public $isProcessing = false;
    public $currentStep = '';
    public $processingSteps = [
        'identifying' => 'Identifying dog breeds using our trained model...',
        'sending' => 'Sending identified dog images to AI...',
        'analyzing' => 'Analyzing compatibility score...',
        'mixing' => 'Blending images using ComfyUI...',
        'finalizing' => 'Finalizing traits and information...',
    ];

    private function identifyBreeds($dog1, $dog2)
    {
        $this->currentStep = 'identifying';

        try {
            $apiUrl = config('services.breed_identification.url', 'http://localhost:5001');

            // Identify Dog 1
            $dog1Path = storage_path('app/public/' . $dog1->image);
            $response1 = Http::attach(
                'image',
                file_get_contents($dog1Path),
                basename($dog1Path)
            )->post($apiUrl . '/identify');

            if (!$response1->successful()) {
                throw new \Exception('Failed to identify first dog breed');
            }

            // Identify Dog 2
            $dog2Path = storage_path('app/public/' . $dog2->image);
            $response2 = Http::attach(
                'image',
                file_get_contents($dog2Path),
                basename($dog2Path)
            )->post($apiUrl . '/identify');

            if (!$response2->successful()) {
                throw new \Exception('Failed to identify second dog breed');
            }

            $breed1Data = $response1->json();
            $breed2Data = $response2->json();

            // Store identified breeds in component properties
            $this->identifiedBreed1 = $breed1Data['breed'];
            $this->identifiedBreed1Confidence = $breed1Data['confidence_percentage'];
            $this->identifiedBreed2 = $breed2Data['breed'];
            $this->identifiedBreed2Confidence = $breed2Data['confidence_percentage'];

            Log::info('Breed identification results:', [
                'dog1' => $breed1Data,
                'dog2' => $breed2Data
            ]);

            return [
                'dog1' => [
                    'breed' => $breed1Data['breed'],
                    'confidence' => $breed1Data['confidence'],
                    'confidence_percentage' => $breed1Data['confidence_percentage']
                ],
                'dog2' => [
                    'breed' => $breed2Data['breed'],
                    'confidence' => $breed2Data['confidence'],
                    'confidence_percentage' => $breed2Data['confidence_percentage']
                ]
            ];
        } catch (\Exception $e) {
            Log::error('Breed identification failed:', [
                'error' => $e->getMessage()
            ]);

            throw $e;
        }
    }
    public function mount()

    {
        $this->profiles = DogProfile::where('user_id', Auth::id())->get();
        $this->hasProfiles = $this->profiles->count() >= 2;
    }

    public function toggleProfileSelection($profileId)
    {
        if (in_array($profileId, $this->selectedProfiles)) {
            $this->selectedProfiles = array_values(array_diff($this->selectedProfiles, [$profileId]));
        } else {
            if (count($this->selectedProfiles) < 2) {
                $this->selectedProfiles[] = $profileId;
            }
        }
    }

    public function isProfileSelected($profileId)
    {
        return in_array($profileId, $this->selectedProfiles);
    }

    public function canSelectMore()
    {
        return count($this->selectedProfiles) < 2;
    }

    public function getSelectedCount()
    {
        return count($this->selectedProfiles);
    }

    public function clearSelections()
    {
        $this->selectedProfiles = [];
    }

    public function mixBreeds()
    {
        if (count($this->selectedProfiles) !== 2) {
            $this->dispatch('show-error', 'Please select exactly 2 dog profiles');
            return;
        }

        $this->isProcessing = true;
        $this->resetResults();

        try {
            $dog1 = DogProfile::find($this->selectedProfiles[0]);
            $dog2 = DogProfile::find($this->selectedProfiles[1]);

            // Authorization check
            if ($dog1->user_id !== Auth::id() || $dog2->user_id !== Auth::id()) {
                throw new \Exception('Unauthorized access to dog profiles');
            }

            // Step 1: Identify breeds
            $this->currentStep = 'identifying';
            $identifiedBreeds = $this->identifyBreeds($dog1, $dog2);
            sleep(1); // Simulate processing time

            // Step 2: Send to AI
            $this->currentStep = 'sending';
            $preparedImages = $this->prepareImagesForAI($dog1, $dog2, $identifiedBreeds);
            sleep(1);

            // Step 3: Analyze compatibility
            $this->currentStep = 'analyzing';
            $compatibility = $this->analyzeCompatibility($dog1, $dog2);
            sleep(1);

            // Step 4: Mix images using ComfyUI
            $this->currentStep = 'mixing';
            $mixedImage = $this->mixImagesWithComfyUI($preparedImages['dog1'], $preparedImages['dog2']);
            sleep(1);

            // Step 5: Finalize results
            $this->currentStep = 'finalizing';
            $this->finalizeResults($dog1, $dog2, $identifiedBreeds, $compatibility, $mixedImage);
            sleep(1);

            $this->isProcessing = false;
            $this->currentStep = '';
            $this->dispatch('show-success', 'Breed mixing completed!');
        } catch (\Exception $e) {
            Log::error('Breed mixing error: ' . $e->getMessage());
            $this->isProcessing = false;
            $this->currentStep = '';
            $this->dispatch('show-error', 'Failed to mix breeds: ' . $e->getMessage());
        }
    }
    private function prepareImagesForAI($dog1, $dog2, $identifiedBreeds)
    {
        // Rename images based on identified breeds
        $dog1ImagePath = storage_path('app/public/' . $dog1->image);
        $dog2ImagePath = storage_path('app/public/' . $dog2->image);

        // Create temp renamed copies
        $tempDir = storage_path('app/temp/breed_mixing/');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        $dog1NewPath = $tempDir . $identifiedBreeds['dog1']['breed'] . '_' . time() . '_1.jpg';
        $dog2NewPath = $tempDir . $identifiedBreeds['dog2']['breed'] . '_' . time() . '_2.jpg';

        if (file_exists($dog1ImagePath)) {
            copy($dog1ImagePath, $dog1NewPath);
        }
        if (file_exists($dog2ImagePath)) {
            copy($dog2ImagePath, $dog2NewPath);
        }

        return [
            'dog1' => $dog1NewPath,
            'dog2' => $dog2NewPath
        ];
    }

    private function analyzeCompatibility($dog1, $dog2)
    {
        $score = 70; // Base score

        // Same size = higher compatibility
        if ($dog1->size === $dog2->size) $score += 10;

        // Both vaccinated = healthier offspring
        if ($dog1->vaccination_status && $dog2->vaccination_status) $score += 10;

        // Adjust for age differences
        $ageDiff = abs($dog1->age - $dog2->age);
        if ($ageDiff <= 2) $score += 10;

        return min(100, $score);
    }

    private function mixImagesWithComfyUI($imagePath1, $imagePath2)
    {
        // TODO: Implement ComfyUI API integration
        // ComfyUI API endpoint configuration
        $comfyUIUrl = env('COMFYUI_API_URL', 'http://localhost:8188');

        try {
            // Read image files and convert to base64
            $image1Base64 = base64_encode(file_get_contents($imagePath1));
            $image2Base64 = base64_encode(file_get_contents($imagePath2));

            // ComfyUI workflow payload
            $payload = [
                'prompt' => [
                    'workflow' => 'breed_mixing',
                    'images' => [
                        'image1' => $image1Base64,
                        'image2' => $image2Base64
                    ],
                    'parameters' => [
                        'blend_strength' => 0.5,
                        'output_format' => 'jpg'
                    ]
                ]
            ];

            // Send request to ComfyUI
            $response = Http::timeout(60)->post($comfyUIUrl . '/api/prompt', $payload);

            if ($response->successful()) {
                $result = $response->json();

                // Poll for result (ComfyUI is async)
                $promptId = $result['prompt_id'] ?? null;
                if ($promptId) {
                    return $this->pollComfyUIResult($comfyUIUrl, $promptId);
                }
            }

            throw new \Exception('ComfyUI API request failed');
        } catch (\Exception $e) {
            Log::error('ComfyUI error: ' . $e->getMessage());
            // Return placeholder image if ComfyUI fails
            return asset('images/doggielogoprev.png');
        }
    }

    private function pollComfyUIResult($baseUrl, $promptId, $maxAttempts = 30)
    {
        $attempts = 0;

        while ($attempts < $maxAttempts) {
            sleep(2); // Wait 2 seconds between polls

            $response = Http::get($baseUrl . '/api/history/' . $promptId);

            if ($response->successful()) {
                $history = $response->json();

                if (isset($history[$promptId]['outputs'])) {
                    // Get the output image
                    $outputs = $history[$promptId]['outputs'];
                    $imageData = $outputs['images'][0] ?? null;

                    if ($imageData) {
                        // Save the mixed image
                        return $this->saveMixedImage($imageData);
                    }
                }
            }

            $attempts++;
        }

        throw new \Exception('ComfyUI processing timeout');
    }

    private function saveMixedImage($imageData)
    {
        // Save the mixed image to storage
        $mixedDir = storage_path('app/public/mixed_breeds/');
        if (!file_exists($mixedDir)) {
            mkdir($mixedDir, 0755, true);
        }

        $filename = 'mixed_' . time() . '.jpg';
        $filepath = $mixedDir . $filename;

        // Decode and save image
        if (isset($imageData['data'])) {
            file_put_contents($filepath, base64_decode($imageData['data']));
            return 'storage/mixed_breeds/' . $filename;
        }

        return asset('images/doggielogoprev.png');
    }

    private function finalizeResults($dog1, $dog2, $identifiedBreeds, $compatibility, $mixedImage)
    {
        // Calculate mixed breed traits
        $this->resultBreed = $identifiedBreeds['dog1']['breed'] . '-' . $identifiedBreeds['dog2']['breed'] . ' Mix';

        // Average size
        $sizes = ['small' => 1, 'medium' => 2, 'large' => 3];
        $avgSize = ($sizes[$dog1->size] + $sizes[$dog2->size]) / 2;
        if ($avgSize <= 1.5) {
            $this->resultSize = 'Small';
        } elseif ($avgSize <= 2.5) {
            $this->resultSize = 'Medium';
        } else {
            $this->resultSize = 'Large';
        }

        // Average lifespan (assuming you have this data)
        $this->resultLifespan = '10-14 years';

        // Mix personality traits
        $traits1 = array_filter(explode(',', $dog1->personality_traits ?? ''));
        $traits2 = array_filter(explode(',', $dog2->personality_traits ?? ''));
        $mixedTraits = array_unique(array_merge($traits1, $traits2));
        $this->resultTraits = implode(', ', array_slice($mixedTraits, 0, 5)) ?: 'Friendly, Loyal, Energetic';

        // Set compatibility
        $this->resultCompatibility = $compatibility;

        // Set result image
        $this->resultImage = asset($mixedImage);
    }

    private function resetResults()
    {
        $this->resultImage = null;
        $this->resultBreed = null;
        $this->resultLifespan = null;
        $this->resultSize = null;
        $this->resultTraits = null;
        $this->resultCompatibility = null;

        // Reset identified breeds
        $this->identifiedBreed1 = null;
        $this->identifiedBreed1Confidence = null;
        $this->identifiedBreed2 = null;
        $this->identifiedBreed2Confidence = null;
    }
    public function render()
    {
        return view('livewire.dog-match-form', [
            'selectedCount' => $this->getSelectedCount(),
        ]);
    }
}
