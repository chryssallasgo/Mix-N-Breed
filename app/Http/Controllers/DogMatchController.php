<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\DogProfile;
use Symfony\Component\Process\Process;
use Flasher\Prime\Flasher;

class DogMatchController extends Controller
{
    public function form()
    {
        return view('dogmatch.form');
    }
    public function process(Request $request)
    {
        // Validate and store uploaded images
        $request->validate([
            'dog1' => 'required|image|mimes:jpeg,png,jpg',
            'dog2' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $sessionId = uniqid();
        $path = $request->file('dog1')->move("/workspace/ComfyUI/input", "{$sessionId}_dog1.png");
        $path = $request->file('dog2')->move("/workspace/ComfyUI/input", "{$sessionId}_dog2.png");
        dd($path);

        // Optional: Update ComfyUI workflow JSON to point to these images
        // You can write a helper function to modify the node graph JSON

        // Trigger ComfyUI headless run
        $process = new Process(['python3', '/workspace/ComfyUI/main.py', '--workflow', '/workspace/ComfyUI/workflows/image2image.json']);
        $process->run();

        if (!$process->isSuccessful()) {
            return back()->withErrors(['fusion' => 'Fusion process failed.']);
        }
        exec('python3 /workspace/ComfyUI/main.py --workflow /workspace/ComfyUI/workflows/image2image.json');


        // Return the fused image
        return response()->file(storage_path('app/comfyui/output/fused_dog.png'));

        try {
            $request->validate([
                'dog1' => 'required|image|mimes:jpeg,png,jpg',
                'dog2' => 'required|image|mimes:jpeg,png,jpg',
            ]);

            $request->file('dog1')->move('/workspace/ComfyUI/input', 'dog1.png');
            $request->file('dog2')->move('/workspace/ComfyUI/input', 'dog2.png');

            exec('python3 /workspace/ComfyUI/main.py --workflow /workspace/ComfyUI/workflows/fusion_graph.json');

            Flasher::addSuccess('Fusion complete! 🐶 Your mixed breed is ready.');
            return redirect()->route('dogmatch.form'); // or back to the form with preview
        } catch (\Exception $e) {
            Flasher::addError('Fusion failed: ' . $e->getMessage());
            return back();
        }
    }
}
