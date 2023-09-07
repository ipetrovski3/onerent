<div wire:ignore.self class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">{{ $stepTitle }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if($currentStep === 1)
                    Step 1 content
                @elseif($currentStep === 2)
                    Step 2 content
                @elseif($currentStep === 3)
                    Step 3 content
                @endif
            </div>
            <div class="modal-footer">
                @if($currentStep === 1)
                    <button type="button" class="btn btn-primary" wire:click="nextStep">Next</button>
                @elseif($currentStep === 2)
                    <button type="button" class="btn btn-secondary" wire:click="previousStep">Previous</button>
                    <button type="button" class="btn btn-primary" wire:click="nextStep">Next</button>
                @elseif($currentStep === 3)
                    <button type="button" class="btn btn-secondary" wire:click="previousStep">Previous</button>
                    <button type="button" class="btn btn-danger" wire:click="confirmForm">Confirm</button>
                @endif
            </div>
        </div>
    </div>
</div>
