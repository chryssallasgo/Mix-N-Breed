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
                'dog1' => 'nullable|image|mimes:jpeg,png,jpg',
                'dog2' => 'nullable|image|mimes:jpeg,png,jpg',
                'profile1' => 'nullable|exists:dog_profiles,id',
                'profile2' => 'nullable|exists:dog_profiles,id',
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

            // Dog 1 image
            if ($request->hasFile('dog1')) {
                Storage::disk('vast')->put($dog1Name, file_get_contents($request->file('dog1')));
            } elseif ($request->profile1) {
                $profile1 = \App\Models\DogProfile::find($request->profile1);
                if ($profile1 && $profile1->image) {
                    $imagePath = storage_path('app/public/' . $profile1->image);
                    Storage::disk('vast')->put($dog1Name, file_get_contents($imagePath));
                } else {
                    throw new \Exception('Selected profile for Dog 1 has no image.');
                }
            }

            // Dog 2 image
            if ($request->hasFile('dog2')) {
                Storage::disk('vast')->put($dog2Name, file_get_contents($request->file('dog2')));
            } elseif ($request->profile2) {
                $profile2 = \App\Models\DogProfile::find($request->profile2);
                if ($profile2 && $profile2->image) {
                    $imagePath = storage_path('app/public/' . $profile2->image);
                    Storage::disk('vast')->put($dog2Name, file_get_contents($imagePath));
                } else {
                    throw new \Exception('Selected profile for Dog 2 has no image.');
                }
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

            //ComfyUI via API
            $response = Http::post('http://1.208.108.242:8188/prompt', [
                'prompt' => $workflow,
                'client_id' => $sessionId,
            ]);

            if ($response->successful()) {
                flash()->success('Fusion triggered via API! 🐶 Your mixed breed is on the way.');
                return redirect()->route('dogmatch.form');
            } else {
                throw new \Exception('API trigger failed: ' . $response->body());
            }
        } catch (\Exception $e) {
            flash()->error('Fusion failed: ' . $e->getMessage());
            return back();
        }
    }
}
