<?php

namespace App\Http\Controllers;
use App\Models\reportmodel;
use Illuminate\Http\Request;

class ReportMonthlyController extends Controller
{
 // Display a listing of the reports
 public function index()
 {
     $reports = reportmodel::all();
     return view('report.index', compact('report'));
 }

 // Show the form for creating a new report
 public function create()
 {
     return view('report.create');
 }

 // Store a newly created report in storage
 public function store(Request $request)
 {
     $validated = $request->validate([
         'absence_id' => 'required|integer',
         'activity_title' => 'required|String',
         'activity_description' => 'nullable|String',
         'activity_photo' => 'nullable|String',
         'comment' => 'nullable|String',
     ]);

     reportmodel::create($validated);

     return redirect()->route('report.index')->with('success', 'Report created successfully.');
 }

 // Display the specified report
 public function show(reportmodel $report)
 {
     return view('report.show', compact('report'));
 }

 // Show the form for editing the specified report
 public function edit(reportmodel $report)
 {
     return view('report.edit', compact('report'));
 }

 // Update the specified report in storage
 public function update(Request $request, reportmodel $report)
 {
     $validated = $request->validate([
         'absence_id' => 'required|integer',
         'activity_title' => 'required|String',
         'activity_description' => 'nullable|String',
         'activity_photo' => 'nullable|String',
         'comment' => 'nullable|String',
     ]);

     $report->update($validated);

     return redirect()->route('report.index')->with('success', 'Report updated successfully.');
 }

 // Remove the specified report from storage
 public function destroy(reportmodel $report)
 {
     $report->delete();

     return redirect()->route('report.index')->with('success', 'Report deleted successfully.');
 }
}
