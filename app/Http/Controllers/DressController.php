<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDressRequest;
use App\Http\Requests\UpdateDressRequest;
use App\Models\Category;
use App\Models\Dress;
use App\Models\Location;
use App\Models\Review;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['landing', 'reviews']);
    }

    public function landing(Request $request): View
    {
        return view('welcome', [
            'featuredReviews' => Review::query()
                ->where('is_published', true)
                ->latest()
                ->take(3)
                ->get(),
        ]);
    }

    public function reviews(Request $request): View
    {
        $search = trim((string) $request->string('search'));

        $reviews = Review::query()
            ->with(['replies.user'])
            ->where('is_published', true)
            ->when($search !== '', function (Builder $query) use ($search) {
                $query->where(function (Builder $nestedQuery) use ($search) {
                    $nestedQuery
                        ->where('author_name', 'like', "%{$search}%")
                        ->orWhere('author_role', 'like', "%{$search}%")
                        ->orWhere('headline', 'like', "%{$search}%")
                        ->orWhere('body', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%")
                        ->orWhere('issue', 'like', "%{$search}%")
                        ->orWhere('sentiment', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        return view('reviews.index', [
            'reviews' => $reviews,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }

    public function storeReviewReply(Request $request, Review $review): RedirectResponse
    {
        $validated = $request->validate([
            'body' => ['required', 'string', 'max:1000'],
        ]);

        $review->replies()->create([
            'user_id' => $request->user()->id,
            'body' => $validated['body'],
        ]);

        return redirect()
            ->route('reviews.index', ['search' => trim((string) $request->string('search'))])
            ->with('success', 'Reply added successfully.');
    }

    public function index(Request $request): View
    {
        $userId = Auth::id();
        $dresses = Dress::with(['category', 'location'])
            ->where('user_id', $userId)
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('dresses.index', compact('dresses'));
    }

    public function create(): View
    {
        return view('dresses.create', [
            'dress' => new Dress(),
            'locations' => Location::all(),
            'categories' => Category::all(),
        ]);
    }

    public function deleted(Request $request): View
    {
        $deletedDresses = $request->user()
            ->dresses()
            ->onlyTrashed()
            ->with(['category', 'location'])
            ->latest('deleted_at')
            ->paginate(20)
            ->withQueryString();

        return view('dresses.deleted', [
            'deletedDresses' => $deletedDresses,
        ]);
    }

    public function store(StoreDressRequest $request): RedirectResponse
    {
        $validated = $request->validated();
    
        $validated['sizes'] = $validated['size'] ?? null;
        unset($validated['size']);
    
        $dress = new Dress($validated);
        $dress->user()->associate($request->user());
    
        if ($request->hasFile('image')) {
            $dress->image_path = $request->file('image')->store('dresses', 'public');
        }
    
        $dress->save();
    
        return redirect()
            ->route('dresses.index')
            ->with('success', 'Dress added successfully.');
    }

    public function show(Dress $dress): View
    {
        return view('dresses.show', [
            'dress' => $this->ownedDress($dress, true),
        ]);
    }

    public function edit(Dress $dress): View
    {
        return view('dresses.edit', [
            'dress' => $this->ownedDress($dress),
            'locations' => Location::all(),
            'categories' => Category::all(),
        ]);
    }

    public function update(UpdateDressRequest $request, Dress $dress): RedirectResponse
    {
        $dress = $this->ownedDress($dress);
    
        $validated = $request->validated();
    
        $validated['sizes'] = $validated['size'] ?? null;
        unset($validated['size']);
    
        $dress->fill($validated);
    
        if ($request->boolean('remove_image') && $dress->image_path) {
            Storage::disk('public')->delete($dress->image_path);
            $dress->image_path = null;
        }
    
        if ($request->hasFile('image')) {
            if ($dress->image_path) {
                Storage::disk('public')->delete($dress->image_path);
            }
    
            $dress->image_path = $request->file('image')->store('dresses', 'public');
        }
    
        $dress->save();
    
        return redirect()
            ->route('dresses.index')
            ->with('success', 'Dress updated successfully.');
    }

    public function destroy(Dress $dress): RedirectResponse
    {
        $dress = $this->ownedDress($dress);
        $dress->delete();

        return redirect()
            ->route('dresses.index')
            ->with('success', 'Dress moved to recently removed.');
    }

    public function restore(string $dressId): RedirectResponse
    {
        $dress = Auth::user()
            ->dresses()
            ->onlyTrashed()
            ->findOrFail($dressId);

        $dress->restore();

        return redirect()
            ->route('dresses.index')
            ->with('success', 'Dress restored successfully.');
    }

    protected function ownedDress(Dress $dress, bool $withTrashed = false): Dress
    {
        return Auth::user()
            ->dresses()
            ->when($withTrashed, fn (Builder $query) => $query->withTrashed())
            ->findOrFail($dress->id);
    }
}
