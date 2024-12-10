<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    public function index() : View
    {
        $branches = Branch::orderBy('id', 'desc')->withoutTrashed()->paginate(5);

        return view('branch.index', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code'      => ['required',
                            'string',
                            'min:2',
                            function ($attribute, $value, $fail) {
                                $branches = Branch::withTrashed()->where('code', $value)->first();

                                if($branches && $branches->trashed()) {
                                    return;
                                }

                                if($branches) {
                                    $fail('Code sudah digunakan.');
                                }
                            }],
            'name'      => 'required|string|min:3'
        ]);

        Branch::create([
            'code'      => $request->code,
            'name'      => $request->name
        ]);

        return redirect()->back()->with(['success' => 'Data Cabang Berhasil Ditambahkan']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code'      => 'required|string|min:2|unique:branches,code,' . $id,
            'name'      => 'required|string|min:3'
        ]);

        $branches = Branch::findOrFail($id);
        $branches->update([
            'code'  => $request->code,
            'name'  => $request->name
        ]);

        return redirect()->back()->with(['success' => 'Data Cabang Berhasil Diupdate']);
    }

    public function destroy($id): RedirectResponse
    {
        $branches = Branch::findOrFail($id);
        $branches->delete();

        return redirect()->route('branches.index')->with(['success' => 'Data Berhasil Dihapus']);
    }
}
