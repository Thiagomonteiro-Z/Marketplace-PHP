<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Store;
use App\Models\User;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
        $this->middleware(['auth', 'user.has.store'])->only(['create', 'store']);
    }

    public function index()
    {
        $store = auth()->user()->store;

        return view('admin.stores.index', compact('store'));
    }

    public function create()
    {
        $users = User::all(['id','name']);
        return view('admin.stores.create', compact('users'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $user = auth()->user();

        if($request->hasFile('logo')) {
            $data['logo'] = $this->imageUpload($request->file('logo'));

        }
        $store = $user->store()->create($data);

        return redirect()->route('admin.stores.index')->with('success', 'Loja criada com sucesso!');
    }

    public function edit($store)
    {
        $store = Store::find($store);
        return view('admin.stores.edit', compact('store'));
    }

    public function update(StoreRequest $request,$store)
    {
        $store = Store::findOrFail($store);

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {

            if (!empty($store->logo) && Storage::disk('public')->exists($store->logo)) {
                Storage::disk('public')->delete($store->logo);
            }

            $data['logo'] = $this->imageUpload($request->file('logo'));
        }

        $store->update($data);

        return redirect()->route('admin.stores.index')->with('success', 'Loja atualizada com sucesso!');
    }

    public function destroy(Store $store)
    {
        if (!empty($store->logo)) {
            Storage::disk('public')->delete($store->logo);
        }

        $store->delete();

        return redirect()->route('admin.stores.index')->with('success', 'Loja removida com sucesso!');
    }
}
