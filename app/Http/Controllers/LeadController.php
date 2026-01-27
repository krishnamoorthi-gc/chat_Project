<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leads = Lead::with('chatbot')
            ->orderBy('last_visit_at', 'desc')
            ->paginate(20);

        return view('leads.index', compact('leads'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        return view('leads.show', compact('lead'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully.');
    }

    /**
     * Export leads to CSV
     */
    public function export()
    {
        $leads = Lead::with('chatbot')->orderBy('created_at', 'desc')->get();
        
        $filename = "leads_" . date('Y-m-d_H-i-s') . ".csv";
        
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['ID', 'Name', 'Email', 'Phone', 'Chatbot', 'City', 'Country', 'IP Address', 'Visit Count', 'Last Interaction', 'User Agent'];

        $callback = function() use($leads, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($leads as $lead) {
                fputcsv($file, [
                    $lead->id,
                    $lead->name ?? 'Guest Visitor',
                    $lead->email ?? 'N/A',
                    $lead->phone ?? 'N/A',
                    $lead->chatbot->name ?? 'N/A',
                    $lead->city ?? 'N/A',
                    $lead->country ?? 'N/A',
                    $lead->ip_address,
                    $lead->visit_count,
                    $lead->last_visit_at->format('Y-m-d H:i:s'),
                    $lead->user_agent
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
