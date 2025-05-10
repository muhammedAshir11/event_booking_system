<?php

namespace App\Http\Requests;

use App\Rules\AvailableTickets;
use Illuminate\Foundation\Http\FormRequest;

class BookTicketsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'event_id' => ['required', 'exists:events,id'],
            'number_of_tickets' => ['required', 'integer', 'min:1', new AvailableTickets($this->event_id)],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages()
    {
        return [
            'event_id.required' => 'Please select an event.',
            'number_of_tickets.required' => 'Please enter the number of tickets.',
            'number_of_tickets.min' => 'You must book at least one ticket.',
        ];
    }
}


