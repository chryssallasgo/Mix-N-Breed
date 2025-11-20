@extends('layouts.app')

@section('title', 'Documentation - MixNBreed')

@section('content')
<div class="min-h-screen bg-orange-50 py-8 dark:bg-gray-800">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-orange-700 dark:text-orange-500 mb-4">MixNBreed Documentation</h1>
            <p class="text-xl text-gray-600 dark:text-gray-300">Everything you need to know about using MixNBreed</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-orange-200 mb-8 dark:bg-gray-700 ">
            <h2 class="text-2xl font-bold text-orange-700 mb-4 dark:text-orange-400">Quick Navigation</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="space-y-2">
                    <h3 class="font-semibold text-gray-800 dark:text-gray-200">Getting Started</h3>
                    <ul class="space-y-1 text-sm">
                        <li><a href="#account-setup" class="text-orange-600 hover:text-orange-800">Account Setup</a></li>
                        <li><a href="#first-profile" class="text-orange-600 hover:text-orange-800">Creating Your First Dog Profile</a></li>
                        <li><a href="#profile-management" class="text-orange-600 hover:text-orange-800">Managing Profiles</a></li>
                    </ul>
                </div>
                <div class="space-y-2">
                    <h3 class="font-semibold text-gray-800 dark:text-gray-200">Features</h3>
                    <ul class="space-y-1 text-sm">
                        <li><a href="#breed-mixing" class="text-orange-600 hover:text-orange-800">AI Breed Mixing</a></li>
                        <li><a href="#marketplace" class="text-orange-600 hover:text-orange-800">Marketplace</a></li>
                        <li><a href="#search-filter" class="text-orange-600 hover:text-orange-800">Search & Filtering</a></li>
                    </ul>
                </div>
                <div class="space-y-2">
                    <h3 class="font-semibold text-gray-800 dark:text-gray-200">Help & Support</h3>
                    <ul class="space-y-1 text-sm">
                        <li><a href="#troubleshooting" class="text-orange-600 hover:text-orange-800">Troubleshooting</a></li>
                        <li><a href="#faq" class="text-orange-600 hover:text-orange-800">FAQ</a></li>
                        <li><a href="#api-reference" class="text-orange-600 hover:text-orange-800">API Reference</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="account-setup" class="bg-white dark:bg-gray-700 rounded-xl shadow-lg p-8 border-2 border-orange-200 mb-8">
            <h2 class="text-3xl font-bold text-orange-700 mb-6 dark:text-orange-400">🚀 Getting Started</h2>
            
            <div class="space-y-8">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 dark:text-gray-200">Account Setup</h3>
                    <div class="prose text-gray-600 dark:text-gray-300">
                        <ol class="list-decimal list-inside space-y-2">
                            <li>Click the <strong>"Sign Up"</strong> button in the top navigation</li>
                            <li>Fill in your name, email, and create a secure password</li>
                            <li>Verify your email address (check spam folder if needed)</li>
                            <li>Complete your profile by setting your region for marketplace features</li>
                        </ol>
                    </div>
                </div>

                <div id="first-profile">
                    <h3 class="text-xl font-semibold dark:text-gray-100 text-gray-800 mb-4">Creating Your First Dog Profile</h3>
                    <div class="bg-orange-50 p-4 rounded-lg mb-4">
                        <p class="text-sm text-orange-800"><strong>💡 Tip:</strong> Having detailed profiles helps get better AI breed mixing results!</p>
                    </div>
                    <div class="prose text-gray-600 dark:text-gray-300">
                        <ol class="list-decimal list-inside space-y-2">
                            <li>Navigate to <strong>"Dog Profiles"</strong> from the main menu</li>
                            <li>Click the <strong>"Add New Profile"</strong> button</li>
                            <li>Fill in basic information:
                                <ul class="list-disc list-inside ml-4 mt-2 space-y-1">
                                    <li>Name, breed, age, size, weight</li>
                                    <li>Health information (vaccination status, spayed/neutered)</li>
                                    <li>Personality traits and characteristics</li>
                                </ul>
                            </li>
                            <li>Upload a clear photo of your dog</li>
                            <li>Add owner contact information</li>
                            <li>Save your profile - it's now ready to use!</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div id="breed-mixing" class="bg-white dark:bg-gray-700 rounded-xl shadow-lg p-8 border-2 border-orange-200 mb-8">
            <h2 class="text-3xl font-bold text-orange-700 mb-6 dark:text-orange-400">🧬 AI Breed Mixing</h2>
            
            <div class="space-y-6">
                <div>
                    <h3 class="text-xl font-semibold dark:text-gray-100 text-gray-800 mb-4">How It Works</h3>
                    <p class="text-gray-600 mb-4 dark:text-gray-300">Our AI-powered breed mixing uses ComfyUI technology to predict potential offspring characteristics when combining two dog breeds.</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-semibold dark:text-gray-100 text-gray-800 mb-2">Step-by-Step Process:</h4>
                            <ol class="list-decimal list-inside space-y-1 text-sm text-gray-600 dark:text-gray-300">
                                <li>Select two dog profiles from your collection</li>
                                <li>Click "Mix Breeds" button</li>
                                <li>AI analyzes breed characteristics</li>
                                <li>View predicted offspring traits</li>
                                <li>See visual representation of potential results</li>
                            </ol>
                        </div>
                        <div>
                            <h4 class="font-semibold dark:text-gray-100 text-gray-800 mb-2">What You'll Get:</h4>
                            <ul class="list-disc list-inside space-y-1 text-sm text-gray-600 dark:text-gray-300">
                                <li>Predicted size and weight ranges</li>
                                <li>Coat color and pattern possibilities</li>
                                <li>Temperament characteristics</li>
                                <li>Health considerations</li>
                                <li>Lifespan estimates</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                    <p class="text-sm text-yellow-800"><strong>⚠️ Important:</strong> AI predictions are for educational purposes only. Always consult with veterinarians and professional breeders for actual breeding decisions.</p>
                </div>
            </div>
        </div>

        <div id="marketplace" class="bg-white dark:bg-gray-700 rounded-xl shadow-lg p-8 border-2 border-orange-200 mb-8">
            <h2 class="text-3xl font-bold text-orange-700 mb-6 dark:text-orange-400">🏪 Marketplace</h2>
            
            <div class="space-y-6">
                <div>
                    <h3 class="text-xl font-semibold dark:text-gray-100 text-gray-800 mb-4">Adding Profiles to Marketplace</h3>
                    <div class="prose text-gray-600 dark:text-gray-300">
                        <ol class="list-decimal list-inside space-y-2">
                            <li>Go to your Dog Profiles page</li>
                            <li>Find the profile you want to list</li>
                            <li>Click <strong>"Add to Marketplace"</strong></li>
                            <li>Set pricing and category (Puppies, Adult Dogs, Breeding, Adoption)</li>
                            <li>Write a marketplace description</li>
                            <li>Add your contact information</li>
                            <li>Your profile is now visible to users in your region</li>
                        </ol>
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-semibold dark:text-gray-100 text-gray-800 mb-4">Browsing the Marketplace</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-semibold dark:text-gray-100 text-gray-800 mb-2">Search & Filter Options:</h4>
                            <ul class="list-disc list-inside space-y-1 text-sm text-gray-600 dark:text-gray-300">
                                <li>Search by dog name, breed, or traits</li>
                                <li>Filter by region/location</li>
                                <li>Filter by category (Puppies, Adults, etc.)</li>
                                <li>Filter by price range</li>
                                <li>Toggle between local and all regions</li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-semibold dark:text-gray-100 text-gray-800 mb-2">Safety Tips:</h4>
                            <ul class="list-disc list-inside space-y-1 text-sm text-gray-600 dark:text-gray-300">
                                <li>Meet sellers in public places</li>
                                <li>Ask for health certificates</li>
                                <li>Verify vaccination records</li>
                                <li>Report suspicious listings</li>
                                <li>Trust your instincts</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="faq" class="bg-white dark:bg-gray-700 rounded-xl shadow-lg p-8 border-2 border-orange-200 mb-8">
            <h2 class="text-3xl font-bold text-orange-700 dark:text-orange-400 mb-6">❓ Frequently Asked Questions</h2>
            
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-semibold dark:text-gray-100 text-gray-800 mb-2">Is MixNBreed free to use?</h3>
                    <p class="text-gray-600 dark:text-gray-300">Yes! Creating profiles and using our AI breed mixing feature is completely free. Marketplace listings are also free for individual users.</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold dark:text-gray-100 text-gray-800 mb-2">How accurate are the AI breed predictions?</h3>
                    <p class="text-gray-600 dark:text-gray-300">Our AI provides educational estimates based on known breed characteristics. Results should be used for informational purposes only and not as definitive breeding advice.</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold dark:text-gray-100 text-gray-800 mb-2">Can I edit my dog profiles after creating them?</h3>
                    <p class="text-gray-600 dark:text-gray-300">Absolutely! Click the "Edit" button on any profile to update information, photos, or marketplace settings.</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold dark:text-gray-100 text-gray-800 mb-2">What image formats are supported?</h3>
                    <p class="text-gray-600 dark:text-gray-300">We support JPG, PNG, and GIF formats. Images should be under 5MB for best performance.</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold dark:text-gray-100 text-gray-800 mb-2">How do I change my region for marketplace listings?</h3>
                    <p class="text-gray-600 dark:text-gray-300">Go to your Profile settings and update your region. This affects which marketplace listings you see by default.</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold dark:text-gray-100 text-gray-800 mb-2">Can I remove my profile from the marketplace?</h3>
                    <p class="text-gray-600 dark:text-gray-300">Yes, click "Remove from Marketplace" on any profile to make it private again. You can re-add it anytime.</p>
                </div>
            </div>
        </div>


        <div id="api-reference" class="bg-white dark:bg-gray-700 rounded-xl shadow-lg p-8 border-2 border-orange-200 mb-8">
            <h2 class="text-3xl font-bold text-orange-700 dark:text-orange-400 mb-6">⚙️ Technical Information</h2>
            
            <div class="space-y-6">
                <div>
                    <h3 class="text-xl font-semibold dark:text-gray-100 text-gray-800 mb-4">System Requirements</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-2">Browser Support:</h4>
                            <ul class="list-disc list-inside space-y-1 text-sm dark:text-gray-200 text-gray-600">
                                <li>Chrome 90+</li>
                                <li>Firefox 88+</li>
                                <li>Safari 14+</li>
                                <li>Edge 90+</li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-semibold dark:text-gray-100 text-gray-800 mb-2">Mobile Devices:</h4>
                            <ul class="list-disc list-inside space-y-1 text-sm dark:text-gray-200 text-gray-600">
                                <li>iOS 14+ (Safari)</li>
                                <li>Android 8+ (Chrome)</li>
                                <li>Responsive design for all screen sizes</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-semibold dark:text-gray-100 text-gray-800 mb-4">Technology Stack</h3>
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                            <div>
                                <h5 class="font-semibold dark:text-gray-100 text-gray-800 mb-2">Backend:</h5>
                                <ul class="space-y-1 dark:text-gray-200 text-gray-600">
                                    <li>Laravel 10.x</li>
                                    <li>PHP 8.1+</li>
                                    <li>MySQL Database</li>
                                </ul>
                            </div>
                            <div>
                                <h5 class="font-semibold dark:text-gray-100 text-gray-800 mb-2">Frontend:</h5>
                                <ul class="space-y-1 dark:text-gray-200 text-gray-600">
                                    <li>Livewire 3.x</li>
                                    <li>TailwindCSS</li>
                                    <li>Vite.js</li>
                                </ul>
                            </div>
                            <div>
                                <h5 class="font-semibold dark:text-gray-100 text-gray-800 mb-2">AI Integration:</h5>
                                <ul class="space-y-1 dark:text-gray-200 text-gray-600">
                                    <li>ComfyUI API</li>
                                    <li>Image Processing</li>
                                    <li>Machine Learning</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="troubleshooting" class="bg-white dark:bg-gray-700 rounded-xl shadow-lg p-8 border-2 border-orange-200 mb-8">
            <h2 class="text-3xl font-bold text-orange-700 dark:text-orange-400 mb-6">🔧 Troubleshooting</h2>
            
            <div class="space-y-6">
                <div>
                    <h3 class="text-xl font-semibold dark:text-gray-100 text-gray-800 mb-4">Common Issues</h3>
                    
                    <div class="space-y-4">
                        <div class="border-l-4 border-orange-400 pl-4">
                            <h4 class="font-semibold dark:text-gray-100 text-gray-800 mb-1">Image upload not working</h4>
                            <p class="text-sm dark:text-gray-200 text-gray-600 mb-2">If you can't upload images:</p>
                            <ul class="list-disc list-inside text-sm dark:text-gray-200 text-gray-600 ml-4 space-y-1">
                                <li>Check file size (max 5MB)</li>
                                <li>Ensure file format is JPG, PNG, or GIF</li>
                                <li>Try refreshing the page</li>
                                <li>Check your internet connection</li>
                            </ul>
                        </div>

                        <div class="border-l-4 border-orange-400 pl-4">
                            <h4 class="font-semibold dark:text-gray-100 text-gray-800 mb-1">AI breed mixing taking too long</h4>
                            <p class="text-sm dark:text-gray-200 text-gray-600 mb-2">If the AI processing is slow:</p>
                            <ul class="list-disc list-inside text-sm dark:text-gray-200 text-gray-600 ml-4 space-y-1">
                                <li>Wait up to 2 minutes for processing</li>
                                <li>Check your internet connection</li>
                                <li>Try with different dog profiles</li>
                                <li>Refresh the page if it's stuck</li>
                            </ul>
                        </div>

                        <div class="border-l-4 border-orange-400 pl-4">
                            <h4 class="font-semibold dark:text-gray-100 text-gray-800 mb-1">Can't see marketplace listings</h4>
                            <p class="text-sm dark:text-gray-200 text-gray-600 mb-2">If the marketplace appears empty:</p>
                            <ul class="list-disc list-inside text-sm dark:text-gray-200 text-gray-600 ml-4 space-y-1">
                                <li>Check your region filter settings</li>
                                <li>Try "Show All Regions" option</li>
                                <li>Clear search filters</li>
                                <li>There may be no listings in your area yet</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-700 rounded-xl shadow-lg p-8 border-2 border-orange-200 mb-8 text-center">
            <h2 class="text-2xl font-bold text-orange-700 dark:text-orange-400 mb-4">Need More Help?</h2>
            <p class="text-gray-600 dark:text-gray-200 mb-6">Can't find what you're looking for? We're here to help!</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('contactus') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    Contact Support
                </a>
                <a href="{{ route('about') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    About MixNBreed
                </a>
            </div>
        </div>
    </div>
</div>

<style>
/* Smooth scrolling for anchor links */
html {
    scroll-behavior: smooth;
}

/* Custom line clamp for text truncation */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection