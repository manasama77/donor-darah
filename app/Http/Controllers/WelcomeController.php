<?php

namespace App\Http\Controllers;

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
    protected $poundfit_info;
    protected $poundfit_info_list;

    public function __construct()
    {
        $this->poundfit_info = [
            'Sosial Media',
            'Radio',
            'Website',
            'Teman / Keluarga',
            'MyBnetfit',
            'Poster',
            'Email',
            'Lain-lain',
        ];

        $this->poundfit_info_list = implode(',', $this->poundfit_info);
    }

    public function index()
    {
        $poundfit_event = PoundfitEvent::with([
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
                'name'              => ['required', 'string', 'max:255'],
                'gender'            => ['required', 'in:male,female'],
                'email'             => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . Registrant::class],
                'phone'             => ['required', 'string', 'max:255'],
                'city'              => ['required', 'string', 'max:255'],
                'phone_emergency'   => ['required', 'string', 'max:255'],
                'name_emergency'    => ['required', 'string', 'max:255'],
                'bring_ripstix'     => ['required', 'in:0,1'],
                'poundfit_info'     => ['required', 'in:' . $this->poundfit_info_list],
                'poundfit_info_etc' => ['nullable', 'string', 'max:255', 'required_if:poundfit_info,Lain-lain'],
            ], [
                'name.required'              => 'Name is required.',
                'name.string'                => 'Name is invalid.',
                'name.max'                   => 'Name is too long.',
                'gender.required'            => 'Gender is required.',
                'gender.in'                  => 'Gender is invalid.',
                'email.required'             => 'Email is required.',
                'email.string'               => 'Email is invalid.',
                'email.lowercase'            => 'Email is format must be lowercase.',
                'email.email'                => 'Email is invalid.',
                'email.max'                  => 'Email is too long.',
                'email.unique'               => 'Email is already taken.',
                'phone.required'             => 'Phone is required.',
                'phone.string'               => 'Phone is invalid.',
                'phone.max'                  => 'Phone is too long.',
                'city.required'              => 'City is required.',
                'city.string'                => 'City is invalid.',
                'city.max'                   => 'City is too long.',
                'phone_emergency.required'   => 'Emergency phone is required.',
                'phone_emergency.string'     => 'Emergency phone is invalid.',
                'phone_emergency.max'        => 'Emergency phone is too long.',
                'name_emergency.required'    => 'Emergency name is required.',
                'name_emergency.string'      => 'Emergency name is invalid.',
                'name_emergency.max'         => 'Emergency name is too long.',
                'bring_ripstix.required'     => 'Bring Ripstix is required.',
                'bring_ripstix.in'           => 'Bring Ripstix is invalid.',
                'poundfit_info.required'     => 'Poundfit info is required.',
                'poundfit_info.in'           => 'Poundfit info is invalid.',
                'poundfit_info_etc.string'   => 'Poundfit info is invalid.',
                'poundfit_info_etc.max'      => 'Poundfit info is too long.',
            ]);

            DB::beginTransaction();

            $poundfit_event = PoundfitEvent::with([
                'location',
            ])->where('is_published', true)->first();

            if (!$poundfit_event) {
                return redirect()->back();
            }

            $random_number = $this->generate_random_number();
            $eticket       = $this->generate_eticket($random_number, $request->name, $poundfit_event->event_date_ind, $poundfit_event->event_time_ind, $poundfit_event->location->name);

            $registrant                    = new Registrant();
            $registrant->poundfit_event_id = $poundfit_event->id;
            $registrant->name              = $request->name;
            $registrant->gender            = $request->gender;
            $registrant->email             = $request->email;
            $registrant->phone             = $request->phone;
            $registrant->city              = $request->city;
            $registrant->phone_emergency   = $request->phone_emergency;
            $registrant->name_emergency    = $request->name_emergency;
            $registrant->bring_ripstix     = $request->bring_ripstix;
            $registrant->poundfit_info     = $request->poundfit_info;
            $registrant->poundfit_info_etc = $request->poundfit_info_etc;
            $registrant->are_attending     = 0;
            $registrant->barcode           = $random_number;
            $registrant->eticket           = $eticket;
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
            'poundfit_event',
        ])
            ->where('id', $registrant_id)
            ->first();

        if (!$registrant) {
            return view('welcome_404');
        }

        $poundfit_event = PoundfitEvent::with([
            'location',
        ])
            ->where('id', $registrant->poundfit_event_id)
            ->where('is_published', true)
            ->first();

        $data = [
            'hash_id'        => $hash_id,
            'registrant'     => $registrant,
            'poundfit_event' => $poundfit_event,
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
        $qrcode         = '<img src="data:image/png;base64,' . $plugin_barcode->getBarcodePNG((string) $random_number, 'QRCODE', 4, 4, [0, 0, 0]) . '" alt="barcode" />';

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

        $date = Carbon::parse($tanggal_event)->format('Y-m-d');

        if (!Storage::disk('public')->exists('pdf/poundfit/' . $date)) {
            Storage::disk('public')->makeDirectory('pdf/poundfit/' . $date);
        }

        $nama_slug = Str::slug($name, '-');
        $content   = $pdf->download()->getOriginalContent();
        $nama_file = $nama_slug . "-" . $random_number . ".pdf";

        Storage::disk('public')->put('pdf/poundfit/' . $date . '/' . $nama_file, $content);

        $path_ticket = 'storage/pdf/poundfit/' . $date . '/' . $nama_file;

        return $path_ticket;
    }

    public function download($hash_id)
    {
        $registrant_id = Hashids::decode($hash_id);

        if (count($registrant_id) == 0) {
            return view('welcome_404');
        }

        $registrant = Registrant::with([
            'poundfit_event',
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
