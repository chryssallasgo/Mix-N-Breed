<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\DogProfile;
use Symfony\Component\Process\Process;
use Flasher\Prime\Flasher;
use Illuminate\Support\Facades\Storage;

class DogMatchController extends Controller
{
    public function form()
    {
        return view('dogmatch.form');
    }

    public function process(Request $request)
    {
        try {
            $request->validate([
                'selectedProfiles' => 'required|array|size:2',
                'selectedProfiles.*' => 'required|exists:dog_profiles,id',
            ]);

            if (!$request->hasFile('dog1') && !$request->profile1) {
                return back()->withErrors(['dog1' => 'Please upload an image or select a profile for Dog 1.']);
            }
            if (!$request->hasFile('dog2') && !$request->profile2) {
                return back()->withErrors(['dog2' => 'Please upload an image or select a profile for Dog 2.']);
            }

            // generate unique filenames
            $sessionId = uniqid();
            $dog1Name = "{$sessionId}_dog1.png";
            $dog2Name = "{$sessionId}_dog2.png";

            // Get the selected profiles
            $profile1 = DogProfile::findOrFail($request->selectedProfiles[0]);
            $profile2 = DogProfile::findOrFail($request->selectedProfiles[1]);

            // Dog 1 image
            if ($profile1 && $profile1->image) {
                $imagePath = storage_path('app/public/' . $profile1->image);
                if (!Storage::disk('vast')->put($dog1Name, file_get_contents($imagePath))) {
                    throw new \Exception('Failed to process image for first dog.');
                }
            } else {
                throw new \Exception('First selected profile has no image.');
            }

            // Dog 2 image
            if ($profile2 && $profile2->image) {
                $imagePath = storage_path('app/public/' . $profile2->image);
                if (!Storage::disk('vast')->put($dog2Name, file_get_contents($imagePath))) {
                    throw new \Exception('Failed to process image for second dog.');
                }
            } else {
                throw new \Exception('Second selected profile has no image.');
            }

            // load and update the workflow JSON
            $workflowPath = 'workflows/image2image.json';

            if (!Storage::disk('vast')->exists($workflowPath)) {
                throw new \Exception("Workflow file not found at: {$workflowPath}");
            }

            $workflowRaw = Storage::disk('vast')->get($workflowPath);
            $workflow = json_decode($workflowRaw, true);

            if (!is_array($workflow) || !isset($workflow['nodes'])) {
                throw new \Exception("Invalid workflow format or missing 'nodes' key.");
            }

            foreach ($workflow['nodes'] as &$node) {
                if ($node['class_type'] === 'LoadImage') {
                    if (str_contains($node['inputs']['image_path'], 'dog1')) {
                        $node['inputs']['image_path'] = "input/{$dog1Name}";
                    } elseif (str_contains($node['inputs']['image_path'], 'dog2')) {
                        $node['inputs']['image_path'] = "input/{$dog2Name}";
                    }
                }
            }

            // ComfyUI via API
            $response = Http::post('http://1.208.108.242:8188/prompt', [
                'prompt' => $workflow,
                'client_id' => $sessionId,
                'extra_data' => [
                    'dog1_breed' => $profile1->breed,
                    'dog2_breed' => $profile2->breed,
                    'dog1_traits' => $profile1->traits,
                    'dog2_traits' => $profile2->traits
                ]
            ]);

            if ($response->successful()) {
                flash()->success('Fusion triggered via API! 🐶 Your mixed breed is on the way.');

                // Return additional data for Livewire to update the UI
                return response()->json([
                    'success' => true,
                    'message' => 'Processing breed mix...',
                    'session_id' => $sessionId,
                    'dog1_info' => [
                        'breed' => $profile1->breed,
                        'traits' => $profile1->traits
                    ],
                    'dog2_info' => [
                        'breed' => $profile2->breed,
                        'traits' => $profile2->traits
                    ]
                ]);
            } else {
                throw new \Exception('API trigger failed: ' . $response->body());
            }
        } catch (\Exception $e) {
            flash()->error('Fusion failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    // Add a method to check processing status if needed
    public function checkStatus($sessionId)
    {
        try {
            $response = Http::get('http://1.208.108.242:8188/history/' . $sessionId);

            if ($response->successful()) {
                return response()->json($response->json());
            }

            return response()->json(['status' => 'processing']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
