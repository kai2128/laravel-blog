<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveAboutRequest;
use App\Http\Requests\SaveContactRequest;
use App\Http\Resources\SettingsResource;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use App\Actions\UploadFile;

class SettingController extends Controller
{
    private $settings;

    public function __construct()
    {
        $this->settings = Setting::find(1) ?? new Setting();
    }

    //
    public function create(Request $request)
    {

        return Inertia::render('Settings/Create', [
            'settings' => new SettingsResource($this->settings)
        ]);
    }

    public function saveHero(Request $request)
    {
        $request->validate([
            'hero_description' => ['required', 'string'],
            'hero_image' => ['image', 'nullable'],
        ]);

        if ($request->file('hero_image')) {
            $this->settings->deleteImage('data->hero_image');

            $imgName = UploadFile::uploadImgFile($request->file('hero_image'), $this->settings->uploadFolder());

            $data['hero_image']= $imgName;
        }

        $data['hero_description'] = $request->get('hero_description');
        $this->save($data);
        return redirect()->back();
    }

    public function saveAbout(SaveAboutRequest $request)
    {

        if ($request->file('about_image')) {
            $this->settings->deleteImage('data->about_image');

            $imgName = UploadFile::uploadImgFile($request->file('about_image'), $this->settings->uploadFolder());

            $data['about_image']= $imgName;
        }

        $data['about_description'] = $request->get('about_description');
        $this->save($data);
        return redirect()->back();
    }

    public function saveContact(SaveContactRequest $request)
    {
        $data = $request->only(['address','email', 'phone', 'google_map_url']);

        if ($request->file('contact_image')) {
            $this->settings->deleteImage('data->contact_image');

            $imgName = UploadFile::uploadImgFile($request->file('contact_image'), $this->settings->uploadFolder());

            $data['contact_image']= $imgName;
        }

        $this->save($data);
        return redirect()->back();
    }

    private function save(array $data):void
    {
        $this->settings->data = $this->settings->data != null ? array_merge($this->settings->data, $data) : $data;
        $this->settings->save();
    }
}
