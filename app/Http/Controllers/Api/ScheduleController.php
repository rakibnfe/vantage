<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResource;
use App\Http\Resources\ScheduleCollection;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{

    public function index(Request $request)
    {
        try {
            $query = Schedule::with(['user', 'service']);

            // Filter by date range (for calendar)
            if ($request->has('start') && $request->has('end')) {
                $query->where(function ($q) use ($request) {
                    $q->whereBetween('start_time', [$request->start, $request->end])
                      ->orWhereBetween('end_time', [$request->start, $request->end]);
                });
            }

            // Filter by type
            if ($request->has('type') && $request->type !== 'all') {
                $query->where('type', $request->type);
            }

            // Filter by status
            if ($request->has('status')) {
                $query->where('status', $request->status);
            }

            // Search
            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'LIKE', "%{$search}%")
                      ->orWhere('customer_name', 'LIKE', "%{$search}%")
                      ->orWhere('customer_email', 'LIKE', "%{$search}%")
                      ->orWhere('description', 'LIKE', "%{$search}%");
                });
            }

            $perPage = $request->get('per_page', 50);
            $schedules = $query->orderBy('start_time')->paginate($perPage);

            return new ScheduleCollection($schedules);
        } catch (\Exception $e) {
            Log::error('Schedule index error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch schedules',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'type' => 'required|in:appointment,blocked,availability',
                'status' => 'nullable|in:scheduled,confirmed,completed,cancelled',
                'start_time' => 'required|date',
                'end_time' => 'required|date|after:start_time',
                'is_all_day' => 'nullable|boolean',
                'is_recurring' => 'nullable|boolean',
                'recurrence_pattern' => 'nullable|in:daily,weekly,biweekly,monthly,yearly',
                'recurrence_days' => 'nullable|array',
                'recurrence_until' => 'nullable|date',
                'customer_name' => 'nullable|string|max:255',
                'customer_email' => 'nullable|email|max:255',
                'customer_phone' => 'nullable|string|max:20',
                'customer_notes' => 'nullable|string',
                'color' => 'nullable|string',
                'location' => 'nullable|string',
                'service_id' => 'nullable|exists:services,id',
            ]);

            // Generate unique slug
            $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid('schedule_');
            
            // Set default values
            $validated['status'] = $validated['status'] ?? 'scheduled';
            $validated['is_all_day'] = $validated['is_all_day'] ?? false;
            $validated['is_recurring'] = $validated['is_recurring'] ?? false;
            
            // Add user_id if authenticated
            if (Auth::check()) {
                $validated['user_id'] = Auth::user()->id;
            }

            $schedule = Schedule::create($validated);

            return response()->json([
                'success' => true,
                'data' => new ScheduleResource($schedule->load(['user', 'service'])),
                'message' => 'Schedule created successfully'
            ], 201);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Schedule store error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create schedule',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $schedule = Schedule::with(['user', 'service'])->find($id);
            
            if (!$schedule) {
                return response()->json([
                    'success' => false,
                    'message' => 'Schedule not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => new ScheduleResource($schedule),
                'message' => 'Schedule retrieved successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Schedule show error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve schedule'
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $schedule = Schedule::find($id);
            
            if (!$schedule) {
                return response()->json([
                    'success' => false,
                    'message' => 'Schedule not found'
                ], 404);
            }

            $validated = $request->validate([
                'title' => 'sometimes|required|string|max:255',
                'description' => 'nullable|string',
                'type' => 'sometimes|required|in:appointment,blocked,availability',
                'status' => 'nullable|in:scheduled,confirmed,completed,cancelled',
                'start_time' => 'sometimes|required|date',
                'end_time' => 'sometimes|required|date|after:start_time',
                'is_all_day' => 'nullable|boolean',
                'customer_name' => 'nullable|string|max:255',
                'customer_email' => 'nullable|email|max:255',
                'customer_phone' => 'nullable|string|max:20',
                'customer_notes' => 'nullable|string',
                'color' => 'nullable|string',
                'location' => 'nullable|string',
                'service_id' => 'nullable|exists:services,id',
            ]);

            // If title is being updated, update slug
            if (isset($validated['title']) && $validated['title'] !== $schedule->title) {
                $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid('schedule_');
            }

            $schedule->update($validated);

            return response()->json([
                'success' => true,
                'data' => new ScheduleResource($schedule->load(['user', 'service'])),
                'message' => 'Schedule updated successfully'
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Schedule update error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update schedule',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $schedule = Schedule::find($id);
            
            if (!$schedule) {
                return response()->json([
                    'success' => false,
                    'message' => 'Schedule not found'
                ], 404);
            }

            $schedule->delete();

            return response()->json([
                'success' => true,
                'message' => 'Schedule deleted successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Schedule delete error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete schedule'
            ], 500);
        }
    }

    public function checkAvailability(Request $request)
    {
        try {
            $request->validate([
                'start_time' => 'required|date',
                'end_time' => 'required|date|after:start_time',
                'service_id' => 'nullable|exists:services,id',
                'exclude_id' => 'nullable|exists:schedules,id',
            ]);

            $query = Schedule::where('status', '!=', 'cancelled')
                ->where(function ($q) use ($request) {
                    $q->whereBetween('start_time', [$request->start_time, $request->end_time])
                        ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                        ->orWhere(function ($q2) use ($request) {
                            $q2->where('start_time', '<=', $request->start_time)
                              ->where('end_time', '>=', $request->end_time);
                        });
                });

            if ($request->has('exclude_id')) {
                $query->where('id', '!=', $request->exclude_id);
            }

            $conflicts = $query->get();

            return response()->json([
                'success' => true,
                'available' => $conflicts->isEmpty(),
                'conflicts' => ScheduleResource::collection($conflicts),
                'message' => $conflicts->isEmpty() ? 'Time slot is available' : 'Time slot has conflicts'
            ]);
        } catch (\Exception $e) {
            Log::error('Availability check error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to check availability'
            ], 500);
        }
    }

    public function getAvailableSlots(Request $request)
    {
        try {
            $request->validate([
                'date' => 'required|date',
                'duration' => 'required|integer|min:15',
                'service_id' => 'nullable|exists:services,id',
            ]);

            $date = $request->date;
            $duration = $request->duration;
            
            // Get all appointments and blocked times for the date
            $busyTimes = Schedule::whereDate('start_time', $date)
                ->whereIn('type', ['appointment', 'blocked'])
                ->where('status', '!=', 'cancelled')
                ->orderBy('start_time')
                ->get(['start_time', 'end_time']);

            // Get availability windows
            $availability = Schedule::whereDate('start_time', $date)
                ->where('type', 'availability')
                ->where('status', '!=', 'cancelled')
                ->orderBy('start_time')
                ->get(['start_time', 'end_time']);

            // Calculate available slots
            $availableSlots = [];
            
            foreach ($availability as $window) {
                $slotStart = \Carbon\Carbon::parse($window->start_time);
                while ($slotStart->copy()->addMinutes($duration) <= \Carbon\Carbon::parse($window->end_time)) {
                    $slotEnd = $slotStart->copy()->addMinutes($duration);
                    
                    // Check if slot conflicts with busy times
                    $conflict = false;
                    foreach ($busyTimes as $busy) {
                        $busyStart = \Carbon\Carbon::parse($busy->start_time);
                        $busyEnd = \Carbon\Carbon::parse($busy->end_time);
                        
                        if ($slotStart < $busyEnd && $slotEnd > $busyStart) {
                            $conflict = true;
                            break;
                        }
                    }
                    
                    if (!$conflict) {
                        $availableSlots[] = [
                            'start' => $slotStart->format('Y-m-d H:i:s'),
                            'end' => $slotEnd->format('Y-m-d H:i:s'),
                            'formatted_start' => $slotStart->format('g:i A'),
                            'formatted_end' => $slotEnd->format('g:i A'),
                        ];
                    }
                    
                    $slotStart->addMinutes(30);
                }
            }

            return response()->json([
                'success' => true,
                'data' => $availableSlots,
                'date' => $date,
                'duration' => $duration,
                'total_slots' => count($availableSlots)
            ]);
        } catch (\Exception $e) {
            Log::error('Available slots error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to get available slots'
            ], 500);
        }
    }
}