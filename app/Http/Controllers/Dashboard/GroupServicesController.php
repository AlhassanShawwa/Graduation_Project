<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Group;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupOfServicesRequest;



class GroupServicesController extends Controller
{
  public function index(Request $request)
    {
        $allServices = Service::all();
        $GroupsItems = $request->session()->get('GroupsItems', []);
        $discount_value = $request->session()->get('discount_value', 0);
        $taxes = $request->session()->get('taxes', 17);
        $name_group = $request->session()->get('name_group', '');
        $notes = $request->session()->get('notes', '');
        $ServiceSaved = $request->session()->get('ServiceSaved', false);

        $total = 0;
        foreach ($GroupsItems as $groupItem) {
            if ($groupItem['is_saved'] && $groupItem['service_price'] && $groupItem['quantity']) {
                $total += $groupItem['service_price'] * $groupItem['quantity'];
            }
        }

        $subtotal = $Total_after_discount = $total - ((is_numeric($discount_value) ? $discount_value : 0));
        $total_with_tax = $Total_after_discount * (1 + (is_numeric($taxes) ? $taxes : 0) / 100);

        return view('Dashboard.Services.group-services.index', compact('allServices', 'GroupsItems', 'discount_value', 'taxes', 'name_group', 'notes', 'ServiceSaved', 'subtotal', 'total_with_tax'));
    }

    public function addService(Request $request)
    {
        $GroupsItems = $request->session()->get('GroupsItems', []);
        foreach ($GroupsItems as $key => $groupItem) {
            if (!$groupItem['is_saved']) {
                return back()->withErrors(['GroupsItems.' . $key => 'يجب حفظ هذا الخدمة قبل إنشاء خدمة جديدة.']);
            }
        }

        $GroupsItems[] = [
            'service_id' => '',
            'quantity' => 1,
            'is_saved' => false,
            'service_name' => '',
            'service_price' => 0
        ];

        $request->session()->put('GroupsItems', $GroupsItems);
        $request->session()->put('ServiceSaved', false);

        return redirect()->route('group-services.index');
    }

    public function editService(Request $request, $index)
    {
        $GroupsItems = $request->session()->get('GroupsItems', []);
        foreach ($GroupsItems as $key => $groupItem) {
            if (!$groupItem['is_saved']) {
                return back()->withErrors(['GroupsItems.' . $key => 'This line must be saved before editing another.']);
            }
        }

        $GroupsItems[$index]['is_saved'] = false;
        $request->session()->put('GroupsItems', $GroupsItems);

        return redirect()->route('group-services.index');
    }

    public function saveService(Request $request, $index)
    {
        $GroupsItems = $request->session()->get('GroupsItems', []);
        $product = Service::find($GroupsItems[$index]['service_id']);
        $GroupsItems[$index]['service_name'] = $product->name;
        $GroupsItems[$index]['service_price'] = $product->price;
        $GroupsItems[$index]['is_saved'] = true;

        $request->session()->put('GroupsItems', $GroupsItems);

        return redirect()->route('group-services.index');
    }

    public function removeService(Request $request, $index)
    {
        $GroupsItems = $request->session()->get('GroupsItems', []);
        unset($GroupsItems[$index]);
        $GroupsItems = array_values($GroupsItems);
        $request->session()->put('GroupsItems', $GroupsItems);

        return redirect()->route('group-services.index');
    }

    public function saveGroup(StoreGroupOfServicesRequest $request)
    {
        $GroupsItems = $request->session()->get('GroupsItems', []);
        $discount_value = $request->session()->get('discount_value', 0);
        $taxes = $request->session()->get('taxes', 17);
        $name_group = $request->session()->get('name_group', '');
        $notes = $request->session()->get('notes', '');

        $Groups = new Group();
        $total = 0;

        foreach ($GroupsItems as $groupItem) {
            if ($groupItem['is_saved'] && $groupItem['service_price'] && $groupItem['quantity']) {
                $total += $groupItem['service_price'] * $groupItem['quantity'];
            }
        }

        $Groups->Total_before_discount = $total;
        $Groups->discount_value = $discount_value;
        $Groups->Total_after_discount = $total - ((is_numeric($discount_value) ? $discount_value : 0));
        $Groups->tax_rate = $taxes;
        $Groups->Total_with_tax = $Groups->Total_after_discount * (1 + (is_numeric($taxes) ? $taxes : 0) / 100);
        $Groups->name = $name_group;
        $Groups->notes = $notes;
        $Groups->save();

        foreach ($GroupsItems as $GroupsItem) {
            $Groups->service_group()->attach($GroupsItem['service_id']);
        }

        $request->session()->forget(['GroupsItems', 'name_group', 'notes', 'discount_value']);
        $request->session()->put('ServiceSaved', true);

        return redirect()->route('group-services.index');
    }
}




