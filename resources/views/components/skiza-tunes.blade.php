<!-- Frontend SkizaTunes Component -->
<div class="skiza-tunes py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Skiza Tunes</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Download your favorite skiza tunes and set them as your caller ringback tone today!</p>
        </div>

        @if($skizaTunes->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($skizaTunes as $skizaTune)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $skizaTune->title }}</h3>
                            
                            @if($skizaTune->mp3_file_path)
                                <div class="mb-4">
                                    <audio controls class="w-full">
                                        <source src="{{ asset('storage/' . $skizaTune->mp3_file_path) }}" type="audio/mp3">
                                        Your browser does not support the audio element.
                                    </audio>
                                </div>
                            @endif
                            
                            <div class="mt-6">
                                <button type="button" class="show-instructions-btn bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg w-full flex items-center justify-center" data-id="{{ $skizaTune->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                    Download Instructions
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Instructions Modal -->
            <div id="instructionsModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
                <div class="bg-white rounded-lg shadow-xl max-w-md w-full max-h-90vh overflow-y-auto">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-semibold text-gray-900" id="modalTitle">Download Instructions</h3>
                            <button type="button" id="closeModal" class="text-gray-400 hover:text-gray-500">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div id="modalContent">
                            <!-- Instructions will be loaded here -->
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-gray-600 text-lg">No skiza tunes available at the moment.</p>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('instructionsModal');
        const modalContent = document.getElementById('modalContent');
        const modalTitle = document.getElementById('modalTitle');
        const closeModal = document.getElementById('closeModal');
        
        // Collection of all instruction buttons
        const instructionButtons = document.querySelectorAll('.show-instructions-btn');
        
        // Add click event to all download instruction buttons
        instructionButtons.forEach(button => {
            button.addEventListener('click', function() {
                const tuneId = this.getAttribute('data-id');
                const tuneTitle = this.closest('.bg-white').querySelector('h3').textContent;
                
                // Update modal title
                modalTitle.textContent = tuneTitle + ' - Download Instructions';
                
                // Find the instructions for this skiza tune
                const instructions = @json($skizaTunes->keyBy('id')->map(function($tune) {
                    return [
                        'title' => $tune->title,
                        'instructions' => $tune->download_instructions ?? []
                    ];
                }));
                
                // Get the instructions for this specific tune
                const tuneInstructions = instructions[tuneId]?.instructions || [];
                
                // Generate HTML for instructions
                if (tuneInstructions.length > 0) {
                    let html = '<ol class="list-decimal pl-5 space-y-4">';
                    tuneInstructions.forEach(instruction => {
                        html += `
                            <li>
                                <div class="font-medium">${instruction.step || ''}</div>
                                <div class="text-sm text-gray-600">${instruction.description || ''}</div>
                            </li>
                        `;
                    });
                    html += '</ol>';
                    modalContent.innerHTML = html;
                } else {
                    modalContent.innerHTML = '<p class="text-gray-600">No download instructions available for this tune.</p>';
                }
                
                // Show modal
                modal.classList.remove('hidden');
            });
        });
        
        // Close modal when clicking the close button
        closeModal.addEventListener('click', function() {
            modal.classList.add('hidden');
        });
        
        // Close modal when clicking outside
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
        
        // Close modal with escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                modal.classList.add('hidden');
            }
        });
    });
</script>
@endpush