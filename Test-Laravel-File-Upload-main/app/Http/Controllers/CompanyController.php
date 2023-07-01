<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function store(Request $request)
    {
        $company = Company::create([
            'name' => $request->name,
        ]);
        $company->addMediaFromRequest('photo')->toMediaCollection('companies');

        return 'Success';
    }

    public function show(Company $company)
    {
        $media = $company->getFirstMedia('photos');
        $photo = $media ? Storage::url($media->id . '/' . $media->file_name) : null;
        return view('companies.show', compact('company', 'photo'));
    }
}
