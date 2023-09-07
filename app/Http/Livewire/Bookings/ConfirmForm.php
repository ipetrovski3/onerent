<?php

namespace App\Http\Livewire\Bookings;

use Livewire\Component;

class ConfirmForm extends Component
{
    public $stepTitle = 'Step 1';
    public $currentStep = 1;

    public function nextStep()
    {
        $this->currentStep++;
        $this->updateStepTitle();
    }

    public function previousStep()
    {
        $this->currentStep--;
        $this->updateStepTitle();
    }

    public function confirmForm()
    {
        // TODO: Handle form confirmation logic here
        // You can submit the form, save data, etc.
        // After confirming, you can close the modal if needed
        $this->emit('formConfirmed');
    }

    private function updateStepTitle()
    {
        if ($this->currentStep === 1) {
            $this->stepTitle = 'Step 1';
        } elseif ($this->currentStep === 2) {
            $this->stepTitle = 'Step 2';
        } elseif ($this->currentStep === 3) {
            $this->stepTitle = 'Step 3';
        }
    }

    public function render()
    {
        return view('livewire.confirm-form');
    }
}
