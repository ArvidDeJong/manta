<?php

namespace Darvis\Manta\Http\Controllers;

use Darvis\Manta\Models\Mailtrap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MailtrapWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Log alle ontvangen data voor debugging
        Log::info('Mailtrap Webhook Ontvangen:', $request->all());

        // Haal de lijst met events op
        $events = $request->input('events', []);

        // Itereer over elk event
        foreach ($events as $event) {
            Mailtrap::create([
                'email' => $event['email'] ?? null,
                'event' => $event['event'] ?? null,
                'timestamp' => $event['timestamp'] ?? null,
                'sending_stream' => $event['sending_stream'] ?? null,
                'category' => $event['category'] ?? null,
                'message_id' => $event['message_id'] ?? null,
                'event_id' => $event['event_id'] ?? null,
                'custom_variables' => $event['custom_variables'] ?? [], // Array direct opslaan
            ]);

            $eventType = $event['event'] ?? 'onbekend';
            $email = $event['email'] ?? 'geen email';
            $category = $event['category'] ?? 'geen categorie';
            $customVariables = $event['custom_variables'] ?? [];
            $messageId = $event['message_id'] ?? 'geen bericht-ID';

            // Log details van het event
            Log::info("Event type: {$eventType}, Email: {$email}, Categorie: {$category}, Bericht-ID: {$messageId}");
            // Log::info('Custom Variables:', $customVariables);

            // Verwerk het event op basis van het type
            switch ($eventType) {
                case 'delivery':
                    Log::info("Email afgeleverd aan: {$email} (Categorie: {$category})");
                    break;

                case 'bounce':
                    Log::warning("Bounce gedetecteerd voor email: {$email} (Categorie: {$category})");
                    break;

                case 'spam_complaint':
                    Log::warning("Spam klacht ontvangen voor email: {$email}");
                    break;

                default:
                    Log::info("Onbekend event type: {$eventType} voor email: {$email}");
                    break;
            }
        }

        // Stuur een succesresponse terug naar Mailtrap
        return response()->json(['status' => 'success'], 200);
    }
}
