<?php
namespace App\Http\administrator;

use App\Repositories\ComandRepository;
use App\Repositories\ProductComandRepository;
use Keyhunter\Administrator\Controller;
use Illuminate\Contracts\Auth\Guard AS AuthGuard;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\ProductSizes;
use App\PromoCategory;
use Redirect;
use App\User;
use App\UsedCodes;
use App\PromoCode;
use Validator;

/**
 * Class DashboardStatisticController
 * @package App\Http\administrator
 */
class DashboardStatisticController extends Controller
{
    /**
     * @var ComandRepository
     */
    protected $comands;

    /**
     * @var ProductComandRepository
     */
    protected $productcomand;

    /**
     * DashboardStatisticController constructor.
     * @param Application $application
     * @param AuthGuard $user
     */
    public function __construct(Application $application,
                                AuthGuard $user,
                                ComandRepository $comandRepository,
                                ProductComandRepository $productComandRepository

    )
    {
        parent::__construct($application, $user);

        $this->comands = $comandRepository;
        $this->productcomand = $productComandRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        $comand = $this->comands->getPublic();

        return view('administrator::dashboard', compact('comand'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function singleComand($id)
    {
        $comand = $this->comands->getByConfirmCodeAdmin($id);
        $productscomand = $this->productcomand->getByComandId($comand->id);

        return view('administrator::command', compact('comand', 'productscomand'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generateAwb(Request $request)
    {
        $comand = $this->comands->getByConfirmCodeAdmin($request->confirm_code);
        $user = User::where('id', $comand->user)->first();

        if ($comand->payment === 'card') {
            $payment = 'expeditor';
            $ramburs = 0;
        } else {
            $payment = 'destinatar';
            $ramburs = $comand->price;
        }

        $awb = \FanCourier::generateAwb(['fisier' => [
            [
                'tip_serviciu' => 'standard',
                'banca' => 'BRD',
                'iban' => 'RO07BRDE445SV70823594450',
                'nr_plicuri' => $request->plic,
                'nr_colete' => $request->colet,
                'greutate' => $request->greutate,
                'plata_expeditie' => 'expeditor',
                'ramburs_bani' => $ramburs,
                'plata_ramburs_la' => $payment,
                'valoare_declarata' => $request->value,
                'persoana_contact_expeditor' => $request->persoana,
                'observatii' => $request->detalii,
                'continut' => $request->continut,
                'nume_destinar' => $comand->delname,
                'persoana_contact' => $comand->delname,
                'telefon' => $comand->delphone,
                'fax' => '',
                'email' => $user->email,
                'judet' => $comand->deljudet,
                'localitate' => $comand->dellocation,
                'strada' => $comand->deladress,
                'nr' => '',
                'cod_postal' => '',
                'bl' => '',
                'scara' => '',
                'etaj' => '',
                'apartament' => '',
                'inaltime_pachet' => $request->inaltime,
                'lungime_pachet' => $request->latime,
                'restituire' => '',
                'centru_cost' => '',
                'optiuni' => '',
                'packing' => '',
                'date_personale' => ''
            ],

        ]]);

        $comand->fill([
            'awb_code' => $awb[0]->awb
        ])->save();

        return redirect()->back()->with(['message' => 'Ceva gresit']);

    }


    /**
     * @param Request $request
     */
    public function orderCourier(Request $request)
    {

        $courier = \FanCourier::order([
            'nr_colete' => $request->colete,
            'pers_contact' => $request->name,
            'tel' => $request->phone,
            'email' => $request->email,
            'greutate' => $request->greutate,
            'inaltime' => $request->inaltime,
            'lungime' => $request->lungime,
            'latime' => $request->latime,
            'ora_ridicare' => $request->ora,
            'observatii' => $request->observatii,
            'client_exp' => $request->expeditor,
            'strada' => $request->strada,
            'nr' => $request->nr,
            'bloc' => $request->bloc,
            'scara' => $request->scara,
            'etaj' => $request->etaj,
            'ap' => $request->apartament,
            'localitate' => $request->localitate,
            'judet' => $request->judet,
        ]);


    }

    /**
     * @param $code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteComand($code)
    {
        $comand = $this->comands->getByConfirmCodeAdmin($code);
        $comand->delete();

        return redirect()->back();

    }

    /**
     * @return mixed
     */
    public function promoCode()
    {
        $code = PromoCode::get();
        $usedCodes = UsedCodes::where('active', 1)->get();

        return view('administrator::promo_code', compact('code', 'usedCodes'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function createPromoCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'category' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'value' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors(['Completeaza toate cimpurile!']);
        }
        $query = PromoCode::create([
            'code' => $request->code,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'type' => $request->type,
            'value' => $request->value
        ]);

        $query->save();

        $category = $request->category;

        foreach ($category as $item) {

            $saveData = PromoCategory::create([
                'promo_id' => $query->id,
                'category_id' => $item
            ]);

            $saveData->save();
        }

        return redirect()->back()->with('messages', ['Codul a fost creat cu succes']);
    }

    /**
     * @param $promo
     * @return mixed
     */
    public function deletePromoCode($promo)
    {
        $promo->delete();

        return redirect()->back()->with('messages', ['Codul a fost sters!']);
    }

    /**
     * @param $used
     * @return mixed
     */
    public function deleteUsedCodes($used)
    {
        $used->delete();

        return redirect()->back()->with('messages', ['Codul a fost sters!']);
    }

}

