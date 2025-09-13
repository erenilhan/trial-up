<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use OpenAI;

class ActorController extends Controller
{
    public function showForm()
    {
        return view('actors.form');
    }

    public function store(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:actors,email',
            'description' => 'required|string|unique:actors,description',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            // Send description to OpenAI API
            $apiKey = config('services.openai.api_key');
            $client = OpenAI::client($apiKey);

            $response = $client->chat()->create([
                'model' => config('services.openai.model'),
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "Extract the following information from the provided text: First Name, Last Name, Address, Height, Weight, Gender, Age. Return the information in JSON format with these exact keys: first_name, last_name, address, height, weight, gender, age. If any information is not available, use null for that field.\n\nText to analyze: " . $request->description,
                    ],
                ],
                'temperature' => 0.1,
                'max_tokens' => 500,
            ]);
            $content = $response->choices[0]->message->content;
            // Extract JSON from markdown code block if present
            if (preg_match('/```json\s*(.*?)\s*```/s', $content, $matches)) {
                $jsonContent = $matches[1];
            } else {
                // Try to find JSON without code block
                $jsonContent = $content;
            }

            // Parse the JSON response
            $extractedData = json_decode($jsonContent, true);
            if (!$extractedData) {
                throw new Exception('Invalid JSON response from OpenAI');
            }

            // Check if required fields are present
            if (empty($extractedData['first_name']) || empty($extractedData['last_name']) || empty($extractedData['address'])) {
                return redirect()->back()
                    ->withErrors(['description' => 'Please add first name, last name, and address to your description.'])
                    ->withInput();
            }

            // Create actor record
            $actor = Actor::create([
                'email' => $request->email,
                'description' => $request->description,
                'first_name' => $extractedData['first_name'],
                'last_name' => $extractedData['last_name'],
                'address' => $extractedData['address'],
                'height' => $extractedData['height'] ?? null,
                'weight' => $extractedData['weight'] ?? null,
                'gender' => $extractedData['gender'] ?? null,
                'age' => $extractedData['age'] ?? null,
            ]);

            return redirect()->route('actors.table')->with('success', 'Actor information submitted successfully!');

        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors(['description' => 'An error occurred while processing your request. Please try again.'])
                ->withInput();
        }
    }

    public function showTable()
    {
        $actors = Actor::all();
        return view('actors.table', compact('actors'));
    }

    public function promptValidation()
    {
        return response()->json([
            'message' => 'text_prompt'
        ]);
    }
}
