<?php
namespace App\Repository\Services;
use App\Models\Service;
use App\Interfaces\Services\SingleServiceRepositoryInterface;



class SingleServiceRepository implements SingleServiceRepositoryInterface{

    public function index()
    {
        $services = Service::all();
        return view('Dashboard.Services.Single Service.index',['services'=>$services]);
    }

    public function store($request)
    {
        try {
            $SingleService = new Service();
            $SingleService->price = $request->price;
            $SingleService->description = $request->description;
            $SingleService->status = 1;
            $SingleService->save();

            // store trans
            $SingleService->name = $request->name;
            $SingleService->save();

            session()->flash('add');
            return redirect()->route('Service.index');

        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        try {

            $SingleService = Service::findOrFail($request->id);
            $SingleService->price = $request->price;
            $SingleService->description = $request->description;
            $SingleService->status = $request->status;
            $SingleService->save();

            // store trans
            $SingleService->name = $request->name;
            $SingleService->save();

            session()->flash('edit');
            return redirect()->route('Service.index');

        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        Service::findOrFail($request->id)->delete();
        session()->flash('delete');
        return redirect()->route('Service.index') ;
    }

}