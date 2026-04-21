<?php

namespace App\Http\Controllers;

use App\Models\Dress;
use App\Models\Location;
use App\Models\Queue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QueueController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        return view('queues.index', [
            'queues' => $user->queues()
                ->with(['fromLocation', 'toLocation'])
                ->withCount('dresses')
                ->latest()
                ->get(),
            'locations' => Location::query()
                ->where('is_active', true)
                ->orderBy('name')
                ->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:100'],
            'from_location_id' => ['required', 'integer', 'exists:locations,id', 'different:to_location_id'],
            'to_location_id' => ['required', 'integer', 'exists:locations,id'],
        ]);

        $request->user()->queues()->create([
            'name' => $validated['name'] ?: null,
            'from_location_id' => $validated['from_location_id'],
            'to_location_id' => $validated['to_location_id'],
        ]);

        return redirect()
            ->route('queues.index')
            ->with('success', 'Queue created successfully.');
    }

    public function show(Request $request, Queue $queue): View
    {
        $queue = $this->ownedQueue($request, $queue);
        $user = $request->user();

        return view('queues.show', [
            'queue' => $queue->load([
                'fromLocation',
                'toLocation',
                'dresses' => fn ($query) => $query->with(['category', 'location']),
            ]),
            'availableDresses' => $user->dresses()
                ->with(['category', 'location'])
                ->whereDoesntHave('queues', fn ($query) => $query->where('queues.id', $queue->id))
                ->orderBy('name')
                ->get(),
        ]);
    }

    public function addDress(Request $request, Queue $queue)
    {
        $queue = $this->ownedQueue($request, $queue);
    
        $validated = $request->validate([
            'dress_ids' => ['required', 'array'],
            'dress_ids.*' => ['integer'],
        ]);
    
        $dresses = $request->user()
            ->dresses()
            ->whereIn('id', $validated['dress_ids'])
            ->pluck('id');
    
        $queue->dresses()->syncWithoutDetaching($dresses);
    
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
            ]);
        }
        
        return redirect()
        ->route('queues.show', $queue)
        ->with('success', 'Dresses added successfully.');
    }

    public function removeDress(Request $request, Queue $queue, string $dressId): RedirectResponse
    {
        $queue = $this->ownedQueue($request, $queue);
        $dress = $request->user()->dresses()->findOrFail($dressId);

        $queue->dresses()->detach($dress->id);

        return redirect()
            ->route('queues.show', $queue)
            ->with('success', 'Dress removed from queue.');
    }

    protected function ownedQueue(Request $request, Queue $queue): Queue
    {
        return $request->user()
            ->queues()
            ->with(['fromLocation', 'toLocation'])
            ->findOrFail($queue->id);
    }
    public function destroy(Request $request, Queue $queue): RedirectResponse
    {
        $queue = $this->ownedQueue($request, $queue);

        $queue->delete();

        return redirect()
            ->route('queues.index')
            ->with('success', 'Queue deleted successfully.');
    }
}
