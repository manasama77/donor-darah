<?php

namespace App\Http\Controllers;

use App\Models\DonorDarahEvent;
use Exception;
use Milon\Barcode\DNS2D;
use App\Models\Registrant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PoundfitEvent;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class WelcomeController extends Controller
{
    protected $donor_darah_info;
    protected $donor_darah_info_list;

    public function __construct()
    {
        $this->donor_darah_info = [
            'Sosial Media',
            'Radio',
            'Website',
            'Teman / Keluarga',
            'MyBnetfit',
            'Poster',
            'Email',
            'Lain-lain',
        ];

        $this->donor_darah_info_list = implode(',', $this->donor_darah_info);
    }

    public function index()
    {
        $poundfit_event = DonorDarahEvent::with([
            'location',
        ])->where('is_published', true)->first();

        $data = [
            'poundfit_event' => $poundfit_event,
        ];

        return view('welcome', $data);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'                 => ['required', 'string', 'max:255'],
                'gender'               => ['required', 'in:male,female'],
                'dob'                  => ['required', 'date', 'date_format:Y-m-d'],
                'email'                => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . Registrant::class],
                'phone'                => ['required', 'string', 'max:255'],
                'city'                 => ['required', 'string', 'max:255'],
                'phone_emergency'      => ['required', 'string', 'max:255'],
                'name_emergency'       => ['required', 'string', 'max:255'],
                'golongan_darah'       => ['required', 'in:a,b,ab,o'],
                'rhesus'               => ['required', 'in:positive,negative,unknown'],
                'weight'               => ['required', 'numeric'],
                'previous_donation'    => ['required', 'boolean'],
                'donor_darah_info'     => ['required', 'in:' . $this->donor_darah_info_list],
                'donor_darah_info_etc' => ['nullable', 'string', 'max:255', 'required_if:donor_darah_info,Lain-lain'],
            ], [
                'name.required'               => 'Name is required.',
                'name.string'                 => 'Name is invalid.',
                'name.max'                    => 'Name is too long.',
                'gender.required'             => 'Gender is required.',
                'gender.in'                   => 'Gender is invalid.',
                'dob.required'                => 'Date of birth is required.',
                'dob.date'                    => 'Date of birth is invalid.',
                'dob.date_format'             => 'Date of birth is invalid.',
                'email.required'              => 'Email is required.',
                'email.string'                => 'Email is invalid.',
                'email.lowercase'             => 'Email is format must be lowercase.',
                'email.email'                 => 'Email is invalid.',
                'email.max'                   => 'Email is too long.',
                'email.unique'                => 'Email is already taken.',
                'phone.required'              => 'Phone is required.',
                'phone.string'                => 'Phone is invalid.',
                'phone.max'                   => 'Phone is too long.',
                'city.required'               => 'City is required.',
                'city.string'                 => 'City is invalid.',
                'city.max'                    => 'City is too long.',
                'phone_emergency.required'    => 'Emergency phone is required.',
                'phone_emergency.string'      => 'Emergency phone is invalid.',
                'phone_emergency.max'         => 'Emergency phone is too long.',
                'name_emergency.required'     => 'Emergency name is required.',
                'name_emergency.string'       => 'Emergency name is invalid.',
                'name_emergency.max'          => 'Emergency name is too long.',
                'golongan_darah.required'     => 'Golongan darah is required.',
                'golongan_darah.in'           => 'Golongan darah is invalid.',
                'rhesus.required'             => 'Rhesus is required.',
                'rhesus.in'                   => 'Rhesus is invalid.',
                'weight.required'             => 'Weight is required.',
                'weight.numeric'              => 'Weight is invalid.',
                'previous_donation.required'  => 'Previous donation is required.',
                'previous_donation.boolean'   => 'Previous donation is invalid.',
                'donor_darah_info.required'   => 'Donor Darah info is required.',
                'donor_darah_info.in'         => 'Donor Darah info is invalid.',
                'donor_darah_info_etc.string' => 'Donor Darah info is invalid.',
                'donor_darah_info_etc.max'    => 'Donor Darah info is too long.',
            ]);

            DB::beginTransaction();

            $donor_darah_event = DonorDarahEvent::with([
                'location',
            ])->where('is_published', true)->first();

            if (!$donor_darah_event) {
                return redirect()->back();
            }

            $random_number = $this->generate_random_number();
            $eticket       = $this->generate_eticket($random_number, $request->name, $donor_darah_event->event_date_ind, $donor_darah_event->event_time_ind, $donor_darah_event->location->name);

            $registrant                       = new Registrant();
            $registrant->donor_darah_event_id = $donor_darah_event->id;
            $registrant->name                 = $request->name;
            $registrant->gender               = $request->gender;
            $registrant->dob                  = $request->dob;
            $registrant->email                = $request->email;
            $registrant->phone                = $request->phone;
            $registrant->city                 = $request->city;
            $registrant->phone_emergency      = $request->phone_emergency;
            $registrant->name_emergency       = $request->name_emergency;
            $registrant->golongan_darah       = $request->golongan_darah;
            $registrant->rhesus               = $request->rhesus;
            $registrant->weight               = $request->weight;
            $registrant->previous_donation    = $request->previous_donation;
            $registrant->donor_darah_info     = $request->donor_darah_info;
            $registrant->donor_darah_info_etc = $request->donor_darah_info_etc;
            $registrant->are_attending        = 0;
            $registrant->barcode              = $random_number;
            $registrant->eticket              = $eticket;
            $registrant->save();

            $hash_id = Hashids::encode($registrant->id);

            DB::commit();
            return redirect()->route('welcome.success', $hash_id);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function success($hash_id)
    {
        $registrant_id = Hashids::decode($hash_id);

        if (count($registrant_id) == 0) {
            return view('welcome_404');
        }

        $registrant = Registrant::with([
            'donor_darah_event',
        ])
            ->where('id', $registrant_id)
            ->first();

        if (!$registrant) {
            return view('welcome_404');
        }

        $donor_darah_event = DonorDarahEvent::with([
            'location',
        ])
            ->where('id', $registrant->donor_darah_event_id)
            ->where('is_published', true)
            ->first();

        $data = [
            'hash_id'           => $hash_id,
            'registrant'        => $registrant,
            'donor_darah_event' => $donor_darah_event,
        ];

        return view('welcome_success', $data);
    }

    protected function generate_random_number()
    {
        do {
            $barcode = mt_rand(1000, 9999);
        } while (Registrant::where('barcode', $barcode)->exists());

        return $barcode;
    }

    protected function generate_eticket($random_number, $name, $tanggal_event, $jam_event, $tempat)
    {
        $plugin_barcode = new DNS2D();
        $qrcode         = '<img src="data:image/png;base64,' . $plugin_barcode->getBarcodePNG((string) $random_number, 'QRCODE', 4, 4, [0, 24, 73]) . '" alt="barcode" />';

        $data = [
            'qrcode'        => $qrcode,
            'random_number' => $random_number,
            'nama_lengkap'  => $name,
            'tanggal_event' => $tanggal_event,
            'jam_event'     => $jam_event,
            'tempat'        => $tempat,
        ];

        $custom_paper = [0, 0, 275, 460];
        $pdf          = Pdf::loadView('pdf.e_ticket', $data)->setPaper($custom_paper);
        // render on browser $pdf
        return $pdf->stream('test.pdf', array("Attachment" => false));

        $date = Carbon::parse($tanggal_event)->format('Y-m-d');

        if (!Storage::disk('public')->exists('pdf/donordarah/' . $date)) {
            Storage::disk('public')->makeDirectory('pdf/donordarah/' . $date);
        }

        $nama_slug = Str::slug($name, '-');
        $content   = $pdf->download()->getOriginalContent();
        $nama_file = $nama_slug . "-" . $random_number . ".pdf";

        Storage::disk('public')->put('pdf/donordarah/' . $date . '/' . $nama_file, $content);

        $path_ticket = 'storage/pdf/donordarah/' . $date . '/' . $nama_file;

        return $path_ticket;
    }

    public function download($hash_id)
    {
        $registrant_id = Hashids::decode($hash_id);

        if (count($registrant_id) == 0) {
            return view('welcome_404');
        }

        $registrant = Registrant::with([
            'donor_darah_event',
        ])
            ->where('id', $registrant_id)
            ->first();

        if (!$registrant) {
            return view('welcome_404');
        }

        $eticket = $registrant->eticket;

        return response()->download($eticket);
    }
}
