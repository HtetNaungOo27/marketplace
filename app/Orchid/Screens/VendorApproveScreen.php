<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;
use App\Models\Vendor;
use Orchid\Screen\Actions\Button;
use Illuminate\Http\Request;

class VendorApproveScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'vendors' => Vendor::with('user')->latest()->get(),
        ];
    }

    public function name(): ?string
    {
        return 'Vendor Approval';
    }

    public function layout(): iterable
    {
        return [
            Layout::table('vendors', [
                TD::make('id'),
                TD::make('user.name', 'Name'),
                TD::make('store_name'),
                TD::make('approval_status'),

                TD::make('Actions')
                    ->render(function (Vendor $vendor) {
                        return Button::make('Approve')
                            ->method('approve', ['id' => $vendor->id])
                            ->canSee($vendor->approval_status !== 'Approved');
                    }),
            ])
        ];
    }

    public function approve(Request $request)
    {
        Vendor::find($request->get('id'))
            ->update(['approval_status' => 'Approved']);
    }
}