<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class ChatsController extends Controller
{
    
    public function index()
    {
        return view('admin.chat.index');
    }

    public function Conversation(Request $request)
    {
        $response = Http::withHeaders(['User-Agent' => ''])->withToken("eyJhbGciOiJSUzI1NiIsImtpZCI6ImRlLWViYXlrLXNpZy0yMDIxLTEwLTA4VDA0OjUxOjExLjIyMzYyOVoifQ.eyJpc3MiOiJodHRwczovL2lkLmViYXkta2xlaW5hbnplaWdlbi5kZS9vaWRjIiwianRpIjoiVEdULTE0MzU1NC00TkVjZEcxNlZGR28tMGVIQVJqVTR0YW1MQzBxRDNYaElrN3BGV2xKeVlmYzhCTlROVHNBaXNnRThnM0VyUVd3aVU4LWNpcy1hdXRoLTZkNWQ3ZmNkOWItZzl6NHE7QVQtMTE3NTM4OTQtdk9qbU9NVmhLYXF4MlpCaFFXbFpZSWhRMEgtNlZOYU0iLCJpYXQiOjE3MDA0NjI0OTUsImV4cCI6MTcwMDQ2NDI5NSwic3ViIjoiNjc2Y2FiNTEtODkzNy00OTcwLThiYWQtNTJjMmIyYjA2YzQ1IiwiYXpwIjoiZWJheWtfYXBpX2hWSGY2RnR0Iiwic2NvcGUiOiJvcGVuaWQgcHJvZmlsZSB1cm46ZWJheS1rbGVpbmFuemVpZ2VuOnVzZXIiLCJlY2c6aWQ6YmxvY2tlZCI6ZmFsc2UsInByZWZlcnJlZF91c2VybmFtZSI6IjEzNTUyNDIzNCJ9.eOAxVwtDTdJ-Mnkcz4dT7xMNx2-7eek-qxgPKTuSzrySN0wpW5RwZphSLDU5a7BcwV0zTZtJ7msc8-ALxZevK3JOg_wpQtxvRxyIOSPprPla7EPWP3XMmc2HDyn1tkSPMZw-QRqS6bG0b6iN1phayWh6l80Na31x3F6D8_JxYJHBHIULD9LSnq-5Y4HhAMoxXxBy2DAE8cazlGvSJq-RzR5Xxl85vsGr-8lOAbQSUL1UtGfwkjJKLKHyNdcY2lJdEz9552iOelZduFP8sK7N5ZZCwPZBn2tsLUOwCZsNfgt4zcO_KGp4ZuXDh-OiY4kk2ebt1hHYhZW0xVw-gTCmZw")
            ->get("https://gateway.kleinanzeigen.de/messagebox/api/users/135524234/conversations?size=100000000");
        $data = $response->json();

        return response()->json([
            'component' => view('admin.chat.conversation',compact('data'))->render(),
        ]);
    }

    public function ConversationMessages(Request $request)
    {

        $response = Http::withHeaders(['User-Agent' => ''])->withToken("eyJhbGciOiJSUzI1NiIsImtpZCI6ImRlLWViYXlrLXNpZy0yMDIxLTEwLTA4VDA0OjUxOjExLjIyMzYyOVoifQ.eyJpc3MiOiJodHRwczovL2lkLmViYXkta2xlaW5hbnplaWdlbi5kZS9vaWRjIiwianRpIjoiVEdULTE0MzU1NC00TkVjZEcxNlZGR28tMGVIQVJqVTR0YW1MQzBxRDNYaElrN3BGV2xKeVlmYzhCTlROVHNBaXNnRThnM0VyUVd3aVU4LWNpcy1hdXRoLTZkNWQ3ZmNkOWItZzl6NHE7QVQtMTE3NTM4OTQtdk9qbU9NVmhLYXF4MlpCaFFXbFpZSWhRMEgtNlZOYU0iLCJpYXQiOjE3MDA0NjI0OTUsImV4cCI6MTcwMDQ2NDI5NSwic3ViIjoiNjc2Y2FiNTEtODkzNy00OTcwLThiYWQtNTJjMmIyYjA2YzQ1IiwiYXpwIjoiZWJheWtfYXBpX2hWSGY2RnR0Iiwic2NvcGUiOiJvcGVuaWQgcHJvZmlsZSB1cm46ZWJheS1rbGVpbmFuemVpZ2VuOnVzZXIiLCJlY2c6aWQ6YmxvY2tlZCI6ZmFsc2UsInByZWZlcnJlZF91c2VybmFtZSI6IjEzNTUyNDIzNCJ9.eOAxVwtDTdJ-Mnkcz4dT7xMNx2-7eek-qxgPKTuSzrySN0wpW5RwZphSLDU5a7BcwV0zTZtJ7msc8-ALxZevK3JOg_wpQtxvRxyIOSPprPla7EPWP3XMmc2HDyn1tkSPMZw-QRqS6bG0b6iN1phayWh6l80Na31x3F6D8_JxYJHBHIULD9LSnq-5Y4HhAMoxXxBy2DAE8cazlGvSJq-RzR5Xxl85vsGr-8lOAbQSUL1UtGfwkjJKLKHyNdcY2lJdEz9552iOelZduFP8sK7N5ZZCwPZBn2tsLUOwCZsNfgt4zcO_KGp4ZuXDh-OiY4kk2ebt1hHYhZW0xVw-gTCmZw")
            ->get("https://gateway.kleinanzeigen.de/messagebox/api/users/135524234/conversations/18hj:4nw4mf2:2kpwwbctl");
        $data = $response->json();

        return response()->json([
            'component' => view('admin.chat.messages',compact('data'))->render(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
